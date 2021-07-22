<?php

namespace App\Listeners;

use App\Events\ApiRequestHit;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

/**
 * Инкриментирует статистику вызова апи конкретного пользователя.
 */
class IncrementApiStats
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ApiRequestHit  $event
     * @return void
     */
    public function handle(ApiRequestHit $event)
    {
        $key = Str::replace('{id}', $event->user->id, config('api.cache_keys.user_stats'));

        Redis::incr($key);
    }
}
