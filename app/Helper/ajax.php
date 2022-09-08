<?php

use App\Models\Backend\Article;

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

        $moreArticles = Article::where('category_id', $article->category->id)
            ->where('id', '!=', $article->id)
            ->whereNotIn('id', $articles->pluck('id')->toArray())
            ->limit(8)
            ->get();

        foreach ($moreArticles as $article) {
            $more .= view('frontend.pages.article.components.more', compact('article'))->render();
        }

        $more .= '</div>';

        return [
            'youMayAlsoLike' => $youMayAlsoLike,
            'more' => $more,
        ];
    }
}
