<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => 'required',
            'transaction_id' => 'required|integer'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
