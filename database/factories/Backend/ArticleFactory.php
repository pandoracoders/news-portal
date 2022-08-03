<?php

namespace Database\Factories\Backend;

use App\Models\Backend\Category;
use App\Models\Backend\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->title,
            "slug" => $this->faker->slug,
            "summary" => $this->faker->text,
            "body" => $this->faker->text,
            "image" => $this->faker->imageUrl,
            "editor_choice" => $this->faker->boolean,
            "category_id" => function () {
                return Category::first()->id;
            },
            "writer_id" => function () {
                return User::where("slug", "writer")->first()->id;
            },
            "editor_id" => function () {
                return User::where("slug", "editor")->first()->id;
            },
            "published_at" => $this->faker->dateTime,
            "is_featured" => $this->faker->boolean,
            "views" => $this->faker->numberBetween(100, 10000),
            "tables" => function () {
                $tables = [];
                foreach (Category::first()->tables as $table) {
                    foreach ($table->tableFields as $field) {
                        if ($field->type == "url") {
                            $tables[$table->title][str_slug($field->title)] = getTableFieldArray($field, $this->faker->url);
                        } else if ($field->type == "date") {
                            $tables[$table->title][str_slug($field->title)] = getTableFieldArray($field, Carbon::parse($this->faker->date)->format("M d, Y"));
                        } else
                            if ($field->title == "Full Name") {
                            $tables[$table->title][str_slug($field->title)] = getTableFieldArray($field, $this->faker->name);
                        } else if ($field->title == "Country") {
                            $tables[$table->title][str_slug($field->title)] = getTableFieldArray($field, $this->faker->country);
                        } else {
                            $tables[$table->title][str_slug($field->title)] = $this->faker->text;
                        }
                    }
                }
                return $tables;
            }
        ];
    }
}
