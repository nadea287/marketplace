<?php

namespace App\Http\Controllers;

use App\Classes\FileClass;
use App\Classes\HelperClass;
use App\Models\Image;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function destroy($image)
    {
        if (!($DBImage = Image::find($image))) {
            return response()->json([
               'data' => 'Image not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if (request()->user()->cannot('delete', $DBImage)) {
            abort(403);
        }

        $entity = $DBImage->imageable;
        FileClass::deleteFile(HelperClass::fetchFilePath(get_class($entity)) . '/' . $entity->id . '/' . $DBImage->name);
        $DBImage->delete();

        return response()->json([
           'data' => 'Image was deleted successfully'
        ], Response::HTTP_OK);
    }
}
