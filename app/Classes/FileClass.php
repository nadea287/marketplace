<?php

namespace App\Classes;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileClass
{
    public static function uploadFile(string $path, UploadedFile $file): string
    {
        $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
        $result = $file->storeAs($path, $fileName);
        if (!$result) {
            throw new \Exception('There was a problem saving the file');
        }

        return $fileName;
    }

    public static function deleteDirectory(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path);
        }
    }

    public static function deleteFile(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

}
