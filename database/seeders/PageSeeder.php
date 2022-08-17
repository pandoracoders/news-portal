<?php

namespace Database\Seeders;

use App\Models\Backend\WebSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(base_path("database/seeders/json/pages.json"));
        $data = json_decode($json, true);

        foreach ($data as $page) {
            WebSetting::create($page);
        }
    }
}
