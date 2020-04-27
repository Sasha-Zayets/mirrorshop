<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function loadImage(Request $request)
    {
        if (request()->hasFile('croppedImage')) {
            $file = request()->file('croppedImage');
            $fileName = uniqid() . '.' . $file->extension();

            $imageFile = \Image::make($file);
            if ($imageFile->width() > 1920) {
                $imageFile = $imageFile->resize(
                    1920,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                );
            }
            $filePath = config('image.temp')  . '/' . $fileName;
            $saved = Storage::disk('img')->put($filePath, $imageFile->encode());

            if (!$saved) {
                return response()->json(['success' => false], 500);
            }

            $fileUrl = Storage::disk('img')->url($filePath);
        }

        return response()->json([
            'success'   => true,
            'fileUrl'   => $fileUrl,
            'fileName'  => $fileName
        ]);
    }
}
