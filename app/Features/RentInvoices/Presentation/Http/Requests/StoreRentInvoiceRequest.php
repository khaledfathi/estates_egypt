<?php
declare (strict_types=1);  
namespace App\Features\RentInvoices\Presentation\Http\Requests;

use App\Shared\Application\Utility\Month;
use Illuminate\Foundation\Http\FormRequest;

class StoreRentInvoiceRequest extends FormRequest
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
            'amount' => 'required|numeric|min:1',
            'for_year' => 'required|numeric',
            'for_month' => "required|numeric|unique:rent_invoices,for_month,NULL,id,for_year,$this->for_year,contract_id,".$this->route('contract'),
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'المبلغ المسدد مطلوب',
            'amount.numeric' => 'المبلغ المسدد ارقام فقط',
            'amount.min' => 'المبلغ المسدد يجب ان يكون اكبر من صفر',
            'for_year.required' => 'العام مطلوب',
            'for_year.numeric' => 'العام يجب ان يكون ارقام فقط',
            'for_month.required' => 'شهر الاستحقاق مطلوب',
            'for_month.numeric' => 'شهر الاستحقاق يجب ان يكون ارقام فقط',
            'for_month.between' => 'شهر الاستحقاق - رقم الشهر يجب ان يكون ما بين 1 الى 12',
            'for_month.unique' => 'شهر الاستحقاق '.Month::from((int)$this->for_month, true)->name. " / $this->for_year مسجل مسبقاً",
        ];
    }
}
