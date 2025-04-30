<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileTrait
{

    public function uploadFile($file, $path)
    {
        $name = \rand(11111, 99999) . $file->getClientOriginalName();
        $file->storeAs('/public/' . $path, $name);
        return $path . $name;
    }


    public function deleteFile($path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
