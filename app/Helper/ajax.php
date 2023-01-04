<?php

use App\Models\Backend\Article;
use App\Models\Backend\Category;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

if(!function_exists('getArticles')){
    function getArticles($originalArticle){
        $keyword = $originalArticle->seo->meta_keywords;
        $articles = Article::where(function ($q) {
            $q->where('task_status', 'published')->where('status', 1);
        })->where('id', '!=', $originalArticle->id)
        ->where('body', 'like', '%' . $keyword . '%')
        ->limit(10)
        ->get();

        if ($articles->count() < 10) {
            $num = 10 - $articles->count();
            // get random articles
            $extraArticle =  Article::where(function ($q) {
                $q->where('task_status', 'published')->where('status', 1);
            })
            ->where('id', '!=', $originalArticle->id)
            ->where('body', 'not like', '%' . $keyword . '%')
            ->limit($num)
            ->get();

            $articles = $articles->merge($extraArticle);
        }
        return $articles;
    }
}

if (!function_exists('getYouMayAlsoLike')) {
    function getYouMayAlsoLike($originalArticle)

    {
        $articles = getArticles($originalArticle);
        $youMayAlsoLike = '';
        $youMayAlsoLike .= '<div class="heading">';
        $youMayAlsoLike .= '<div class="category-segment">';
        $youMayAlsoLike .= '<span>You May Also Like</span>';
        $youMayAlsoLike .= '</div>';
        $youMayAlsoLike .= '</div>';
        $youMayAlsoLike .= '<div class="row">';

        foreach ($articles as $article) {
            $youMayAlsoLike .= view('frontend.pages.article.components.sidebar', compact('article'))->render();
        }

        $youMayAlsoLike .= '</div>';

        return [
            'youMayAlsoLike' => $youMayAlsoLike,
        ];
    }
}

if(!function_exists('getMoreArticles')){
    function getMoreArticles($originalArticle, $page){
        // More article of same category
        $articles = getArticles($originalArticle);
        $moreArticles = Article::where('category_id', $originalArticle->category_id)
            ->where('task_status','published')
            ->where('status',1)
            ->where('id', '!=', $originalArticle->id)
            ->whereNotIn('id', $articles->pluck('id')->toArray())
            ->skip(($page-1)*12)
            ->limit(12)
            ->orderBy('published_at','desc')
            ->get();

        $more = '';
        if($moreArticles->count() > 0){
            $more .= '<div class="row" id="scroll-content">';

            foreach ($moreArticles as $article) {
                $more .= view('frontend.pages.article.components.more', compact('article'))->render();
            }

            $more .= '</div>';
        }

        return $more;
    }
}


if (!function_exists('getHomePageAjax')) {
    function getHomePageAjax()
    {
        $ids = [];
        $just_published = Article::activeAndPublish()
            ->with(['category', 'writer'])
            ->where('task_status', 'published')
            ->limit(config('constants.article_limit', 8))
            ->whereNotIn('id', $ids)
            ->get();

        $ids = array_merge($ids, $just_published->pluck('id')->toArray());

        $category_section = [];

        foreach (Category::where('id', 2)
            ->where('status', 1)
            ->get()
            as $key => $category) {
            $section['category'] = $category;

            $articles1 = $category
                ->articles()
                ->with(['category', 'writer'])
                ->where('task_status', 'published')
                ->limit(config('constants.article_limit', 7))
                ->whereNotIn('id', $ids)
                ->get();

            $ids = array_merge($ids, $articles1->pluck('id')->toArray());

            $articles2 = $category
                ->articles()
                ->with(['category', 'writer'])
                ->where('task_status', 'published')
                ->limit(2)
                ->whereNotIn('id', $ids)
                ->get();
            $ids = array_merge($ids, $articles2->pluck('id')->toArray());

            $section['articles'] = [$articles1, $articles2];

            $section['second']['title'] = 'Just Published';
            $section['second']['articles'] = $just_published;
        }

        $category_section_html = view('frontend.pages.home.components.category-section', compact('section'))->render();

        $today = carbon()->format('M d');
        return [
            'category_section_html' => $category_section_html,
            'born_today' => view('frontend.pages.home.components.born-today', [
                'born_today' => Article::activeAndPublish()
                    ->with(['category', 'writer'])
                    ->where('task_status', 'published')
                    ->where('tables->Quick Facts->birthday->value', 'LIKE', "%$today%")
                    ->limit(config('constants.article_limit', 8))
                    ->get(),
            ])->render(),
            'died_today' => view('frontend.pages.home.components.died-today', [
                'died_today' => Article::activeAndPublish()
                    ->with(['category', 'writer'])
                    ->where('task_status', 'published')
                    ->where('tables->Quick Facts->death_day->value', 'LIKE', "%$today%")
                    ->limit(config('constants.article_limit', 8))
                    ->get(),
            ])->render(),
        ];
    }
}


if (!function_exists("getReadMoreSection")) {
    function getReadMoreSection(Article $article)
    {
        $articles = $article->readMoreArticles;

        $readMoreSection = $articles->count() ? view("frontend.pages.article.components.read-more-articles", compact('articles'))->render() : '';
        return $readMoreSection;
    }
}
