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
                "title" => "Popular Name",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Birth Place",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Birth Year",
                "type" => "text",
                "searchable" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "title" => "Birth Day",
                "type" => "text",
                "searchable" => true,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Death Year",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "title" => "Death Day",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Death Cause",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Nationality",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Ethnicity",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Father",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Mother",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Siblings",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Profession",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Net Worth",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Height",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Weight",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Eye Color",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Hair Color",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Body Measurement",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Gender Identity",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Marital Status",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Spouse",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "Children",
                "type" => "text",
                "searchable" => false,
                "created_at" => now(),
                "updated_at" => now(),
            ],

        ];

        $table_set->tableFields()->createMany($table_fields);
    }
}
