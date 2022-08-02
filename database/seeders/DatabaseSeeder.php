<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\Backend\RoleController;
use App\Models\Backend\ArticleTitle;
use App\Models\Backend\Role;
use App\Models\Backend\TableSet;
use App\Models\Backend\Tag;
use App\Models\Backend\User;
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

        $user = User::create([
            'name' => 'Pradip Parajuli',
            'email' => 'prad4787@gmail.com',
            'password' => bcrypt('password'),
            "alias_name" => "Pradip Parajuli",
            "slug" => "pradip-parajuli",
        ])->permission()->create([
            "role_id" => Role::where("title", "Super Admin")->first()->id,
            "permissions" => RoleController::getSuperAdminPermission(),
        ]);
        $user = User::create([
            'name' => 'Sandip Dangal',
            'email' => 'sandipdangal77@gmail.com',
            'password' => bcrypt('password'),
            "alias_name" => "Ray",
            "slug" => "ray",
        ])->permission()->create([
            "role_id" => Role::where("title", "Super Admin")->first()->id,
            "permissions" => RoleController::getSuperAdminPermission(),
        ]);



        User::create([
            'name' => 'Writer',
            'email' => 'writer@gmail.com',
            'password' => bcrypt('password'),
            "alias_name" => "Writer",
            "slug" => "writer",
        ])->permission()->create([
            "role_id" => Role::where("title", "Writer")->first()->id,
            "permissions" => config("constants.writer_permissions"),

        ]);

        User::create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('password'),
            "alias_name" => "Editor",
            "slug" => "editor",
        ])->permission()->create([
            "role_id" => Role::where("title", "Editor")->first()->id,
            "permissions" => config("constants.editor_permissions"),
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
