    <?php
    use App\Models\Backend\Article;
    use Illuminate\Support\Facades\Cache;

    if (!function_exists('getImageMeta')) {
        function getImageMeta($url)
        {
            $url = asset($url);
            $image = file_get_contents($url);
            [$width, $height] = getimagesizefromstring($image);
            return [
                '@type' => 'ImageObject',
                'url' => $url,
                'width' => $width,
                'height' => $height,
            ];
            // return $image;
        }
    }

    if (!function_exists('getImgTagSrcFromHtml')) {
        function getImgTagSrcFromHtml($html)
        {
            // regex for img tag src
            preg_match_all('/<img[^>]*src=([\'"])(?<src>.+?)\1[^>]*>/i', $html, $match);
            return $match['src'];
        }
    }

    if (!function_exists('returnSchemaScriptTag')) {
        function returnSchemaScriptTag($json)
        {
            return '<script type="application/ld+json">' . $json . '</script>';
        }
    }

    if (!function_exists('getOrganizationSchema')) {
        function getOrganizationSchema($schema_only = false)
        {
            $schema = Cache::rememberForever('home_page', function () {
                return $schema = [
                    '@context' => 'http://schema.org',
                    '@type' => 'Organization',
                    'name' => getSettingValue('website_title'),
                    'logo' => getImageMeta(getSettingValue('logo')),
                    'url' => url('/'),
                    'sameAs' => getSettingType('social-media')
                        ->pluck('value')
                        ->toArray(),
                    'contactPoint' => [
                        '@type' => 'ContactPoint',
                        'email' => getSettingValue('contact_email'),
                        'contactType' => 'customer service',
                    ],
                ];
            });
            return $schema_only ? $schema : returnSchemaScriptTag(json_encode($schema));
        }
    }

    if (!function_exists('getArticleSchema')) {
        function getArticleSchema($article)
        {
            // breadcrumb schema
            $schema = Cache::rememberForever('single', function () use ($article) {
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

                $images = getImgTagSrcFromHtml(Article::first()->body);
                array_push($images, asset($article->image));
                return $schema = [
                    '@context' => 'http://schema.org',
                    '@type' => 'NewsArticle',
                    'mainEntityOfPage' => [
                        '@type' => 'WebPage',
                        '@id' => route('singleArticle', $article->slug),
                        'name' => $article->title,
                        'breadcrumb' => $breadcrumbSchema,
                    ],
                    'headline' => $article->title,
                    // multiple images
                    'image' => array_map('getImageMeta', $images),
                    'datePublished' => $article->published_at->format('Y-m-d'),
                    'dateModified' => $article->updated_at->format('Y-m-d'),
                    'author' => [
                        '@type' => 'Person',
                        'name' => $article->author->name,
                    ],
                    'publisher' => getOrganizationSchema(true),
                    'description' => $article->summary,
                    'text' => strip_tags($article->body),
                    'keywords' => implode(', ', $article->tags->pluck('title')->toArray()) . ', ' . $article->category->title . ', ' . $article->seo->meta_keywords,
                ];
            });
            return returnSchemaScriptTag(json_encode($schema));
        }
    }
