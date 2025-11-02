<?php

namespace App\Features\EstateUtilityServiceInvoices\Presentation\Http\Requests;

use App\Shared\Application\Utility\Month;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEstateUtilityServiceInvoiceRequest extends FormRequest
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
        $estateUtilityServiceId = $this->route('utility_service');
        return [
            'amount' => 'required | numeric',
            'for_year' => 'required',
            'for_month' => [
                'required',
                Rule::unique('estate_utility_service_invoices')->where( fn($query) =>
                    $query->where('estate_utility_service_id', (int) $estateUtilityServiceId)
                        ->where('for_year', $this->for_year)
                )->ignore($this->invoice),
            ],
            'file' => 'max:10240|mimes:jpeg,png,jpg,webp,avif,pdf'
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'المبلغ مطلوب',
            'amount.numeric' => 'قيمة الفاتورة يجب ان تكون ارقام فقط',
            'for_year.required' => 'السنة مطلوبة',
            'for_month.unique' => 'شهر ( ' . Month::from($this->for_month)->name . ' ) تم تسجيلة مسبقاً',
            'file.required' => 'الملف مطلوب',
            'file.max' => 'اقصى مساحة مسموحة للملف 10 ميجابايت',
            'file.mimes' => 'الملف غير صالح - الملفات المسموح بها (jpeg, png, jpg, webp, avif,pdf)',
        ];
    }
}
