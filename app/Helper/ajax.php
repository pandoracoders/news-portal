<?php

use App\Models\Backend\Article;
use App\Models\Backend\Category;

if (!function_exists('getYouMayAlsoLike')) {
    function getYouMayAlsoLike($article)
    {
        $keyword = $article->seo->meta_keywords;
        $articles = Article::where(function ($q) {
            $q->where('task_status', 'published')->where('status', 1);
        })
            ->where('id', '!=', $article->id)
            ->where('title', 'like', '%' . $keyword . '%')
            ->limit(8)
            ->get();

        if (!$articles->count()) {
            // get random articles
            $articles = Article::where(function ($q) {
                $q->where('task_status', 'published')->where('status', 1);
            })
                ->where('id', '!=', $article->id)
                ->get()
                ->random(8);
        }

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

        $more = '';

        $more .= '<div class="heading mt-4 mb-4">';
        $more .= '<div class="category-segment">';
        $more .= '<span>More on' . $article->category->title . '</span>';
        $more .= '</div>';
        $more .= '</div>';
        $more .= '<div class="row" id="scroll-content">';

        // $moreArticles = Article::where('category_id', $article->category->id)
        //     ->where('id', '!=', $article->id)
        //     ->whereNotIn('id', $articles->pluck('id')->toArray())
        //     ->limit(8)
        //     ->get();

        // foreach ($moreArticles as $article) {
        //     $more .= view('frontend.pages.article.components.more', compact('article'))->render();
        // }

        $more .= '</div>';

        return [
            'youMayAlsoLike' => $youMayAlsoLike,
            'more' => $more,
        ];
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

        foreach (Category::where('id', 1)
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
