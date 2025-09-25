<?php

namespace App\Features\Estates\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEstateRequest extends FormRequest
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
            'name' => 'required|unique:estates,name',
            'address' => 'required',
            'floor_count' => 'required|numeric|min:1|max:99',
            'residential_unit_count' => 'nullable|numeric|min:1|max:99',
            'commercial_unit_count' => 'nullable|numeric|min:1|max:99'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.unique' => 'الاسم (:input) مسجل مسبقاً',
            'address.required' => 'العنوان مطلوب',
            'floor_count.required' => 'عدد الطوابق مطلوب',
            'floor_count.numeric' => 'عدد الطوابق (:input) يجب ان يكون ارقام فقط',
            'floor_count.min' => 'عدد الطوابق (:input) يجب ان يكون بين 1 الى 99 ',
            'floor_count.max' => 'عدد الطوابق (:input) يجب ان يكون بين 1 الى 99 ',
            'residential_unit_count.numeric' => 'عدد الوحدات السكنية (:input) يجب ان يكون ارقام فقط',
            'residential_unit_count.min' => 'عدد الوحدات السكنية (:input) يجب ان يكون بين 1 الى 99',
            'residential_unit_count.max' => 'عدد الوحدات السكنية (:input) يجب ان يكون بين 1 الى 99',
            'commercial_unit_count.numeric' => 'عدد الوحدات التجارية (:input) يجب ان يكون ارقام فقط',
            'commercial_unit_count.min' => 'عدد الوحدات التجارية (:input) يجب ان يكون بين 1 الى 99',
            'commercial_unit_count.max' => 'عدد الوحدات التجارية (:input) يجب ان يكون بين 1 الى 99',
        ];
    }
}
