<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:13',
            'country' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
            'street' => 'required|string',
            'managers' => 'required',
            'contract_date' => 'date_format:Y-m-d',
            'contract_expiration' => 'date_format:Y-m-d',
            'file' => 'required|mimes:pdf'
        ];
    }
}
