<?php

namespace App\Features\Owners\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerRequest extends FormRequest
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
            'name' => 'required',
            'national_id' => 'nullable|numeric|digits:14|unique:owners,national_id',
            'phones' => 'nullable',
            'phones.*' => 'numeric|unique:owner_phones,phone',
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
