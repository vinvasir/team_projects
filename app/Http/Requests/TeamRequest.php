<?php

namespace App\Http\Requests;

class TeamRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
