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

    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'body'
        ]);

        return $this->service->store($data);
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function show()
    {
        return $this->service->show();
    }

    public function update(Request $request, $id)
    {

        $data = $request->only([
            'title', 'body'
        ]);

        return $this->service->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
