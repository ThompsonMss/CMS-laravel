<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileService
{

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {

        $user = $this->model->find(Auth::id());

        if ($user) {
            return view('admin.profile.index', ['user' => $user]);
        }

        return redirect()->route('admin');
    }

    public function save(array $data)
    {
        $user = $this->model->find(Auth::id());

        if ($user) {

            $validator = $this->validatorUpdate($data);

            if ($validator->fails()) {
                return redirect()->route('profile')->withErrors($validator);
            }

            /* VERIFICAR SE EMAIL É ÚNICO */
            if ($user->email != $data['email']) {
                $hasEmail = $this->model->where('email', $data['email'])->first();

                if ($hasEmail) {
                    $validator->errors()->add('email', 'Esse e-mail já está sendo usado.');
                }
            }

            if (!empty($data['password'])) {
                if ($data['password'] !== $data['password_confirmation']) {
                    $validator->errors()->add('password', 'Senha inválida.');
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('profile')->withErrors($validator);
            }


            $this->model->where('id', $user->id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => empty($data['password']) ? $user->password : Hash::make($data['password'])
            ]);
        }

        return redirect()->route('users.index');
    }

    public function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:4'
        ]);
    }
}
