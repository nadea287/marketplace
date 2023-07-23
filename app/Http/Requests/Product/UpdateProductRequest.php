<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'status' => 'required|' . Rule::in(ProductStatusEnum::getCasesArray()),
            'images' => 'sometimes',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
