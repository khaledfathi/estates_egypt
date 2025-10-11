<?php

namespace  App\Features\UnitUtilityServices\Presentation\Http\Requests;

use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUnitUtilityServiceRequest extends FormRequest
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
        $unitId = $this->route('unit');
        return [
            'type' => [
                Rule::enum(UnitUtilityServiceType::class),
                'unique:unit_utility_services,type,NULL,id,unit_id,' . $unitId,
            ],
            'owner_name' => 'required'
        ];
    }

    public function messages(): array
    {
        $typeName = UnitUtilityServiceType::from($this->type)->toLabel();
        return [
            'type.enum' => 'نوع المرفق غير صالح',
            'type.unique' => 'تم تسجيل مرفق ال' . $typeName . ' مسبقاً',
            'owner_name.required' => 'الاسم مطلوب'
        ];
    }
}
