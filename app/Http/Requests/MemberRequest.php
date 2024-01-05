<?php

namespace App\Http\Requests;

use DougSisk\CountryState\CountryState;

class MemberRequest extends ApiFormRequest
{
    public function rules()
    {
        $validStateRule = 'nullable';
        if (is_string($this->input('country')) && array_key_exists($this->input('country'), (new CountryState)->getCountries())) {
            $states = array_keys((new CountryState)->getStates($this->input('country')));

            $validStateRule = 'nullable|in:' . implode(',', $states);
        }

        return [
            'team_id' => 'required|exists:teams,id',
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'city' => ['nullable'],
            'state' => $validStateRule,
            'country' => 'nullable|in:' . implode(',', array_keys((new CountryState)->getCountries())),
        ];
    }

    public function authorize()
    {
        return true;
    }
}
