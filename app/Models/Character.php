<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Персонаж.
 * 
 * @property int $id 
 * @property string $name Имя
 * @property \Illuminate\Support\Carbon $birthday Дата рождения
 * @property array $occupations Профессии, умения
 * @property string $img Фото
 * @property string $nickname Известен как (кличка)
 * @property string $portrayed Актер, сыгравший персонажа
 * 
 * @property-read Quote $quotes Цитаты, которые приндалежат этому персонажу
 * @property-read Episode $episodes Эпизоды, в которых был этот персонаж
 * 
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder wherePortrayed($value)
 */
class Character extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Преобразование некоторых аттрибутов.
     * @var array
     */
    protected $casts = [
        'occupations' => 'array',
        'birthday' => 'datetime:Y-m-d',
    ];

    // adding the appends value will call the accessor in the JSON response
    protected $appends = ['quotes_ids', 'episodes_ids'];

    // скрываем атрибут с полным списком полей цитат
    protected $hidden = ['quotes', 'episodes'];
    
    /**
     * Цитаты, которые приндалежат этому персонажу.
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    /**
     * Эпизоды, в которых был этот персонаж.
     */
    public function episodes()
    {
        // получаем эпизоды как, неповторяющиеся значения поля episode_id из цитат персонажа
        return $this->belongsToMany(Episode::class, 'quotes')->distinct();
    }

    /**
     * Аттрибут 'quotes_ids'.
     * @return array
     */
    public function getQuotesIdsAttribute()
    {
        return $this->quotes->pluck('id');
    }

    /**
     * Аттрибут 'episodes_ids'.
     * @return array
     */
    public function getEpisodesIdsAttribute()
    {
        return $this->episodes->pluck('id');
    }
}
