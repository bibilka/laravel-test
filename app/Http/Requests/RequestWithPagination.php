<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestWithPagination extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => 'integer|min:1',
            'page' => 'integer|min:1',

            // deny "Including From Query String" (flugg/responder) 
            'with' => 'prohibited',
            // deny "Filtering From Query String" (flugg/responder)
            'only' => 'prohibited'
        ];
    }
}
