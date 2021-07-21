<?php

namespace App\Http\Requests;

class CharacterRequest extends RequestWithPagination
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
        $rules = [
            'name' => 'string|min:2|max:100|filled'
        ];
        
        return array_merge($rules, parent::rules());
    }
}
