<?php


namespace App\Services;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    public function saveWebp($image, $prefix = null)
    {
        $thumbnailpath = null;
        $prefix = is_null($prefix) ? "" : $prefix;

        if ($image) {
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

        return $prefix . $filenametostore;
    }

    public function saveFromRemoteString($image)
    {
        $thumbnailpath = null;

        if ($image){
            // Получаем имя_файла.расширение
            $basename = basename($image);

            // Получаем имя_файла и расширение в качестве элементов массива
            $explode = explode('.', $basename);

            // Устанавливаем новое имя для картинки
            $new_name = "crm_" . $explode[0] . uniqid();
            $filenametostore = $new_name . "." . $explode[1];

            // Если расширение не webp - конвертируем в webp
            $img = Image::make($image);
            if ($explode[1] !== "webp") {
                $img->encode('webp', 100);
            }
            $img->save(public_path("uploads/" . $new_name . ".webp"));
            $filenametostore = $img->basename;
            unset($img);
        }

        return $filenametostore;
    }

    /**
     * @param string $image
     *
     * @return string
     */
    public function saveFromRemote(string $image)
    {
        $filenametostore = null;

        if ($image) {
            // Отключаем вывод ошибки для данной функции
            $img = @file_get_contents($image);

            // Если удалось получить файл
            if ($img !== false) {
                // Получаем имя_файла.расширение
                $basename = basename($image);

                // Получаем имя_файла и расширение в качестве элементов массива
                $explode = explode('.', $basename);

                // Устанавливаем новое имя для картинки
                $new_name = "crm_" . $explode[0] . uniqid();
                $filenametostore = $new_name . "." . $explode[1];

                // Сохраняем картинку в хранилище
                file_put_contents(public_path("uploads/" . $new_name . "." . $explode[1]), $img);

                // Если расширение не webp - конвертируем в webp
                if ($explode[1] !== "webp") {
                    $img = Image::make(public_path("uploads/" . $filenametostore))->encode('webp', 100);
                    $img->save(public_path("uploads/" . $new_name . ".webp"));
                    $filenametostore = $img->basename;
                }
            } else {
                $filenametostore = $this->saveFromRemoteString($image);
            }
        }

        return $filenametostore;
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
