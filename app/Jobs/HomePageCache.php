<?php

namespace App\Jobs;

use App\Models\Backend\Article;
use App\Models\Backend\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class HomePageCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Cache::forget(config("constants.home_page_cache_key"));
        return self::getCache();
    }


    public static function getCache()
    {
        return Cache::rememberForever(config("constants.home_page_cache_key"), function () {
            // get featured articles
            $featured_articles = Article::with(["category", "writer"])->where("is_featured", true)->limit(config("constants.article_limit", 8))->get();
            $ids = $featured_articles->pluck("id")->toArray();
            $category_section = [];
            foreach (Category::limit(2)->get() as $key => $value) {

                $category_section[$value->slug]["category"] = $value;
                $articles =  $value->articles()->with(["category", "writer"])->limit(config("constants.article_limit", 8))->whereNotIn("id", $ids)->get();
                $ids = array_merge($ids, $articles->pluck("id")->toArray());
                $category_section[$value->slug]["articles"] = [
                    $value->articles()->with(["category", "writer"])->limit(config("constants.article_limit", 7))->whereNotIn("id", $ids)->get(),
                    $value->articles()->with(["category", "writer"])->limit(3)->whereNotIn("id", $ids)->get()
                ];
                if ($key == 0) {

                    $category_section[$value->slug]["second"]["title"] = "Editor Choice";
                    $category_section[$value->slug]["second"]["articles"] = Article::with(["category", "writer"])->where("is_featured", 1)->limit(config("constants.article_limit", 8))->whereNotIn("id", $ids)->get();
                } else if ($key == 1) {
                    $category_section[$value->slug]["second"]["title"] = "Just Published";
                    $category_section[$value->slug]["second"]["articles"] = Article::with(["category", "writer"])->limit(config("constants.article_limit", 8))->whereNotIn("id", $ids)->get();
                }
            }

            // dd($category_section);
            $today = carbon()->format("M d");
            return [
                "featured_articles" => $featured_articles,
                "category_section" => $category_section,
                "born_today" => Article::with(["category", "writer"])->where('tables->Quick Facts->birthday->value', "LIKE", "%$today%")->limit(config("constants.article_limit", 8))->get(),
                "died_today" => Article::with(["category", "writer"])->where('tables->Quick Facts->death_day->value', "LIKE", "%$today%")->limit(config("constants.article_limit", 8))->get(),
            ];
        });
    }
}
