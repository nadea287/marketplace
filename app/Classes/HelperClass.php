<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class HelperClass
{
    public static function getFileForWeb(Model $entity, string|null $fileName): string
    {
        $folderName = self::fetchFilePath(get_class($entity));
        return asset("storage/{$folderName}/{$entity->id}/{$fileName}");
    }

    public static function fetchFilePath(string $className): string
    {
        $paths = [
            'App\Models\Product' => config('constants.files.products')
        ];
        return $paths[$className];
    }




}
