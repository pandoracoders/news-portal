<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\Backend\RoleController;
use App\Models\Backend\Article;
use App\Models\Backend\ArticleTitle;
use App\Models\Backend\Role;
use App\Models\Backend\TableSet;
use App\Models\Backend\Tag;
use App\Models\Backend\User;
use Database\Factories\ArticleFactory;
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
        $tags = ["Biography", "Fiction", "Non-Fiction", "Poetry", "Short Story", "Poem", "Normal", "Long Story", "fact"];
        // $roles = ["Super Admin", "Writer", "Editor"];
        $roles = [
            [
                "title" => "Super Admin",
                "permissions" => RoleController::getSuperAdminPermission(),
            ],
            [
                "title" => "Writer",
                "permissions" => config("constants.writer_permissions"),
            ],
            [
                "title" => "Editor",
                "permissions" => config("constants.editor_permissions"),
            ],
        ];

        foreach ($roles as $key => $role) {
            Role::create($role);
        }


        $this->call([CategorySeeder::class, UserSeeder::class]);

        foreach ($tags as $tag) {
            Tag::create([
                'title' => $tag,
                'slug' => str_slug($tag),
            ]);
        }

        $table_set = TableSet::create([
            "title" => "Quick Facts",
        ]);

        $table_set->categories()->sync([1]);

        $table_fields = [
            [
                "title" => "Birthday",
                "type" => "date",
                "searchable" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Country",
                "type" => "text",
                "searchable" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Full Name",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ];

        $table_set->tableFields()->createMany($table_fields);

        ArticleTitle::create([
            "title" => "Facebook",
            "category_id" => 1,
        ]);

        Article::factory(100)->create()->each(function ($article) {
            $this->articleTag($article);
        });
    }



    protected function articleTag($article)
    {
        $tags = Tag::all()->random(3);
        $article->tags()->attach($tags);
    }
}
