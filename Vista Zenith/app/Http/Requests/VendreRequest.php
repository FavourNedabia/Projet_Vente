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
        $customerId = $this->input('customer_id');

        return [
            'payment' => 'required|string',
            'remaining_amount' => 'required|numeric|min:0',
            'customer_id' => $customerId == 0 ? 'integer|min:0' : 'required|integer|exists:customers,id',
            'customer_firstname' => $customerId == 0 ? 'required|string' : '',
            'customer_lastname' => $customerId == 0 ? 'nullable|string' : '',
            'customer_phone' => $customerId == 0 ? 'nullable|string' : '',
            'customer_address' => $customerId == 0 ? 'nullable|string' : '',
            'products' => 'required|array',
            'products.*' => 'required|integer|min:1',
        ];
    }
}
