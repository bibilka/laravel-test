<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

/**
 * Задача CalculateTotalApiRequests.
 * Считает общее кол-во запросов к апи.
 */
class CalculateTotalApiRequests implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('test');
        $total = 0;

        $pattern = Str::replace('{id}', '*', config('api.cache_keys.user_stats'));

        // вытаскиваем все ключи редиса по шаблону
        foreach (Redis::keys($pattern) as $key) {

            // $key = Str::replace(config('database.redis.options.prefix'), '', $key);
            $total += Redis::get($key);
        }
        Log::debug($total);
        // складываем посчитанное значение в кэш
        Redis::set(config('api.cache_keys.total_stats'), $total);
    }
}
