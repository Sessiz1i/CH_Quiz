<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(5,8);
        $status= ['active','passive','draft'];
        return [
            'title' => Str::title($title),
            'slug' => Str::slug($title),
            'description' => $this->faker->text(200),
            'status' => $status[rand(0, count($status) - 1)]
        ];
    }
}
