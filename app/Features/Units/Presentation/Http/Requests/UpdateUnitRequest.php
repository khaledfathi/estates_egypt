<?php

namespace App\Features\Units\Presentation\Http\Requests; 

use App\Features\Units\Infrastructure\ValidationRules\LastUnitNumber;
use App\Shared\Domain\Enum\Unit\UnitType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class  UpdateUnitRequest extends FormRequest
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
        $estateId = $this->route('estate');
        return [
            'type' => ['required', new Enum(UnitType::class)],
            'number' => [
                'required',
                'numeric',
                'min:1',
                Rule::unique('units')
                ->where( fn ($query)=> $query->whereNot('id', $this->route('unit')))
                ->where(fn ($query)=> 
                    $query->where('estate_id', $estateId)->where('type', $this->type )->where('id', '!=', $this->id)
                ),
                new LastUnitNumber(estateId: $estateId, unitType: UnitType::from($this->type),) 
            ],
            'floor_number' => 'required|numeric',
            'is_empty' => 'required|in:true,false',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'نوع الوحدة مطلوب',
            'type.enum' => 'نوع الوحدة غير صالح',
            'number.required' => 'رقم الوحدة مطلوب',
            'number.numeric' => 'رقم الوحدة (:input) يجب ان يكون رقم',
            'number.min' => 'رقم الوحدة (:input) يجب ان يكون اكبر من الصفر',
            'number.unique' => 'رقم الوحدة (:input) موجود مسبقا  للنوع ال'.UnitType::from($this->type)->toLabel(),
            'floor_number.required' => 'رقم الطابق مطلوب',
            'floor_number.numeric' => 'رقم الطابق يجب ان يكون رقم',
            'is_empty.required' => 'حالة الوحدة مطلوبة',
            'is_empty.in' => 'حالة الوحدة غير صالحة',
        ];
    }
}
