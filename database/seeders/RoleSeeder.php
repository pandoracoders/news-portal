<?php

namespace Database\Seeders;

use App\Http\Controllers\Backend\RoleController;
use App\Models\Backend\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                "title" => "Super Admin",
                "slug" => "super-admin",
                "permissions" => RoleController::getSuperAdminPermission(),
            ],
            [
                "title" => "Writer",
                "slug" => "writer",
                "permissions" => config("constants.writer_permissions"),
            ],
            [
                "title" => "Editor",
                "slug" => "editor",
                "permissions" => config("constants.editor_permissions"),
            ],
        ];

        foreach ($roles as $key => $role) {
            Role::create($role);
        }
    }
}
