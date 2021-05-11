<?php

namespace App\Services\Admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

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
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->route('settings')->withErrors($validator);
        }

        foreach ($data as $item => $value) {
            $this->model->where('name', $item)->update([
                'content' => $value
            ]);
        }

        return redirect()->route('settings')->with('warning', 'Informações salvar com sucesso!');
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'title'     => 'string|max:100',
            'subtitle'  => 'string|max:100',
            'email'     => 'string|email',
            'bgcolor'   => 'string|regex:/#[A-Z0-9]{6}/i',
            'textcolor' => 'string|regex:/#[A-Z0-9]{6}/i'
        ]);
    }
}
