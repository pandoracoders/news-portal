<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ArticleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ArticleRequest;
use App\Jobs\Backend\ArticleLogJob;
use App\Models\Backend\Article;
use App\Models\Backend\ArticleLog;
use App\Models\Seo;
use App\Services\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    private $path = 'backend.pages.article.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleDataTable $datatable)
    {
        $user = auth()->user();
        $counts = Article::selectRaw("count(*) as count,task_status")->groupBy("task_status");
        if ($user->isEditor) {
            $counts = $counts->where(function ($q) use ($user) {
                $q->where('writer_id', $user->id)->orWhere('editor_id', $user->id);
            });
        } else if ($user->isWriter) {
            $counts = $counts->where('writer_id', $user->id);
        }
        $counts = $counts->get()->keyBy("task_status")->toArray();
        return $datatable->render($this->path . 'index', compact('counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path . 'crud', [
            'categories' => \App\Models\Backend\Category::all(),
            'tags' => \App\Models\Backend\Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->validated());

        if ($request->read_more_articles) {
            $article->readMoreArticles()->sync($request->read_more_articles);
        }

        return redirect()
            ->route('backend.article-view')
            ->with('success', 'Article created successfully.');
    }

    // Upload image from tinymce inside content
    public function upload_image(Request $request)
    {
        $file = $request->file;
        $path =  ("uploads/" . date("Y/m/d/"));
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $filename = explode('.', $file->getClientOriginalName())[0];
        $path = $path . time() . "_" .  $filename . '.webp';

        // Intervention
        Image::make($file)->resize(450, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('webp')->save(($path),50);



        return response()->json(['location' => "/$path"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $articleLog = ArticleLog::where('article_id',$article->id)->get();

        $url = url('/') . '/';
        $articles = Article::whereNotIn('id', [$article->id])
            ->select(DB::raw('title , image, id '))
            ->get();

        $message = '';
        $role = auth()->user()->role->slug;
        $update_data = [];


        if ($article->task_status == 'submitted' && $role != 'writer') {
            $message = 'Article picked by ' . auth()->user()->name . 'for editing';
            $update_data = ['task_status' => 'editing', 'editor_id' => auth()->user()->id];
        }

        $article->update(array_filter($update_data));

        if ($message) {
            ArticleLogJob::dispatchAfterResponse($article, $message);
        }



        return view($this->path . 'crud', [
            'article' => $article,
            'categories' => \App\Models\Backend\Category::all(),
            'tags' => \App\Models\Backend\Tag::all(),
            'articles' => $articles,
            'articleLog' => $articleLog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {

        $message = 'Article saved by ' . auth()->user()->name;
        $published_at = null;


        if ($request->hasFile('image')) {
            $articleArray = array_merge(
                collect($request->validated())
                    ->except(['tags'])
                    ->toArray(),
                [
                    'image' => ImageUpload::upload($request->image),
                ],
            );
        } else {
            if (!$article->image && ($request['task_status'] === 'submitted' || $request['task_status'] === 'published')) {
                return back()->with('error', 'There is no featured image')->withInput();
            }
            $articleArray = collect($request->validated())
                ->except(['tags'])
                ->toArray();
        }

        if ($request->task_status == 'submitted') {
            if ($article->editor_id) {
                $message = 'Article Resubmitted and assigned to ' . auth()->user()->name . ' for editing';
            } else {
                $message = 'Article is submitted and open for editor';
            }
        } elseif ($request->task_status == 'published') {
            $articleArray['slug'] = Str::slug($request->title);
            $message = 'Article published by ' . auth()->user()->name;
            if (!$article->published_at) {
                $articleArray['published_at'] = carbon($request->published_at);
            } else {
                unset($articleArray['published_at']);
            }
        } elseif ($request->task_status == 'modifying') {
            $message = auth()->user()->name . ' sent Article for modification';
        }

        if ($request->task_status == 'submitted' && $article->editor_id) {
            $articleArray['task_status'] = 'editing';
        }




        $article->seo()->updateOrCreate(
            [
            'seoable_id' => $request->id,
            'seoable_type' => get_class($article)
            ],
            [
            'meta_title' => $request->meta_title ?? '',
            'meta_description' => $request->meta_description ?? '',
            'meta_keywords' => $request->meta_keywords ?? ''
            ]
        );



        $article->update(array_filter($articleArray));

        if($article->task_status == 'published'){

            $schemaObj = getArticleSchema($article);
            $article->update([
               "schema" => $schemaObj
            ]);
        }



        $article->tags()->sync($request->tags);
        if ($message) {

            ArticleLogJob::dispatch($article, $message, $request->discussion ?? '');
        }

        if ($request->read_more_articles) {
            $article->readMoreArticles()->sync($request->read_more_articles);
        }

        if ($request->task_status) {
            return redirect()
                ->route('backend.article-view')
                ->with('success', 'Article updated successfully.');
        } else {
            return redirect()
                ->back()
                ->with('success', 'Article updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article?->delete();
        return redirect()
            ->route('backend.article-view')
            ->with('success', 'Article deleted successfully.');
    }

    public function updateTaskStatus(Article $article, $taskStatus)
    {

        $user = auth()->user();
        if ($user->id == $article->writer_id && $article->task_status == 'writing' && $taskStatus == 'submitted') {
            $article->update([
                'task_status' => $taskStatus,
            ]);
            return redirect()
                ->route('backend.article-view')
                ->with('success', 'Article Task status updated successfully.');
        } elseif (in_array($user->role->title, ['Editor', 'Super Admin']) && $article->task_status == 'submitted' && $taskStatus == 'editing') {
            $article->update([
                'task_status' => $taskStatus,
                'editor_id' => $user->id,
            ]);
            return redirect()
                ->route('backend.article-view')
                ->with('success', 'Article Task status updated successfully.');
        } elseif ($user->id == $article->editor_id && in_array($user->role->title, ['Editor', 'Super Admin']) && $article->task_status == 'editing' && $taskStatus == 'published') {
            $article->update([
                'task_status' => $taskStatus,
            ]);
            return redirect()
                ->route('backend.article-view')
                ->with('success', 'Article Task status updated successfully.');
        } else {
            return redirect()
                ->back()
                ->with('error', 'You are not authorized to perform this action.');
        }
    }

    public function updateStatus(Article $article)
    {
        // dd("stat");
        if ($article && $article->id) {
            $article->status = !$article->status;
            $article->save();

            ArticleLogJob::dispatch($article, 'Article status update to ' . ($article->status ? 'Active' : 'Inactive') . ' by ' . auth()->user()->name);

            return redirect()
                ->route('backend.article-view')
                ->with('success', 'Article status updated successfully.');
        }

        return redirect()
            ->route('backend.article-view')
            ->with('error', 'Article not found.');
    }

    public function search(Request $request)
    {
        $articles = Article::find($request->id)?->linkableArticles($request->search);
        return response()->json($articles);
    }

    public function featured(Article $article)
    {
        $article->update([
            'is_featured' => !$article->is_featured
        ]);
        return back()->with('success', "Article " . $article->is_featured ? 'added to' : 'removed from' . " featured list");
    }

    public function editor_choice(Article $article)
    {
        $article->update([
            'editor_choice' => !$article->editor_choice
        ]);

        // dd($article );
        return back()->with('success', "Article " . $article->editor_choice ? 'added to' : 'removed from' . " editor choice list");
    }

    public function revisions($revision_article){
        $articleLog = ArticleLog::where('id', $revision_article)->first();
        $prevLog = ArticleLog::where('article_id', $articleLog->article_id)->where('id', "<", $revision_article)->orderBy('id','desc')->first();
        return view($this->path . 'revisions', [
            'articleLog' => $articleLog,
            'previous' => $prevLog
        ]);
    }
}
