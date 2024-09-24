<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HandleImages
{
    public function uploadImage($image, $folderName){
        $imageName = 'assets/images/' . $folderName . '/' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/images/' . $folderName), $imageName);
        return $imageName;
    }
    public function updateImage($image, $folderName, $oldImage){
        $imageName = 'assets/images/' . $folderName . '/' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/images/' . $folderName), $imageName);
        $oldImage = str_replace(config('app.url') . '/', '', $oldImage);
        Storage::disk('public')->delete($oldImage);
        return $imageName;
    }
}
