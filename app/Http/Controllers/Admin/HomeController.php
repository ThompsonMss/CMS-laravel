<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\HomeService;

class HomeController extends Controller
{

    private $service;

    public function __construct(HomeService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {

        $filters['interval'] = intval($request->input('interval', 30));

        if ($filters['interval'] > 120) {
            $filters['interval'] = 120;
        }

        return $this->service->index($filters);
    }
}
