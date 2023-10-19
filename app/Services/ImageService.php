<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    public function saveWebp($image, $prefix = null)
    {
        $thumbnailpath = null;
        $prefix = is_null($prefix) ? "" : $prefix;

        if ($image){
            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . uniqid() . '.' . 'webp';

            $thumbnailpath = public_path('uploads') . "/" . $prefix . $filenametostore;
            $img = Image::make($image->getRealPath())->encode('webp', 100);
            $img->save($thumbnailpath);
        }

        return "uploads/" . $prefix . $filenametostore;
    }

    public function saveFromRemote(string $image)
    {
        $filenametostore = null;

        if ($image){
            $img = file_get_contents("https://crm.one-team.pro/storage/request_files/2023/08/10/tWdJmx14ZAUAM7Mj6PcVVGZEouaswYM3jQR2nyEJ.jpg");
//            $img = Image::make("https://crm.one-team.pro/storage/request_files/2023/08/10/tWdJmx14ZAUAM7Mj6PcVVGZEouaswYM3jQR2nyEJ.jpg");
            dump($img);
//            $img->save($thumbnailpath);
        }

        return "uploads/" . $filenametostore;
    }

//    public function update($image = null, $prefix = null)
//    {
//        $prefix = is_null($prefix) ? "" : $prefix;
//
//        if (!is_null($image)){
//            $thumbnailpath = 'uploads'."/".$image;
//            $img = Image::make(public_path($thumbnailpath));
//            $preview_image_path = 'uploads'."/preview_".$image;
//
//            $height = $img->height();
//            $width = $img->width();
//            if($height >= 400) {
//                $img->resize(null, 350, function ($constraint) {
//                    $constraint->aspectRatio();
//                });
//            }
//            if($width >= 601) {
//                $img->resize(600, null, function ($constraint) {
//                    $constraint->aspectRatio();
//                });
//            }
//            $img->save($preview_image_path);
//            return $preview_image_path;
//        }
//
//        return null;
//    }
}
