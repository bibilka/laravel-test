<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Базовый контролер для работы с апи.
 * 
 * @property int $limit Лимит для запросов с пагинацией.
 */
class ApiController extends Controller
{
    /**
     * @var int $limit
     */
    protected $limit;

    /**
     * Controller contsruct method.
     * @param Request $request
     */
    public function __construct(Request $request) 
    {
        // устанавливаем значение "limit" либо из запроса, либо из значения по умолчанию в конфиге
        $this->limit = $request->input('limit', config('pagination.limit'));
    }
}