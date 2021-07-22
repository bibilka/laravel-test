<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

/**
 * Контроллер отвечающий за выдачу информации по статистике запросов к апи.
 */
class StatisticController extends Controller
{
    /**
    * Отдает статистику текущего авторизованного пользователя.
    * @param Request $request
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function my(Request $request) 
    {
        $key = Str::replace('{id}', $request->user()->id, config('api.cache_keys.user_stats'));

        return responder()->success([
            'stats' => Redis::get($key)
        ]);
    }

    /**
    * Отдает общую статистику запросов к апи.
    * @param Request $request
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function total(Request $request) 
    {
        return responder()->success([
            'stats' => Redis::get(config('api.cache_keys.total_stats'))
        ]);
    }
}
