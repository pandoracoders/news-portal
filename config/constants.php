<?php

return [
    "enable_2fa" => false,
    "article_limit" => 8,
    "task_status" => [
        "writing",
        "submitted",
        "reviewing",
        "rejected",
        "published",
    ],
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
        "backend.article-list",
        "backend.article_title-list",
        "backend.article_title-pick"
    ],
    "editor_permissions" => [
        "backend.category-list",
        "backend.tag-list",
        "backend.tag-create",
        "backend.article-create",
        "backend.article-list",
    ],
    "home_page_cache_key" => "HOME_PAGE_CACHE",

    "sidebar" => [
        [
            "group" => "Section",
            "children" => [
                "category" => [
                    "title" => "Category",
                    "icon" => "bi-list",
                    "url" => "backend.category-list",
                    "permissions" => [
                        "backend.category-list",
                        "backend.category-create",
                        "backend.category-edit",
                        "backend.category-delete"
                    ]
                ],
                "tag" => [
                    "title" => "Tag",
                    "icon" => "bi-tags",
                    "url" => "backend.tag-list",
                    "permissions" => [
                        "backend.tag-list",
                        "backend.tag-create",
                        "backend.tag-edit",
                        "backend.tag-delete"
                    ]
                ],
                "table_set" => [
                    "title" => "Table Set",
                    "icon" => "bi-table",
                    "url" => "backend.table_set-list",
                    "permissions" => [
                        "backend.table_set-list",
                        "backend.table_set-create",
                        "backend.table_set-edit",
                        "backend.table_set-delete"
                    ]
                ],
                "article" => [
                    "title" => "Article",
                    "icon" => "bi-newspaper",
                    "url" => "backend.article-list",
                    "permissions" => [
                        "backend.article-list",
                        "backend.article-create",
                        "backend.article-edit",
                        "backend.article-delete"
                    ]
                ],
                "article_title" => [
                    "title" => "Article Title",
                    "icon" => "bi-card-heading",
                    "url" => "backend.article_title-list",
                    "permissions" => [
                        "backend.article_title-list",
                        "backend.article_title-create",
                        "backend.article_title-edit",
                        "backend.article_title-delete"
                    ]
                ],
            ],
        ],

        [
            "group" => "System",
            "children" => [

                "user" => [
                    "title" => "User",
                    "icon" => "bi-person-plus-fill",
                    "url" => "backend.user-list",
                    "permissions" => [
                        "backend.user-list",
                        "backend.user-create",
                        "backend.user-edit",
                        "backend.user-delete"
                    ]
                ],
                "role" => [
                    "title" => "Role",
                    "icon" => "bi-person-check-fill",
                    "url" => "backend.role-list",
                    "permissions" => [
                        "backend.role-list",
                        "backend.role-create",
                        "backend.role-edit",
                        "backend.role-delete"
                    ]
                ],
            ],
        ],

    ],
];
