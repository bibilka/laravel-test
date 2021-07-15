<?php

namespace Database\Factories;

use App\Models\Episode;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Episode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->realText(15),

            // будем отталкиваться от дат выхода эпизодов сериала (2008 - 2012 гг)
            'air_date' => $this->faker->unique()->dateTimeBetween('-13 years', '-9 years')
        ];
    }
}
