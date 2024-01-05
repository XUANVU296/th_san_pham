<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'unique:categories,name,'.$this->category.'|required',
            'status' => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Không được để trống',
            'name.unique' => 'Danh mục đã tồn tại',
            'status.required' => 'Vui lòng chọn trạng thái danh mục',
        ];
    }
}
