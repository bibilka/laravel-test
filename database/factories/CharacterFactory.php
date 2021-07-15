<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * @return array
     */
    private function occupations()
    {
        return [
            'Chemist',
            'Chemistry Teacher',
            'Writer',
            'Bookkeeper',
            'Taxi Dispatcher',
            'Methamphetamine manufacturer',
            'Methamphetamine distributor',
            'Agent of the Drug Enforcement Administration'
        ];
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,

            // пускай персонаж не может быть младше 15 лет
            'birthday' => $this->faker->date('Y-m-d', '-15 years'),

            // выбираем случайный набор профессий из предложенного списка (мин 1, макс 3)
            'occupations' => $this->faker->randomElements(
                $this->occupations(), rand(1, 3)
            ),

            // получаем ссылку на случайное изображение из категории люди
            'img' => $this->faker->unique()->imageUrl(640, 480, 'people'),
            
            'nickname' => $this->faker->unique()->word,
            'portrayed' => $this->faker->unique()->name
        ];
    }
}
