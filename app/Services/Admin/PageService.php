<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Page;

class PageService
{

    private $model;

    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function index()
    {
        $pages = $this->model->paginate(10);

        return view('admin.pages.index', [
            'pages' => $pages
        ]);
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function edit()
    {
    }

    public function show()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
