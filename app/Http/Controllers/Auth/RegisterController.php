<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\UniqueCompanyNameRule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required', Rule::in(UserTypeEnum::getCasesArray())],
            'company_name' => ['required_if:type,' . UserTypeEnum::Seller->name, 'max:150'],
            'CUI' => ['required_if:type,' . UserTypeEnum::Seller->name, new UniqueCompanyNameRule($data['type'], $data['company_name'])],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $company = null;
        if ($data['type'] == UserTypeEnum::Seller->value) {
            $company = Company::where([
                ['name', $data['company_name']],
                ['CUI', $data['CUI']]
            ])
                ->first();
            if (!$company) {
                $company = Company::create([
                    'name' => $data['company_name'],
                    'CUI' => $data['CUI']
                ]);
            }
        }


        //2. create the user
        $user = User::create([
            'company_id' => $company ? $company->id : null,
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['type'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}
