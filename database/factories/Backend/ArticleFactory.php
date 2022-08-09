<?php

namespace Database\Factories\Backend;

use App\Models\Backend\Category;
use App\Models\Backend\Role;
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

        // check dir
        $dir = "public/fake-images";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $category = Category::find(random_int(1, Category::count()));
        $published_at = $this->faker->boolean ? $this->faker->dateTime : '';
        return [
            "title" => $this->faker->sentence(random_int(10, 15)),
            "slug" => str_slug($this->faker->sentence(random_int(10, 15))),
            "summary" => $this->faker->text,
            "body" => $this->faker->sentence(random_int(500, 1000)),
            "image" => rescue(function () use ($dir) {
                return  getRandomImage($dir);
            }, uploadImageFromUrl("https://source.unsplash.com/random/300×300", $dir)),
            "editor_choice" => $this->faker->boolean,
            "category_id" => $category->id,
            "writer_id" => User::find(random_int(2, User::count()))->id,
            "editor_id" => Role::where("title", "Editor")->first()->users->random(1)[0]->id,
            "published_at" => carbon($published_at),
            "task_status" => $published_at ? "published" : config("constants.task_status")[random_int(0, 3)],
            "is_featured" => $this->faker->boolean,
            "views" => $this->faker->numberBetween(100, 10000),
            "tables" => function () use ($category) {
                if ($category->id == 1) {
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
                return null;
            }
        ];
    }
}
