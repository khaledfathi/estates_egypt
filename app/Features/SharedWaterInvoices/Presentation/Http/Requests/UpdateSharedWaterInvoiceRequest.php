<?php

namespace App\Features\SharedWaterInvoices\Presentation\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSharedWaterInvoiceRequest extends FormRequest
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
        $estateId = $this->route('estate');
        return [
            'amount' => 'bail|required|numeric|gt:0'
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'المبلغ المسدد مطلوب',
            'amount.numeric' => 'المبلغ يجب ان يكون ارقام فقط',
            'amount.gt' => 'قيمة المبلغ يجب ان تكون اكبر من صفر',
        ];
    }
}
