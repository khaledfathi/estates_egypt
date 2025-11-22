<?php

namespace App\Features\Transactions\Presentation\Http\Requests;

use App\Shared\Domain\Enum\Transaction\TransactionDirection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class  StoreTransactionRequest extends FormRequest
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
        return [
            'date' => 'required|date',
            'direction' => ['required', Rule::enum(TransactionDirection::class)],
            'amount' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'التاريخ مطلوب',
            'date.date' => 'صيغة التاريخ غير صالحة',
            'direction.required' => 'اختر اتجاه الحركة ( سحب / ايداع )',
            'amount.required' => 'المبلغ مطلوب',
            'amount.numeric'=> 'المبلغ يجب ان يكون ارقام فقط',
            'amount.min' => 'المبلغ يجب ان يكون ارقام موجبة فقط '
        ];
    }
}
