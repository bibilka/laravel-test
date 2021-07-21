<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        // all other exceptions
        if ($ex instanceof Exception) {
            return responder()->error('unknown_error', 'Неизвестная ошибка')->respond(500);
        }

        return parent::render($request, $ex);
    }
}
