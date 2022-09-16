<?php

namespace App\Console\Commands;

use App\Models\Backend\Article;
use App\Models\Backend\Category;
use App\Models\Backend\Tag;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $static_routes = ["home"];
        $category = Category::select("slug", "updated_at")->get();
        $tags = Tag::select("slug", "updated_at")->get();
        $articles = Article::select("slug", "updated_at")->get();
        $file_content = view("frontend.pages.sitemap.index", compact("static_routes", "category", "tags", "articles"))->render();

        $file = fopen(public_path("sitemap.xml"), "w");
        fwrite($file, $file_content);
        fclose($file);
        return 0;
    }
}
