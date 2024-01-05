<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectMemberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'member_id' => 'required|exists:members,id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
