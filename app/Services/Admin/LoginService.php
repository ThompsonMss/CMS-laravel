<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginService
{

    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(array $data)
    {
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $remember = $data['remember'];
        unset($data['remember']);

        if (Auth::attempt($data, $remember)) {
            return redirect()->route('admin');
        } else {

            $validator->errors()->add('password', 'Email e/ou senha inválidos.');

            return redirect()->route('login')->withErrors($validator)->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return Illuminate\Support\Facades\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4'],
        ]);
    }
}
