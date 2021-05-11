<?php

namespace App\Services\Admin;

use App\Models\Setting;

class SettingsService
{

    private $model;

    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    public function index()
    {
        return view('admin.settings.index');
    }
}
