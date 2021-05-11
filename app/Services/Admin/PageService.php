<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
        return view('admin.pages.create');
    }

    public function store(array $data)
    {
        $data['slug'] = Str::slug($data['title'], '-');

        $validator = $this->validatorStore($data);

        if ($validator->fails()) {
            return redirect()->route('pages.create')
                ->withErrors($validator)
                ->withInput();
        }

        $this->model->create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'body' => $data['body']
        ]);

        return redirect()->route('pages.index');
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

    public function validatorStore(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:pages',
            'body' => 'string'
        ]);
    }

    public function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:pages',
            'body' => 'string'
        ]);
    }
}
