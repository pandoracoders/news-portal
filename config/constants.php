<?php

return [
    "article_limit" => 8,
    "seo_validation" => [
        "meta_title" => "nullable|max:255",
        "meta_description" => "nullable",
        "meta_keywords" => "nullable|max:255"
    ],
    "table_field_types" => [
        "text",
        "date",
        "url"
    ],
    "writer_permissions" => [
        "backend.category-list",
        "backend.tag-list",
        "backend.tag-create",
        "backend.tag-edit",
        "backend.article-list",
        "backend.article_title-list",
        "backend.article_title-pick"
    ],
    "editor_permissions" => [
        "backend.category-list",
        "backend.tag-list",
        "backend.tag-create",
        "backend.tag-edit",
        "backend.article-list",
        "backend.article_title-list",
        "backend.article_title-pick"
    ],
    "home_page_cache_key" => "HOME_PAGE_CACHE",

];
