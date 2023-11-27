<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SlugService
{
    public function make(int $id)
    {
        return "object-".$id;
    }
}
