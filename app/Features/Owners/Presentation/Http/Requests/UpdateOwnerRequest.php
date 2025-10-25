<?php

namespace App\Features\Owners\Presentation\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'national_id' => [
                'nullable',
                'numeric',
                'digits:14',
                Rule::unique('owners','national_id')->ignore($this->owner),
                Rule::unique('renters','identity_number'),
            ],
            'phones' => 'nullable',
            'phones.*' => [
                'bail', // stop at first error
                'digits_between:1,25',
                Rule::unique('owner_phones' , 'phone')->ignore($this->owner,  'owner_id'),
                Rule::unique('renter_phones' , 'phone'),
            ],
            'owner_groups.*'=> 'exists:owner_groups,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'national_id.unique' => 'الرقم القومى (:input) مسجل مسبقاً',
            'national_id.numeric' => 'الرقم القومى غير صالح - يجب أن يكون ارقام فقط.',
            'national_id.digits' => 'الرقم القومى غير صالح - يجب ان يكون 14 رقم.',
            'phones.*.unique' => 'رقم التليفون (:input) مسجل مسبقاً.',
            'phones.*.numeric' => 'رقم التليفون (:input) غير صالح - يجب أن يكون رقمًا.',
            'phones.*.digits_between' => 'رقم التليفون (:input) غير صالح',
            'owner_groups.*.exists' => 'مجموعة او اكثر غير صالحة',
        ];
    }

    protected function prepareForValidation()
    {
        $phones = array_filter($this->input('phones', [])); // remove empty
        $phones = array_values(array_unique($phones));      // remove duplicates

        $ownerGroups = array_filter($this->input('owner_groups', [])); // remove empty
        $ownerGroups= array_values(array_unique($ownerGroups));      // remove duplicates
        $this->merge([
            'phones' => $phones,
            'owner_groups'=> $ownerGroups
        ]);
    }
}
