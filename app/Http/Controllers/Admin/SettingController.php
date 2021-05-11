<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\SettingsService;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    private $service;

    public function __construct(SettingsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function save()
    {
        return $this->service->save([]);
    }
}
