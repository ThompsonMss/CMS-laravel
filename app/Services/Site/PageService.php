<?php

namespace App\Services\Site;

use App\Models\Page;

class PageService
{

    private $model;

    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function index($slug)
    {
        $page = $this->model->where('slug', $slug)->first();

        if ($page) {
            return view('site.page', [
                'page' => $page
            ]);
        } else {
            abort(404);
        }
    }
}
