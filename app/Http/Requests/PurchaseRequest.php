<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'client_id' => 'required|numeric|exists:clients,id',
            'payment_method' => 'required|string|in:Cartão de crédito,Boleto,Pix',
            'products' => 'required|array',
            'price' => 'required|numeric',
            'installments' => 'required|array',
        ];
    }
}
