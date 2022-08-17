<?php

namespace Database\Seeders;

use App\Http\Controllers\Backend\RoleController;
use App\Models\Backend\Role;
use App\Models\Backend\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // super admin
        User::create([
            'name' => 'Pradip Parajuli',
            'email' => 'prad4787@gmail.com',
            'password' => bcrypt('password'),
            "alias_name" => "Pradip Parajuli",
            "slug" => "pradip-parajuli",
        ])->permission()->create([
            "role_id" => Role::where("title", "Super Admin")->first()->id,
            "permissions" => config("constants.permissions"),
        ]);
        User::create([
            'name' => 'Sandip Dangal',
            'email' => 'sandipdangal77@gmail.com',
            'password' => bcrypt('password'),
            "alias_name" => "Ray",
            "slug" => "ray",
        ])->permission()->create([
            "role_id" => Role::where("title", "Super Admin")->first()->id,
            "permissions" => config("constants.permissions"),
        ]);

        // for ($i = 0; $i < 5; $i++) {
        //     $id = $i > 0 ? $i : '';
        //     User::create([
        //         'name' => "Writer $id",
        //         'email' => "writer$id@gmail.com",
        //         'password' => bcrypt('password'),
        //         "alias_name" => "Writer $id",
        //         "slug" => "writer$id",
        //     ])->permission()->create([
        //         "role_id" => Role::where("title", "Writer")->first()->id,
        //         "permissions" => config("constants.writer_permissions"),

        //     ]);

        //     User::create([
        //         'name' => "Editor $id",
        //         'email' => "editor$id@gmail.com",
        //         'password' => bcrypt('password'),
        //         "alias_name" => "Editor $id",
        //         "slug" => "editor$id",
        //     ])->permission()->create([
        //         "role_id" => Role::where("title", "Editor")->first()->id,
        //         "permissions" => config("constants.editor_permissions"),
        //     ]);
        // }
    }
}
