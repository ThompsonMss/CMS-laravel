<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Site\PageService;

class PageController extends Controller
{

    private $service;

    public function __construct(PageService $service)
    {
        $this->service = $service;
    }

    public function index($slug)
    {
        return $this->service->index($slug);
    }
}
