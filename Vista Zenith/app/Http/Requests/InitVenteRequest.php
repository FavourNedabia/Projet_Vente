<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitVenteRequest extends FormRequest
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
    public function rules()
    {
        return [
            'products' => 'required|array',
            'products.*' => 'exists:articles,id',
            'client' => $this->input('client') == 0 ? '' : 'required|integer|exists:clients,id',
            'firstname' => $this->input('client') == 0 ? 'required|string' : '',
            'lastname' => $this->input('client') == 0 ? 'nullable|string' : '',
            'phone' => $this->input('client') == 0 ? 'nullable|string' : '',
            'address' => $this->input('client') == 0 ? 'nullable|string' : '',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Please select or add new client.',
        ];
    }
}
