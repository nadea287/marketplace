<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

trait Fileable
{
    public function saveMultipleFiles(array $files, Model $entity): void
    {
        $filesToInsert = [];
        $className = get_class($entity);

        foreach ($files as $file) {
            $path = $this->fetchFilePath($className) . '/' . $entity->id;
            $fileName = $this->uploadFile($file, $path);
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

    private function uploadFile($file, $path): string
    {
        $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
        $result = $file->storeAs($path, $fileName);
        if (!$result) {
            throw new \Exception('There was a problem saving the file');
        }

        return $fileName;
    }

    private function fetchFilePath(string $className): string
    {
        $paths = [
            'App\Models\Product' => config('constants.files.products')
        ];
        return $paths[$className];
    }
}
