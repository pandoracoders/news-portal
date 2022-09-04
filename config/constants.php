<?php

return [
    "enable_2fa" => false,
    "article_limit" => 6,
    "task_status" => [
        "writing",
        "submitted",
        "editing",
        "modifying",
        "published",
        "reviewing"
    ],
    "web_setting_tabs" => ['branding', 'social-media', 'secret', 'seo'],
    "social_media" => [
        "facebook",
        "twitter",
        "instagram",
        "youtube",
        "linkedin",
        "pinterest",
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
    "permissions" => [
        "category-view",
        "category-manage",
        "tag-view",
        "tag-manage",
        "table_set-view",
        "table_set-manage",
        "article_title-view",
        "article_title-pick",
        "article_title-manage",
        "article-publish",
        "article-view",
        "article-manage",
        "user-view",
        "user-manage",
        "assign_permission",
        "role-view",
        "role-manage",
    ],
    "writer_permissions" => [
        "category-view",
        "tag-view",
        "article_title-view",
        "article_title-pick",
        "article-view",
    ],
    "editor_permissions" => [
        "category-view",
        "tag-view",
        "article-view",
        "article-publish",
    ],
    "home_page_cache_key" => "HOME_PAGE_CACHE",
    "web_setting_cache_key"=> "WEB_SETTING_CACHE",

    "sidebar" => [
        [
            "group" => "Section",
            "children" => [
                "category" => [
                    "title" => "Category",
                    "icon" => "bi-folder2-open",
                    "url" => "backend.category-view",
                    "permissions" => [
                        "backend.category-view",
                        "backend.category-create",
                        "backend.category-edit",
                        "backend.category-delete"
                    ]
                ],
                "tag" => [
                    "title" => "Tag",
                    "icon" => "bi-tags",
                    "url" => "backend.tag-view",
                    "permissions" => [
                        "backend.tag-view",
                        "backend.tag-create",
                        "backend.tag-edit",
                        "backend.tag-delete"
                    ]
                ],
                "table_set" => [
                    "title" => "Table Set",
                    "icon" => "bi-table",
                    "url" => "backend.table_set-view",
                    "permissions" => [
                        "backend.table_set-view",
                        "backend.table_set-create",
                        "backend.table_set-edit",
                        "backend.table_set-delete"
                    ]
                ],
                "article" => [
                    "title" => "Tasks",
                    "icon" => "bi-newspaper",
                    "url" => "backend.article-view",
                    "permissions" => [
                        "backend.article-view",
                        "backend.article-create",
                        "backend.article-edit",
                        "backend.article-delete"
                    ]
                ],
                "article_title" => [
                    "title" => "Topics",
                    "icon" => "bi-card-heading",
                    "url" => "backend.article_title-view",
                    "permissions" => [
                        "backend.article_title-view",
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
                    "url" => "backend.user-view",
                    "permissions" => [
                        "backend.user-view",
                        "backend.user-create",
                        "backend.user-edit",
                        "backend.user-delete"
                    ]
                ],
                // "role" => [
                //     "title" => "Role",
                //     "icon" => "bi-person-check-fill",
                //     "url" => "backend.role-view",
                //     "permissions" => [
                //         "backend.role-view",
                //         "backend.role-create",
                //         "backend.role-edit",
                //         "backend.role-delete"
                //     ]
                // ],
            ],
        ],
    ],
];
