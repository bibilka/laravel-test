<?php

namespace App\Models;

use App\Transformers\QuoteTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Цитата.
 * 
 * @property int $id 
 * @property string $quote Цитата
 * 
 * @property-read Episode $episode Эпизод, в котором была эта цитата.
 * @property-read Character $character ерсонаж, кому принадлежит эта цитата.
 * 
 * @method static \Illuminate\Database\Eloquent\Builder whereQuote($value)
 */
class Quote extends Model implements Transformable
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['episode_id', 'character_id'];

    /**
     * Эпизод, в котором была эта цитата.
     */
    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

    /**
     * Персонаж, кому принадлежит эта цитата.
     */
    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|string|callable
     */
    public function transformer()
    {
        return QuoteTransformer::class;
    }
}
