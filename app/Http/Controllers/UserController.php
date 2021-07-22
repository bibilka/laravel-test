<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    /**
     * Создает токен для доступа к апи.
     * @param TokenRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function token(TokenRequest $request)
    {
        // проверяем что существует пользователь с таким email и пароли совпадают
        $user = User::whereEmail($request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return responder()->error(null, 'Предоставленные данные некорректны.')->respond(401);
        }

        // удаляем все старые токены
        if ($user->tokens->count() > 0) {
            foreach ($user->tokens as $token) {
                $token->delete();
            }
        }

        // возвращаем новый сгенерированный токен
        return responder()->success(['token' => $user->createToken('TestApp')->plainTextToken]);
    }
}
