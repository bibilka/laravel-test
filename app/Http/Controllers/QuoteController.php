<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Http\Requests\RequestWithPagination;
use App\Models\Quote;
use Illuminate\Http\Request;

/**
* Контроллер для работы с сущностью "цитата".
*/
class QuoteController extends ApiController
{
   /**
    * Отдает список всех цитат.
    * @param Request $request
    * 
    * @return \Illuminate\Http\JsonResponse
    */
   public function index(RequestWithPagination $request)
   {
       $data = Quote::paginate($this->limit);

       return responder()->success($data);
   }

   /**
    * Отдает случайную цитату.
    *
    * @param  QuoteRequest $request
    * @return \Illuminate\Http\Response
    */
   public function random(QuoteRequest $request)
   {
       $query = Quote::query();

        if ($request->has('author')) {
            $query->whereHas('character', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->author}%");
            });
        }

        $data = $query->inRandomOrder()->firstOrFail();

        return responder()->success($data);
   }
}

