<?php

declare(strict_types=1);

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class ChangeManagersRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'managers' => 'required',
        ];
    }
}
