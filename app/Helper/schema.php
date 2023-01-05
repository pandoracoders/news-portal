<?php

use App\Models\Backend\Category;




function getHomePageSchema(){
    $categories = Category::where('status','1')->get();
    $parentCategories = [];
    $nc = [];
    if(count($categories)>0){
        foreach ($categories as $category){
            array_push($nc,$category);
            foreach ($categories as $cat){
                if ($category->id == $cat->parent_id){
                    array_push($parentCategories, $category);
                    break;
                }
            }
        }

        $navigatingCategories = array_diff($nc, $parentCategories);
        $catName = [];
        $catUrl = [];
        foreach($navigatingCategories as $navCat){
            array_push($catName, $navCat->title);
            array_push($catUrl, route('singleArticle', $navCat->slug));
        }
        $navigationSchema = [

            "@type" => "SiteNavigationElement",
            "name" => [
                [
                    ...$catName
                ]
            ],
            "url" => [[
                ...$catUrl
            ]]
        ];
    }

    $breadCrumb= [
        "@type"=> "BreadcrumbList",
        "@id"=> route('home')."/#breadcrumb",
        "itemListElement"=> [
            [
            "@type"=> "ListItem",
            "position"=> 1,
            "name"=> "Home"
            ]
            ]
    ];

    $search = [
        "@type"=> "WebSite",
        "url"=> route('home'),
        "potentialAction"=> [
            "@type"=> "SearchAction",
            "target"=> route('home')."/search/?q={search_term_string}",
            "query-input"=> "required name=search_term_string"
        ]
    ];

    $schemaObj = [[
        "@context" => "https://schema.org",
        "@graph" => [
            getOrganizationSchema(),
            $breadCrumb,
            isset($navigationSchema)?$navigationSchema:'',
            getWebSchema(),
            $search
        ]
    ]];

    return returnSchemaScriptTag(json_encode($schemaObj, JSON_UNESCAPED_SLASHES) );
}



function getArticleSchema($article){
    $articleSchema = [
        "@type"=>"Article",
        "@id"=>route('singleArticle', ($article->slug))."/#article",
        "isPartOf"=> [
            "@id"=>route('singleArticle', ($article->slug))
        ],
        "headline"=> $article->seo->meta_title,
        "description"=> $article->seo->meta_description,
        "datePublished"=>$article->published_at?carbon($article->published_at)->tz('UTC')->toAtomString():'',
        "dateModified" =>$article->updated_at?carbon($article->updated_at)->tz('UTC')->toAtomString():'',
        "author"=>[
            "@type"=> "Person",
            "name"=> $article->author->alias_name,
            "url"=> route('authorArticle', $article->author->slug)
        ],
        "image"=> [
            '@type' => 'ImageObject',
            'url' => asset('/uploads/featured/'.$article->image),
            'width' => 728,
            'height' => 455,
        ],
        "wordCount"=> str_word_count(strip_tags($article->body)),
        "publisher"=> [
            "@type"=> "Organization",
            "name"=> getSettingValue('website_title'),
            "url"=>  route('home'),
            "logo"=> getImageMeta(getSettingValue('favicon'))
        ],
        "brand"=> getSettingValue('website_title'),
        "articleSection"=> $article->category->title,
        'keywords' => $article->seo->meta_keywords,
        "mainEntityOfPage"=> [
            "@type"=> ["WebPage"],
            "@id"=> route('singleArticle', $article->slug)
        ]
    ];
    $breadcrumbSchema = [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'item' => [
                    '@id' => url('/'),
                    'name' => 'Home',
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'item' => [
                    '@id' => route('singleArticle', $article->category->slug),
                    'name' => $article->category->title,
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'item' => [
                    '@id' => route('singleArticle', $article->slug),
                    'name' => $article->title,
                ],
            ],
        ],
    ];
    $schemaObj = [[
        "@context" => "https://schema.org",
        "@graph"=>[
            $articleSchema,
            $breadcrumbSchema,
            getWebSchema(),
        ]
    ]];

    $encoded = json_encode($schemaObj,JSON_UNESCAPED_SLASHES);
    return '<script type="application/ld+json">' . $encoded . '</script>';
}



function getCategorySchema($category){

    $firstArticle = $category->articles()->orderBy('published_at')->first();

    if($firstArticle){
        $articleImage = asset($firstArticle->image);
    }else{
        $articleImage = '';
    }

    $collectionPage = [
        "@type"=>"CollectionPage",
        "@id"=>route('singleArticle', $category->slug),
        "url"=>route('singleArticle', $category->slug),
        "name"=>$category->title,
        "isPartOf"=>[ "@id"=>route('home')."/#website" ],
        "primaryImageOfPage"=>[
            "@id"=>route('singleArticle', $category->slug)."/#primaryimage"
        ],
        "image"=>[
            "@id"=>route('singleArticle', $category->slug)."/#primaryimage"
        ],
        "thumbnailUrl"=>$articleImage,
        "breadcrumb"=>[
            "@id"=>route('singleArticle', $category->slug)."/#breadcrumb"
        ],
        "inLanguage"=>"en-US"
    ];

    $imageObj = [
        "@type"=>"ImageObject",
        "inLanguage"=>"en-US",
        "@id"=>route('singleArticle', $category->slug)."/#primaryimage",
        "url" =>$articleImage,
        "contentUrl"=>$articleImage,
        "width" => 728,
        "height" => 455,
        "caption"=>$firstArticle? $firstArticle->featured_image_alt_text:''
    ];

    $breadcrumb = [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'item' => [
                    '@id' => url('/'),
                    'name' => 'Home',
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'item' => [
                    '@id' => route('singleArticle', $category->slug),
                    'name' => $category->title,
                ],
            ]
        ],
    ];

    $schemaObj = [[
        "@context" => "https://schema.org",
        "@graph" => [
            $collectionPage,
            $imageObj,
            $breadcrumb,
            getWebSchema()
        ]
    ]];
    return returnSchemaScriptTag(json_encode($schemaObj,JSON_UNESCAPED_SLASHES));
}


function getTagSchema($tag){

    $firstArticle = $tag->articles()->orderBy('published_at')->first();
    $collectionPage = [
        "@type"=>"CollectionPage",
        "@id"=>route('tags', $tag->slug),
        "url"=>route('tags', $tag->slug),
        "name"=>$tag->title,
        "isPartOf"=>[ "@id"=>route('home')."/#website" ],
        "primaryImageOfPage"=>[
            "@id"=>route('tags', $tag->slug)."/#primaryimage"
        ],
        "image"=>[
            "@id"=>route('tags', $tag->slug)."/#primaryimage"
        ],
        "thumbnailUrl"=>asset($firstArticle->image),
        "breadcrumb"=>[
            "@id"=>route('tags', $tag->slug)."/#breadcrumb"
        ],
        "inLanguage"=>"en-US"
    ];

    $imageObj = [
        "@type"=>"ImageObject",
        "inLanguage"=>"en-US",
        "@id"=>route('tags', $tag->slug)."/#primaryimage",
        "url" => asset($firstArticle->image),
        "contentUrl"=>asset($firstArticle->image),
        "width" => 728,
        "height" => 455,
        "caption"=>$firstArticle->featured_image_alt_text
    ];

    $breadcrumb = [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'item' => [
                    '@id' => url('/'),
                    'name' => 'Home',
                ],
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'item' => [
                    '@id' => route('tags', $tag->slug),
                    'name' => $tag->title,
                ],
            ]
        ],
    ];

    $schemaObj = [[
        "@context" => "https://schema.org",
        "@graph" => [
            $collectionPage,
            $imageObj,
            $breadcrumb,
            getWebSchema()
        ]
    ]];
    return returnSchemaScriptTag(json_encode($schemaObj,JSON_UNESCAPED_SLASHES));
}


function getImageMeta($url)
{
    if (!$url) {
        return null;
    }
    $url = asset($url);
    $image = file_get_contents(str_replace(' ','%20',$url));
    [$width, $height] = getimagesizefromstring($image);
    return [
        '@type' => 'ImageObject',
        'url' => $url,
        'width' => $width,
        'height' => $height,
    ];
    // return $image;
}


function getImgTagSrcFromHtml($html){
    // regex for img tag src
    preg_match_all('/<img[^>]*src=([\'"])(?<src>.+?)\1[^>]*>/i', $html, $match);
    return $match['src'];
}



function returnSchemaScriptTag($json)
{
    return '<script type="application/ld+json">' . $json . '</script>';
}


function getOrganizationSchema(){
    $orgSchema = [
        "@type" => "Organization",
        "name"=> getSettingValue('website_title'),
        "url"=> route('home'),
        "logo"=> getImageMeta(getSettingValue('favicon')),
    ];
    return $orgSchema;
}


function getWebSchema(){
    $webSchema = [
        "@type" => "Website",
        "@id"=> route('home').'/#website',
        "url"=> route('home').'/',
        "name"=> getSettingValue('website_title'),
        "description"=> getSettingValue('slogan'),
        "inLanguage"=> "en-US"
    ];
    return $webSchema;
}

