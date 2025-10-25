<?php

namespace App\Features\OwnerGroups\Presentation\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerGroupRequest extends FormRequest
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
            'name'=>'required|unique:owner_groups,name|max:100'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'الاسم مطلوب',
            'name.unique'=>'اسم المجموعة (:input ) مسجل مسبقاً',
            'name.max'=> 'الحد الاقصى لطول هو 100 حرف'
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
