<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    public function rules(): array
    {
        $clientId = $this->input('client_id');

        return [
            'payment' => 'required|string',
            'remain' => 'required|numeric|min:0',
            'client_id' => $clientId != 0 ? 'integer|min:1' : 'required|integer|exists:clients,id',
            'client_firstname' => $clientId == 0 ? 'required|string' : '',
            'client_lastname' => $clientId == 0 ? 'nullable|string' : '',
            'client_phone' => $clientId == 0 ? 'nullable|string' : '',
            'client_address' => $clientId == 0 ? 'nullable|string' : '',
            'products' => 'required|array',
            'products.*' => 'required|integer|min:1',
        ];
    }
}
