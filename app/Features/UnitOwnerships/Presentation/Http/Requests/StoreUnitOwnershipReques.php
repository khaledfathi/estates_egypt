<?php

namespace App\Features\UnitOwnerships\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class  StoreUnitOwnershipReques extends FormRequest
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
            'owner_id' => [
                'required',
                "exists:owners,id",
                Rule::unique('unit_ownerships', 'owner_id')->where(
                    fn($query) =>
                    $query->where('unit_id', $this->route('unit'))
                ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'owner_id.required' => 'اسم المالك مطلوب',
            'owner_id.exists' => 'الاسم غير مسجل فى قائمة الملاك',
            'owner_id.unique' => 'تم تسجيل هذا الاسم بالفعل كمالك لهذة الوحدة',
        ];
    }
}
