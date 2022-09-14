<?php

namespace Database\Seeders;

use App\Models\Backend\Article;
use App\Models\Backend\Category;
use App\Models\Backend\Role;
use App\Models\Backend\Tag;
use App\Models\Backend\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = file_get_contents(base_path("database/seeders/json/wikibioages.json"));
        $data = json_decode($json, true);

        foreach ($data as $key => $post) {
            // create author

            $author = User::updateOrCreate(["slug" => $post["author"]["user_nicename"]], [
                "name" => $post["author"]["display_name"],
                "email" => $post["author"]["user_email"],
                "password" => bcrypt("@pandora@"),
                "alias_name" => $post["author"]["display_name"]
            ]);
            
            $author->permission()->updateOrCreate(["user_id" => $author->id], [
                "role_id" => Role::where("title", "Writer")->first()->id,
                "permissions" => config("constants.writer_permissions"),

            ]);
            // create of find category
            $category = Category::firstOrCreate($post['category'][0]);


            $article_data = (array_merge($post, [
                "slug" => $post["task_status"] == "publish" ? $post["slug"] : str_slug($post["title"]),
                'category_id' => $category->id,
                'writer_id' => $author->id,
                'editor_id' => 1,
                "image" => replaceOrigin($post["feature_image"]),
                "body" => wrapByPTag(convertCaption(replaceOrigin($post["body"]))),
                "task_status" => $post["task_status"] == "publish" ? "published" : "submitted"
            ]));

            $article_data = collect($article_data)->except(["tags", "category", "feature_image", "meta_data", "author"])->toArray();

            $article = (Article::create($article_data));

            $article->seo()->create($post["meta_data"]);

            $tags = [];
            foreach ($post["tags"] as $key => $tag) {
                $tags[] = Tag::firstOrCreate($tag)->id;
            }
            $article->tags()->attach($tags);
        }
    }
}
