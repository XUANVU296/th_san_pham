<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|unique:products',
            'status' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Không được để trống',
            'name.unique' => 'Sản phẩm này đã tồn tại',
            'status.required' => 'Không được để trống',
            'category_id.required' => 'Không được để trống',
            'price.required' => 'Không được để trống',
            'price.numeric' => 'Bắt buộc phải nhập số',
        ];
    }
}
