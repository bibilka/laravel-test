<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Создание таблицы под модель "Персонаж".
 */
class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // имя
            $table->date('birthday'); // дата рождения
            $table->json('occupations'); // профессии / умения
            $table->string('img'); // фото
            $table->string('nickname'); // известен как
            $table->string('portrayed'); // актер
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
