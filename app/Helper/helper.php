<?php

use App\Jobs\HomePageCache;
use App\Models\Backend\Article;
use App\Models\Backend\Category;
use App\Models\Backend\WebSetting;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


if (!function_exists("getMonths")) {
    function getMonths()
    {
        return [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
    }
}

if (!function_exists('wrapByPTag')) {
    function wrapByPTag($str)
    {
        $strWithP = "";
        $p = explode("\n", $str);
        foreach ($p as $key => $value) {
            if (str_word_count($value) > 0) {
                if (!str_contains($value, "<h")) {
                    if (!str_contains($value, "<figure")) {
                        if (!str_contains($value, "<block")) {
                            $strWithP .= "<p>$value</p>";
                        } else {
                            $strWithP .= $value;
                        }
                    } else {
                        $strWithP .= $value;
                    }
                } else {
                    $strWithP .= $value;
                }
            }
        }
        return $strWithP;
        $str =  str_replace("\r", "", $str);
        $str =  "<p>" . str_replace("\n", "</p><p>", $str) . "</p>";
        return $str =  str_replace("\r", "", $str);
    }
}



if (!function_exists('weekendStart')) {
    function weekendStart()
    {
        return carbon()->startOfWeek(Carbon::SUNDAY);
    }
}

if (!function_exists('weekendEnd')) {
    function weekendEnd()
    {
        return carbon()->endOfWeek(Carbon::SATURDAY);
    }
}

if (!function_exists('clearSettingCache')) {
    function clearSettingCache()
    {
        Cache::forget(config('constants.web_settings_cache_key'));
    }
}

if (!function_exists('getSettingType')) {
    function getSettingType($key)
    {
        $settings = Cache::rememberForever(config('constants.web_settings_cache_key'), function () {
            return WebSetting::get();
        });
        return $settings->where('type', $key);
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        // Cache::forget(config("constants.web_settings_cache_key"));
        $settings = Cache::rememberForever(config('constants.web_settings_cache_key'), function () {
            return WebSetting::get();
        });
        return $settings->where('key', $key)->first() ?? null;
    }
}

if (!function_exists('getSettingValue')) {
    function getSettingValue($key)
    {
        $setting = getSetting($key);
        return $setting ? $setting->value : null;
    }
}

if (!function_exists('replaceOrigin')) {
    function replaceOrigin($str)
    {
        $str = str_replace('http://wp.test', 'https://wikibioages.com/', $str);
        return str_replace('http://', 'https://', $str);
    }
}

if (!function_exists('convertCaption')) {
    function convertCaption($str)
    {
        return preg_replace('/\[caption([^\]]+)align="([^"]+)"\s+width="(\d+)"\](\s*\<img[^>]+>)\s*(.*?)\s*\[\/caption\]/i', '<figure\1 class="figure \2">\4<figcaption class="caption">\5</figcaption></figure>', replaceOrigin($str));
    }
}

if (!function_exists('str_slug')) {
    function str_slug($str)
    {
        return \Str::slug($str);
    }
}

if (!function_exists('carbon')) {
    function carbon($date = null)
    {
        return $date ? Carbon::parse($date) ?? Carbon::now() : Carbon::now();
    }
}

if (!function_exists('getRandomImage')) {
    function getRandomImage($dir)
    {
        $images = Storage::disk('public_folder')->allFiles(str_replace('public/', '', $dir));
        return str_replace('public', '', Arr::random($images));
    }
}

if (!function_exists('uploadImageFromUrl')) {
    function uploadImageFromUrl($url, $dir, $name = null)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $name = $name ?? time();
        $image = file_get_contents($url);
        $path = $dir . '/' . $name . '.jpg';
        file_put_contents($path, $image);
        return str_replace('public', '', $path);
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date, $format = 'd M Y')
    {
        return carbon($date)->format($format);
    }
}

if (!function_exists('unSlug')) {
    function unSlug($str)
    {
        return ucwords(str_replace('-', ' ', $str));
    }
}

if (!function_exists('getCategoryTables')) {
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

if (!function_exists('getArticleTables')) {
    function getArticleTables($article)
    {
        $cat = getCategoryTables($article->category);
        $tables = $article->tables ?? [];
        return array_merge_recursive_distinct($cat, $tables);
    }
}

function getTableFieldArray($field, $value = null)
{
    if ($field->type == 'date') {
        $month_day = Carbon::parse($value)->format('M d');
        $year = Carbon::parse($value)->format('Y');
        $slug = str_replace('day', '', str_slug($field->title));
        return [
            'title' => $field->title,
            'type' => $field->type,
            'value' => $value,
            'searchable' => $field->searchable,
            'html' => $value && $field->searchable ? "<a href='" . route('facts.search', ['field' => $slug . '-month', 'value' => str_slug($month_day)]) . "'>" . $month_day . '</a>, ' . "<a href='" . route('facts.search', ['field' => $slug . '-year', 'value' => str_slug($year)]) . "'>" . $year . '</a>' : $value,
        ];
    } else {
        return [
            'title' => $field->title,
            'type' => $field->type,
            'value' => $value,
            'searchable' => $field->searchable,
            'html' => $value && $field->searchable ? "<a href='" . route('facts.search', ['field' => str_slug($field->title), 'value' => str_slug($value)]) . "'>" . $value . '</a>' : $value,
        ];
    }
}

if (!function_exists('getFirstCategoryArticle')) {
    function getFirstCategoryArticle($ids = [])
    {
        $category = Category::first();
        $articles = $category->articles()->limit(config('constants.article_limit', 8));
        if (count($ids)) {
            $articles = $articles->whereNotIn('id', $ids);
        }
        return $articles->get();
    }
}

// cache

if (!function_exists('getHomePageCache')) {
    function getHomePageCache()
    {
        return HomePageCache::getCache();
    }
}

if (!function_exists('clearHomePageCache')) {
    function clearHomePageCache()
    {
        Cache::forget(config('constants.home_page_cache_key'));
        // return HomePageCache::getCache();
    }
}

if (!function_exists('articleTag')) {
    function articleTag($article)
    {
        $tags = [];
        foreach ($article->tags as $tag) {
            $tags[] = $tag->slug;
        }

        return $tags;
    }
}

// Age Calculation

function age($birthYear, $birthMonth=null, $birthDay=null, $deathYear=null, $deathMonth=null, $deathDay=null){
    $months = ['January'=>1, 'February'=>2,'March'=>3,'April'=>4,'May'=>5,'June'=>6,'July'=>7,'August'=>'8','September'=>9,'October'=>10,'November'=>11,'December'=>12 ];

    if (!$deathYear) {
        $day = carbon()->format('d');
        $month = carbon()->format('F');
        $year = carbon()->format('Y');


        if(!$birthMonth){
            return $year - $birthYear;
        }

        else if($birthMonth && $months[$month] - $months[$birthMonth] > 0){
            return $year - $birthYear;
        }
        else if($birthMonth && $months[$month] - $months[$birthMonth] == 0){
            if($birthDay){
                if((int)$day - (int)$birthDay >= 0){
                    return $year - $birthYear;
                }
                else{
                    return $year - ($birthYear+1);
                }
            }
            else{
                return $year - $birthYear;
            }
        }
        else{
            return $year - ($birthYear +1);
        }
    }else{

        if(!$deathMonth && !$birthMonth){
            return $deathYear - $birthYear;
        }

        if($deathMonth && $months[$deathMonth] - $months[$birthMonth] > 0){
            return $deathYear - $birthYear;
        }
        else if($deathMonth && $months[$deathMonth] - $months[$birthMonth] == 0){
            if($deathDay){
                if((int)$deathDay - (int)$birthDay >= 0){
                    return $deathYear - $birthYear;
                }
                else{
                    return $deathYear - ($birthYear+1);
                }
            }
            else{
                return $deathYear - $birthYear;
            }
        }
        else if($deathMonth && $months[$deathMonth] - $months[$birthMonth] < 0){
            return $deathYear - ($birthYear +1);
        }


    }



}
