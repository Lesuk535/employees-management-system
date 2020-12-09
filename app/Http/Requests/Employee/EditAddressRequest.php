<?php

declare(strict_types=1);

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditAddressRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'country' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
            'street' => 'required|string',
        ];
    }
}
