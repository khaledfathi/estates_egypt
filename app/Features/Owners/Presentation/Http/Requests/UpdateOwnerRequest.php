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
            'national_id' => "nullable|numeric|digits:14|unique:owners,national_id,$this->owner",
            'phones' => 'nullable',
            'phones.*' => [
                'bail', // stop at first error
                'numeric',
                Rule::unique('owner_phones' , 'phone')->ignore($this->owner,  'owner_id')
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'national_id.unique' => 'الرقم القومى مسجل مسبقاً',
            'national_id.numeric' => 'الرقم القومى غير صالح - يجب أن يكون ارقام فقط.',
            'national_id.digits' => 'الرقم القومى غير صالح - يجب ان يكون 14 رقم.',
            'phones.*.unique' => 'رقم التليفون (:input) مسجل مسبقاً.',
            'phones.*.numeric' => 'رقم التليفون (:input) غير صالح - يجب أن يكون رقمًا.',
        ];
    }

    protected function prepareForValidation()
    {
        $phones = array_filter($this->input('phones', [])); // remove empty
        $phones = array_values(array_unique($phones));      // remove duplicates

        $this->merge([
            'phones' => $phones,
        ]);
    }
}
