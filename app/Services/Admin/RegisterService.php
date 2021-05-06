<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService
{

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }


    public function index()
    {
        return view('admin.register');
    }

    public function create($data)
    {
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $user =  $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($user);

        return redirect()->route('admin');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }
}
