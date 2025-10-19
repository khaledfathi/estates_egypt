<?php

namespace App\Features\UnitOwnerships\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class  StoreUnitOwnershipRequest extends FormRequest
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
            'store_type' =>  ['required','in:owners_list,owners_groups' ] ,
        ];
    }

    public function messages(): array
    {
        return [
            'store_type.required' =>  'لم يتم تحديد نوع التسجيل ',
            'store_type.in' =>  'نوع التسجيل يجب ان يكون [مالك/ملاك - مجموعة ملاك]',
        ];
    }
}
