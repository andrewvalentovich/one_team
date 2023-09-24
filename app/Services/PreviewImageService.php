<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PreviewImageService
{
    public function save($image)
    {
        $thumbnailpath = null;

        if ($image){
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

//            Storage::put('uploads/'. $filenametostore, fopen($image, 'r+'));

            //Resize image here
            $thumbnailpath = public_path('uploads')."/"."preview_".$filenametostore;
            $img = Image::make($image->getRealPath());
            Log:info($image->getRealPath());

            $height = $img->height();
            $width = $img->width();
            if($height >= 400) {
                $img->resize(null, 350, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if($width >= 601) {
                $img->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $img->save($thumbnailpath);
        }

        return "uploads/preview_".$filenametostore;
    }

    public function update($image = null)
    {
        if (!is_null($image)){
            $thumbnailpath = 'uploads'."/".$image;
            $img = Image::make(public_path($thumbnailpath));
            $preview_image_path = 'uploads'."/preview_".$image;

            $height = $img->height();
            $width = $img->width();
            if($height >= 400) {
                $img->resize(null, 350, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if($width >= 601) {
                $img->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $img->save($preview_image_path);
            return $preview_image_path;
        }

        return null;
    }

    public function makeForAll($image = null)
    {
        if (!is_null($image)){
            $thumbnailpath = 'uploads'."/".$image;
            $img = Image::make(public_path($thumbnailpath));
            $preview_image_path = 'uploads'."/preview_".$image;

            $height = $img->height();
            $width = $img->width();
            if($height >= 400) {
                $img->resize(null, 350, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if($width >= 601) {
                $img->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $img->save(public_path($preview_image_path));
            return $preview_image_path;
        }

        return null;
    }
}
