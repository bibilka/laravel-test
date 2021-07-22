<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Flugg\Responder\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, \Throwable $ex)
    {
        if ($request->wantsJson()) {
            // This will replace our 404 response with
            // a JSON response.
            if ($ex instanceof ModelNotFoundException || $ex instanceof NotFoundHttpException) {
                return responder()->error('not_found', 'Не найдено')->respond(404);
            }
            
            // validation exception
            if ($ex instanceof ValidationException) {
                return responder()
                    ->error('validation_error', 'Невалидный запрос')
                    ->data(['errors' => $ex->errors()])
                    ->respond($ex->status);
            }

            // auth exception
            if ($ex instanceof AuthenticationException) {
                return responder()->error('unautorized', $ex->getMessage())->respond(401);
            }

            // method not allowed exception
            if ($ex instanceof MethodNotAllowedHttpException) {
                return responder()->error('bad_method', $ex->getMessage())->respond(405);
            }

            // too many requests
            if ($ex instanceof TooManyRequestsHttpException) {
                return responder()->error('too_many_requests', $ex->getMessage())->respond($ex->getStatusCode());
            }

            // all other exceptions
            if ($ex instanceof Exception) {
                return responder()->error('unknown_error', 'Неизвестная ошибка')->respond(500);
            }
        }
        
        return parent::render($request, $ex);
    }
}
