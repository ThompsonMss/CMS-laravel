<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Site\HomeService;

class HomeController extends Controller
{

    private $service;

    public function __construct(HomeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }
}
