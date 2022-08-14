<?php

use App\Jobs\HomePageCache;
use App\Models\Backend\Category;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

if (!function_exists("str_slug")) {
    function str_slug($str)
    {
        return \Str::slug($str);
    }
}

if (!function_exists("carbon")) {
    function carbon($date = null)
    {
        return $date ? Carbon::parse($date) ?? Carbon::now() : Carbon::now();
    }
}

if (!function_exists("getRandomImage")) {
    function getRandomImage($dir)
    {
        $images = Storage::disk("public_folder")->allFiles(str_replace("public/", "", $dir));
        return str_replace("public", "", Arr::random($images));
    }
}

if (!function_exists("uploadImageFromUrl")) {
    function uploadImageFromUrl($url, $dir, $name = null)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $name = $name ?? time();
        $image = file_get_contents($url);
        $path = $dir . "/" . $name . ".jpg";
        file_put_contents($path, $image);
        return str_replace("public", "", $path);
    }
}

if (!function_exists("dateFormat")) {
    function dateFormat($date, $format = "d M Y")
    {
        return carbon($date)->format($format);
    }
}

if (!function_exists("customUcwords")) {
    function customUcwords($str)
    {
        return ucwords(str_replace("-", " ", $str));
    }
}

if (!function_exists("getCategoryTables")) {
    function getCategoryTables($category)
    {
        $tables = [];
        foreach ($category->tables as $table) {
            $tables[$table->title] = [];
            foreach ($table->tableFields as $field) {
                $tables[$table->title][str_slug($field->title)] = getTableFieldArray($field);
            }
        }
        return $tables;
    }
}

if (!function_exists("getArticleTables")) {
    function getArticleTables($article)
    {
        $cat = getCategoryTables($article->category);
        $tables = $article->tables ?? [];
        return (array_merge_recursive_distinct($cat, $tables));
    }
}

function getTableFieldArray($field, $value = null)
{
    if ($field->type == "date") {
        $month_day = Carbon::parse($value)->format("M d");
        $year = Carbon::parse($value)->format("Y");
        $slug = str_replace("day", "", str_slug($field->title));
        return [
            "title" => $field->title,
            "type" => $field->type,
            "value" => $value,
            "searchable" => $field->searchable,
            "html" => $value && $field->searchable ? ("<a href='" . route("news.search", ["field" => $slug . "-month", "value" => str_slug($month_day)]) . "'>" . $month_day . "</a>, " . "<a href='" . route("news.search", ["field" => $slug . "-year", "value" => str_slug($year)]) . "'>" . $year . "</a>") : $value,
        ];
    } else {
        return [

            "title" => $field->title,
            "type" => $field->type,
            "value" => $value,
            "searchable" => $field->searchable,
            "html" => $value && $field->searchable ? ("<a href='" . route("news.search", ["field" => str_slug($field->title), "value" => str_slug($value)]) . "'>" . $value . "</a>") : $value,

        ];
    }

}

if (!function_exists("getFirstCategoryArticle")) {
    function getFirstCategoryArticle($ids = [])
    {
        $category = Category::first();
        $articles = $category->articles()->limit(config("constants.article_limit", 8));
        if (count($ids)) {
            $articles = $articles->whereNotIn("id", $ids);
        }
        return $articles->get();
    }
}

// cache

if (!function_exists("getHomePageCache")) {
    function getHomePageCache()
    {
        return HomePageCache::getCache();
    }
}

if (!function_exists("clearHomePageCache")) {
    function clearHomePageCache()
    {
        Cache::forget(config("constants.home_page_cache_key"));
        // return HomePageCache::getCache();
    }
}

if (!function_exists("articleTag")) {
    function articleTag($article)
    {
        $tags=[];
       foreach ($article->tags as $tag) {
        $tags[] =  $tag->slug;
       }

       return $tags;
    }
}



