<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Services\Admin\LoginService;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{

    private $service;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function authenticate()
    {
        $data = Request::only(['email', 'password', 'remember']);

        return $this->service->authenticate($data);
    }

    public function logout()
    {
        return $this->service->logout();
    }
}
