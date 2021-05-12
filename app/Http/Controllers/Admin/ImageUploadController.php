<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ImageUploadService;

class ImageUploadController extends Controller
{

    private $service;

    public function __construct(ImageUploadService $service)
    {
        $this->service = $service;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        return $this->service->upload($request);
    }
}
