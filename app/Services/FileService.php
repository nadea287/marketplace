<?php

namespace App\Services;

use App\Classes\FileClass;
use App\Classes\HelperClass;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class FileService
{
    public static function saveMultipleFiles(array $files, Model $entity): void
    {
        $filesToInsert = [];
        $className = get_class($entity);

        foreach ($files as $file) {
            $path = 'public/' . HelperClass::fetchFilePath($className) . '/' . $entity->id;
            $fileName = FileClass::uploadFile($path, $file);

            $filesToInsert[] = [
                'imageable_type' => $className,
                'imageable_id' => $entity->id,
                'name' => $fileName,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Image::insert($filesToInsert);
    }


}
