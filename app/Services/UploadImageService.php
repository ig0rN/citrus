<?php

namespace App\Services;

use Intervention\Image\ImageManagerStatic as Image;

class UploadImageService
{
    /**
     * Resize & upload image
     *
     * @param $file
     * @param string $inputName
     * @param string $path
     * @return string
     */
    public function upload($file, string $inputName, string $path = ''): string
    {
        $image = $file;

        $imageNameParams = explode('.', $image['name']);

        $extension = array_pop($imageNameParams);

        $displayName = $inputName . '.' . $extension;
        $name = time() . '.' . $displayName;

        $saveFolder = ROOT_DIR . '/public/images/';

        Image::make($image['tmp_name'])->resize(250, 250)->save($saveFolder . $name);

        return $name;
    }
}
