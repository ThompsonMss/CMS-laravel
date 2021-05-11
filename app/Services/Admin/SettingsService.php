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

        $settings = [];

        $dbSettings = $this->model->get();

        foreach ($dbSettings as $dbSetting) {
            $settings[$dbSetting['name']] = $dbSetting['content'];
        }

        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function save(array $data)
    {
    }
}
