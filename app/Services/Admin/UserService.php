<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserService
{

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {

        $users = $this->model->paginate(10);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(array $data)
    {
        $validator = $this->validatorStore($data);

        if ($validator->fails()) {
            return redirect()->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect()->route('users.index');
    }

    public function show()
    {
    }

    public function edit($id)
    {

        $user = $this->model->find($id);

        if ($user) {
            return view('admin.users.edit', ['user' => $user]);
        }

        return redirect()->route('users.index');
    }

    public function update(array $data, $id)
    {
        $user = $this->model->find($id);

        if ($user) {

            $validator = $this->validatorUpdate($data);

            if ($validator->fails()) {
                return redirect()->route('users.edit', ['user' => $id])->withErrors($validator);
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
                return redirect()->route('users.edit', ['user' => $id])->withErrors($validator);
            }


            $this->model->where('id', $id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => empty($data['password']) ? $user->password : Hash::make($data['password'])
            ]);
        }

        return redirect()->route('users.index');
    }

    public function destroy()
    {
    }

    public function validatorStore(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed'
        ]);
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
