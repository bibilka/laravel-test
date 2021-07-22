<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $user = User::whereEmail($request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return responder()->error(null, 'Предоставленные данные некорректны.')->respond(401);
        }

        return responder()->success(['token' => $user->createToken('TestApp')->plainTextToken]);
    }
}
