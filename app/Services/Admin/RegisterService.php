<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;

class RegisterService
{
    public function index()
    {
        return view('admin.register');
    }

    public function create($data)
    {

    }
}
