<?php

namespace App\Features\Renters\Presentation\Http\Requests;

use App\Shared\Domain\Enum\Renter\RenterIdentityType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreRenterRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:150',
            'identity_type' => ['required', new Enum(RenterIdentityType::class)],
            'identity_number' => ['required'],
            'phones' => 'nullable',
            'phones.*' => [
                'bail', // stop at first error
                'digits_between:1,25',
                Rule::unique('renter_phones' , 'phone'),
                Rule::unique('owner_phones' , 'phone'),
            ]
        ];
        if($this->identity_type === RenterIdentityType::NATIONAL_ID->value) {
            $rules['identity_number'][] = 'numeric';
            $rules['identity_number'][] = 'digits:14';
            $rules['identity_number'][] = Rule::unique('owners','national_id');
            $rules['identity_number'][] = Rule::unique('renters','identity_number');
        }else if ($this->identity_type === RenterIdentityType::PASSPORT->value) {
            $rules['identity_number'][] = Rule::unique('renters','identity_number');
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.max' => 'الاسم لا يجب ان يتخطى 150 حرف',
            'identity_type.required' => 'نوع الهوية مطلوب ',
            'identity_type.Illuminate\Validation\Rules\Enum' => 'نوع الهوية غير محدد',
            'identity_number.required' => "رقم الهوية مطلوب",
            'identity_number.digits' => 'الرقم القومى غير صالح - يجب ان يكون 14 رقم.',
            'identity_number.unique' => "رقم الهوية (:input) مسجل مسبقاً",
            'identity_number.numeric' => 'الرقم القومى غير صالح - يجب أن يكون ارقام فقط.',
            'phones.*.unique' => 'رقم التليفون (:input) مسجل مسبقاً.',
            'phones.*.digits_between' => 'رقم التليفون (:input) غير صالح',
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
