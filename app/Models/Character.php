<?php

namespace App\Models;

use App\Transformers\CharacterTransformer;
use Flugg\Responder\Contracts\Transformable;
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
class Character extends Model implements Transformable
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

    /**
     * Поля недоступные для просмотра.
     * @var array
     */
    protected $hidden = ['pivot'];
    
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
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|string|callable
     */
    public function transformer()
    {
        return CharacterTransformer::class;
    }
}
