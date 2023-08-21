<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait Upload {
    public function uploadImage($image, $path) {
        $imageName = time().'.'.$image->extension();  
       
        $image->move(public_path($path), $imageName);
        $destenationPath = $path . '/' . $imageName;

        return $destenationPath;
    }

    public function removeImage($path) {
        $image_path = public_path($path);
        if(File::exists($image_path)) {
          File::delete($image_path);
        }
    }

    public function removeImageFolder($path) {
        $image_path = public_path($path);
        if(File::exists($image_path)) {
          File::deleteDirectory($image_path);
        }
    }

    public function uploadVideo($video, $path) {
      $videoName = $video->getClientOriginalName();  
     
      $video->move(public_path($path), $videoName);
      $destenationPath = $path . '/' . $videoName;

      return $destenationPath;
  }
}