<?php

namespace App\Http\Requests;

class MemberRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'country' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
