<?php

namespace Database\Seeders;

use App\Models\Backend\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'Biography',
            "slug" => "biography",
        ]);
    }
}
