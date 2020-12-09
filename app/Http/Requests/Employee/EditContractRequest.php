<?php

declare(strict_types=1);

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EditContractRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'contract_expiration' => 'required|date_format:Y-m-d',
            'file' => 'mimes:pdf'
        ];
    }
}
