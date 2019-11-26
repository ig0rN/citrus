<?php

namespace App\Models;

use Core\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'image_path'];

    public function delete()
    {
        $this->deleteImage();
        parent::delete();
    }

    private function deleteImage()
    {
        $path = ROOT_DIR . '/public/images/' . $this->image_path;

        if (file_exists($path)) {
            unlink($path);

            return true;
        }

        return false;
    }
}