<?php

namespace App\Features\UnitContracts\Presentation\Http\Requests;

use App\Features\UnitContracts\Presentation\Http\Requests\Rules\UnitContractDateIntersectionRule;
use App\Shared\Domain\Enum\Unit\UnitContractType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUnitContractRequest extends FormRequest
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
        'renter_id' => 'required|numeric|exists:renters,id',
        'contract_type' => [
            'required',
            Rule::enum(UnitContractType::class),
        ],
        'rent_value' => 'required|numeric',
        'annual_rent_increasement' => 'required|numeric|between:0,100',
        'insurance_value' => 'required|numeric',
        'start_date' => [
            'required',
            'date',
            new UnitContractDateIntersectionRule($this->end_date, $this->route('unit')),
        ],
        'end_date' => 'required|date|after:start_date',
        'water_invoice_percentage' => 'required|numeric|between:0.1,3',
        'electricity_invoice_percentage' => 'required|numeric|between:0.1,3',
        ];
    }

    public function messages(): array
    {
        return [
            'renter_id.required' => 'المستأجر مطلوب',
            'renter_id.numeric' => 'المستأجر غير مسجل بالنظام',
            'renter_id.exists' => 'المستأجر غير مسجل بالنظام',
            'contract_type.required' => 'نوع العقد مطلوب',
            'contract_type.enum' => 'نوع العقد غير صحيح',
            'rent_value.required' => 'قيمة الايجار مطلوبة',
            'rent_value.numeric' => 'قيمة الايجار يجب ان تكون ارقام فقط',
            'annual_rent_increasement.required' => 'الزيادة السنوية مطلوبة',
            'annual_rent_increasement.numeric' => 'الزيادة السنوية يجب ان تكون ارقام فقط',
            'annual_rent_increasement.between' => 'قيمة الزيادة السنوية يجب ان تكون بين 0 الى 100',
            'insurance_value.required' => 'قيمة التأمين مطلوبة ',
            'insurance_value.numeric' => 'قيمة التأمين يجب ان تكون ارقام فقط ',
            'start_date.required' => 'تاريخ التعاقد مطلوب',
            'start_date.date' => 'تاريخ العقد غير صالح',
            'end_date.required' => 'تاريخ التعاقد مطلوب',
            'end_date.date' => 'تاريخ العقد غير صالح',
            'end_date.after' => 'تاريخ انتهاء العقد يجب ان يكون بعد تاريخ التعاقد',
            'water_invoice_percentage.required' => 'نسبة تحصبل فاتورة المياة مطلوبة',
            'water_invoice_percentage.numeric' => 'نسبة تحصيل فاتورة المياة يجب ان تكون ارقام فقط ',
            'water_invoice_percentage.between' => 'نسبة تحصيل فاتورة المياة يجب ان تكون اكبر من صفر الى 3',
            'electricity_invoice_percentage.required' => 'نسبة تحصبل فاتورة الكهرباء مطلوبة',
            'electricity_invoice_percentage.numeric' => 'نسبة تحصيل فاتورة الكهرباء يجب ان تكون ارقام فقط ',
            'electricity_invoice_percentage.between' => 'نسبة تحصيل فاتورة الكهرياء يجب ان تكون اكبر من صفر الى 3',
        ];
    }
}
