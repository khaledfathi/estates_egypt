<?php

namespace App\Features\EstateDocuments\Presentation\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;

class  StoreEstateDocumentRequest extends FormRequest
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
            'title' => 'required|max:150|unique:estate_documents,title,NULL,id,estate_id,' . $this->route('estate'),
            'file'=> 'required|max:10240|mimes:jpeg,png,jpg,webp,avif,pdf'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'=> 'عنوان المستند مطلوب',
            'title.max'=> 'عنوان المستند يجب الا يزيد عن 150 حرف',
            'title.unique'=> 'عنوان المستند مسجل مسبقاً لهذا العقار',
            'file.required'=> 'الملف مطلوب',
            'file.max'=> 'اقصى مساحة مسموحة للملف 10 ميجابايت',
            'file.mimes'=> 'الملف غير صالح - الملفات المسموح بها (jpeg, png, jpg, webp, avif, pdf)',
        ];
    }
}
