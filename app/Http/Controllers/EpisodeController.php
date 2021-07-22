<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestWithPagination;
use App\Models\Episode;
use Illuminate\Http\Request;

/**
 * Контроллер для работы с сущностью "Эпизод".
 */
class EpisodeController extends ApiController
{
    /**
     * Отдает список всех эпизодов.
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RequestWithPagination $request)
    {
        $data = Episode::paginate($this->limit);
        return responder()->success($data);
    }

    /**
     * Отдает эпизод по ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $items = Episode::findOrFail($id);
        return responder()->success($items)->with('characters');
    }
}
