<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ArticleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ArticleRequest;
use App\Jobs\Backend\ArticleLogJob;
use App\Models\Backend\Article;
use App\Services\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return $datatable->render($this->path . 'index');
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
        Article::create($request->validated());

        return redirect()
            ->route('backend.article-view')
            ->with('success', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
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
            $articleArray = collect($request->validated())
                ->except(['tags'])
                ->toArray();
        }

        if ($request->task_status == 'submitted') {
            if ($article->editor_id) {
                $message = 'Article Resubmitted and assign to ' . auth()->user()->name . ' for editing';
            } else {
                $message = 'Article is submitted and open for editor';
            }
        } elseif ($request->task_status == 'published') {
            $message = 'Article published by ' . auth()->user()->name;
            if (!$article->published_at) {
                $articleArray['published_at'] = carbon($request->published_at);
            } else {
                unset($articleArray['published_at']);
            }
        } elseif ($request->task_status == 'modifying') {
            $message = auth()->user()->name . ' send Article for modification';
        }

        if ($request->task_status == 'submitted' && $article->editor_id) {
            $articleArray['task_status'] = 'editing';
        }

        $article->update(array_filter($articleArray));

        $article->tags()->sync($request->tags);
        if ($message) {
            ArticleLogJob::dispatch($article, $message, $request->discussion ?? '');
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
        dd('update task status');

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
}
