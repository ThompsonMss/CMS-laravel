<?php

namespace App\Services\Admin;

class ImageUploadService
{
    public function upload($request)
    {
        $imageName = time() . '.' . $request->file->extension();

        $request->file->move(public_path('media/images'), $imageName);

        return [
            'location' => asset('media/images/' . $imageName)
        ];
    }
}
