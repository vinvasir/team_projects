<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberTeamRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'team_id' => 'required|exists:teams,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
