<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Эпизод.
 * 
 * @property int $id 
 * @property string $title Название
 * @property \Illuminate\Support\Carbon $air_date Дата выхода
 * 
 * @property-read Quote $quotes Цитаты, которые были в эпизоде
 * @property-read Character $characters Персонажи, которые участвовали в эпизоде
 * 
 * @method static \Illuminate\Database\Eloquent\Builder whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereAirDate($value)
 */
class Episode extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Преобразование некоторых аттрибутов.
     * @var array
     */
    protected $casts = [
        'air_date' => 'datetime:Y-m-d',
    ];

    /**
     * Цитаты, которые были в эпизоде.
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    /**
     * Персонажи, которые участвовали в эпизоде.
     */
    // public function characters()
    // {
    //     return $this->hasManyThrough(Character::class, Quote::class);
    // }
}
