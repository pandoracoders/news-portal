<?php

namespace App\Models\Traits;

use App\Models\Seo;

trait SeoTrait
{


    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public static function bootSeoTrait()
    {

        static::created(function ($model) {
           if (request()->meta_title && request()->meta_description && request()->meta_keywords) {
                $model->seo()->updateOrCreate(
                    [
                        "seoable_id" => $model->id,
                        "seoable_type" => get_class($model),
                    ],
                    [
                        'meta_title' => request()->meta_title,
                        'meta_description' => request()->meta_description,
                        'meta_keywords' => request()->meta_keywords,
                    ]
                );
            }
        });

        static::updated(function ($model) {
            if (request()->meta_title || request()->meta_description || request()->meta_keywords) {

                $model->seo()->updateOrCreate(
                    [
                        "seoable_id" => $model->id,
                        "seoable_type" => get_class($model),
                    ],
                    [
                        'meta_title' => request()->meta_title ?? '',
                        'meta_description' => request()->meta_description ?? '',
                        'meta_keywords' => request()->meta_keywords ?? '',
                    ]
                );
            }
        });
    }
}
