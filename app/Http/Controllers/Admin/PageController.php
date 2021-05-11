<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PageService;

class PageController extends Controller
{
    private $service;

    public function __construct(PageService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store()
    {
        return $this->service->store();
    }

    public function edit()
    {
        return $this->service->edit();
    }

    public function show()
    {
        return $this->service->show();
    }

    public function update()
    {
        return $this->service->update();
    }

    public function destroy()
    {
        return $this->service->destroy();
    }
}
