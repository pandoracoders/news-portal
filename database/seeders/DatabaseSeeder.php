<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\Backend\RoleController;
use App\Models\Backend\Article;
use App\Models\Backend\ArticleTitle;
use App\Models\Backend\Role;
use App\Models\Backend\TableSet;
use App\Models\Backend\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TableSeeder::class,
            WPSeeder::class,
            PageSeeder::class,
        ]);

        // Article::factory(100)->create()->each(function ($article) {
        //     $this->articleTag($article);
        // });
    }



    protected function articleTag($article)
    {
        $tags = Tag::all()->random(3);
        $article->tags()->attach($tags);
    }
}
