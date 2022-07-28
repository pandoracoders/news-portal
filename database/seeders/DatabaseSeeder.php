<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Backend\ArticleTitle;
use App\Models\Backend\TableSet;
use App\Models\Backend\Tag;
use App\Models\User;
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
        $tags = ["Biography", "Fiction", "Non-Fiction", "Poetry", "Short Story"];

        User::create([
            'name' => 'Pradip Parajuli',
            'email' => 'prad4787@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Writer',
            'email' => 'writer@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('password'),
        ]);



        $this->call(CategorySeeder::class);

        foreach ($tags as $tag) {
            Tag::create([
                'title' => $tag,
                'slug' => \Str::slug($tag),
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
    }
}
