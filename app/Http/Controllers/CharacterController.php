<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use Illuminate\Http\Request;

/**
 * Контроллер для работы с сущностью "Персонаж".
 */
class CharacterController extends ApiController
{
    /**
     * Отдает список всех персонажей.
     * @param CharacterRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CharacterRequest $request)
    {
        $query = Character::query();

        if ($request->has('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        $data = $query->paginate($this->limit);

        return responder()->success($data);
    }

    /**
     * Отдает случайного персонажа.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function random(Request $request)
    {
        $data = Character::inRandomOrder()->firstOrFail();

        return responder()->success($data);
    }
}
