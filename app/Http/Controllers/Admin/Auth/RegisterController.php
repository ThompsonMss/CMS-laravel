<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Services\Admin\RegisterService;

use Illuminate\Support\Facades\Request;

class RegisterController extends Controller
{

    private $service;

    public function __construct(RegisterService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function create()
    {
        $data = Request::only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        return $this->service->create($data);
    }
}
