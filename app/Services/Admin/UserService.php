<?php

namespace App\Services\Admin;

use App\Models\User;

class UserService
{

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {

        $users = $this->model->all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function show()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
