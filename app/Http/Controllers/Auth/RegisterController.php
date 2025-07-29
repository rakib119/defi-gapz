<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountStatement;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Exception;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\NotIn;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:30', 'unique:users'],
            'reference' => ['nullable', 'exists:users,uid'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'tmc' => ['required'],
            'country_code'=>['required','not_in:af,cn,np,ma,dz,eg,ws,gm,ye,bd'],
        ], [
            'reference.exists' => "Reference ID is not correct",
            // 'tmc.required' => "You must agree to the terms and conditions",
            'country_code.required' => "Please select a country from flag",
            'country_code.not_in' => "You are in restricted area"
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'reference' => $data['reference'],
                'country' => $data['country'],
                'password' => Hash::make($data['password']),
            ]);
        } catch (Exception $th) {
            return new User;
        }
        $user_id = $user->id;
        $user_info = User::find($user_id);

        // // uid genarate start
        // $uid_len = strlen($user_id);
        // $rand1 = rand('00000000000', '99999999999');
        // $rand2 = rand('00000000000', '99999999999');
        // $rand3 =  $rand1 + $rand2;
        // $length = 11 - $uid_len;
        // if ($length > 0) {
        //     $uid = Str::substr($rand3, 0, $length)  . $user_id;
        // } else {
        //     $uid = $user_id;
        // }
        $uid = Str::random(16);
        // uid genarate end
        $user_info->uid = $uid;
        $user_info->updated_at = NULL;
        $user_info->save();

        AccountStatement::insert([
            'uid' => $uid,
            'balance' => 0.00,
            'created_at' => Carbon::now(),
        ]);
        return $user;
    }
}
