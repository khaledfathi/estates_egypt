<?php
declare(strict_types=1);
namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstateMaintenanceExpensesRequest extends FormRequest
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
            'estate_id' => 'exists:estates,id',
            'date' => 'required|date',
            'amount'=>'required|numeric|min:0',
            'title' => 'required|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required'=> 'التاريخ مطلوب',
            'date.date'=> 'صيغة التاريخ غير صحيحة',
            'amount.required'=> 'المبلغ مطلوب',
            'amount.numeric'=> 'المبلغ يجب ان يكون ارقام فقط',
            'amount.min'=> 'المبلغ يجب ان يكون صفر او قيمة موجبة فقط',
            'title.required'=> '(مدفوع لـ) مطلوب',
            'title.max'=> '(مدفوع لـ) حد اقصى 100 حرف',
        ];
    }
}
