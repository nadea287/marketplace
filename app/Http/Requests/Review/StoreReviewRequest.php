<?php

namespace App\Http\Requests\Review;

use App\Enums\ReviewStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rating' => 'required|integer|between:0,5',
            'comment' => 'required|string|min:2|max:500',
            'status' => 'required|' . Rule::in(ReviewStatusEnum::getCasesArray()),
        ];
    }
}
