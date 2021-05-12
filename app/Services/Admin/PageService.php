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

    public function edit($id)
    {
        $page = $this->model->find($id);

        if ($page) {
            return view('admin.pages.edit', ['page' => $page]);
        }

        return redirect()->route('pages.index');
    }

    public function show()
    {
    }

    public function update(array $data, $id)
    {
        $page = $this->model->find($id);

        if ($page) {


            $temTitle = $page['title'] != $data['title'] ? true : false;

            if ($temTitle) {
                $data['slug'] = Str::slug($data['title'], '-');
            }

            $validator = $this->validatorUpdate($data, $temTitle);

            if ($validator->fails()) {
                return redirect()->route('pages.edit', ['page' => $id])->withErrors($validator)->withInput();
            }

            $this->model->where('id', $id)->update([
                'title' => $data['title'],
                'slug'  => isset($data['slug']) ? $data['slug'] : $page['slug'],
                'body'  => $data['body'],
            ]);
        }

        return redirect()->route('pages.index');
    }

    public function destroy($id)
    {

        $this->model->where('id', $id)->delete();

        return redirect()->route('pages.index');
    }

    public function validatorStore(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:pages',
            'body' => 'string'
        ]);
    }

    public function validatorUpdate(array $data, $verifySlug = false)
    {

        $dataValidator = [
            'title' => 'required|string|max:100',
            'body' => 'string',
        ];

        if ($verifySlug) {
            $dataValidator['slug'] = 'required|string|max:100|unique:pages';
        }

        return Validator::make($data, $dataValidator);
    }
}
