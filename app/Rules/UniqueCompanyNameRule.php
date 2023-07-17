<?php

namespace App\Rules;

use App\Enums\UserTypeEnum;
use App\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueCompanyNameRule implements ValidationRule
{
    public function __construct(
        private string $userType,
        private string $companyName
    )
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->userType == UserTypeEnum::Seller->value) {
            $company = Company::where('CUI', $value)->first();

            if ($company
                && $company->name != $this->companyName
            ) {
                $fail('The :attribute must be unique');
            }
        }
    }
}
