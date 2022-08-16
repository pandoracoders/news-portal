<?php

namespace Database\Seeders;

use App\Models\Backend\TableSet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $table_set = TableSet::create([
            "title" => "Quick Facts",
        ]);

        $table_fields = [
            [
                "title" => "Full Name",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "BirthYear",
                "type" => "text",
                "searchable" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "BirthMonth",
                "type" => "text",
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

        ];

        $table_set->tableFields()->createMany($table_fields);
    }
}
