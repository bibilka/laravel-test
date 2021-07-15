<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Episode;
use App\Models\Quote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * 30 эпизодов, 100 персонажей и ~500 цитат.
     * 
     * На 1 эпизод по 5-15 персонажей, на 1 персонажа по 3-7 цитат.
     * (Это условие лучше уменьшить, иначе итоговое кол-во цитат получается ~1250)
     *
     * @return void
     */
    public function run()
    {
        // очищаем таблицы
        DB::table('quotes')->delete();
        DB::table('characters')->delete();
        DB::table('episodes')->delete();

        /** 
         * создаем 100 случайных персонажей
         * @see \Database\Factories\CharacterFactory 
         * @var array
        */
        $charactersIds = Character::factory(100)->create()->pluck('id')->toArray();

        /** 
         * создаем 30 эпизодов
         * @see \Database\Factories\EpisodeFactory 
        */
        Episode::factory(30)->create()->each(function(Episode $episode) use ($charactersIds) {

            // на каждый созданный эпизод, выбираем случайное число персонажей от 3 до 10
            for ($i = 0; $i < rand(3, 10); $i++) {

                // и для каждого персонажа создаем 2-5 цитат
                $randomCharacter = Arr::random($charactersIds);

                for ($j = 0; $j < rand(2, 5); $j++) {

                    $quote = new Quote();

                    // пусть цитата это случайное предложение от 1 до 15 слов
                    $quote->quote = (\Faker\Factory::create())->sentence(rand(1, 15));

                    $quote->character_id = $randomCharacter;
                    $quote->episode_id = $episode->id;

                    $quote->save();
                }
            }
        });
    }
}
