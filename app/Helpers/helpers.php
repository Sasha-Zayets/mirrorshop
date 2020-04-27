<?php

if (!function_exists('create_img_with_webp')) {
    /**
     * @param $file
     * @param $uniqName
     * @param $imageClassName
     * @param $resizeSize
     * @param $webpQuality
     * @param null $extension
     * @param bool $crop
     * @return bool|string
     */
    function create_img_with_webp($file, $uniqName, $imageClassName, $resizeSize, $webpQuality, $extension = null, $crop = false)
    {
        $fileName   = $uniqName . '.' . ($extension ?? $file->extension());
        $fileNameWp = $uniqName . '.webp';

        $imageFile = \Image::make($file);
        if ($imageFile->width() > $resizeSize) {
            $prop = $imageFile->width() / $resizeSize;
            $imageFile =  $imageFile->fit($resizeSize, ceil($imageFile->height() / $prop), function ($constraint) {
                $constraint->upsize();
            });
        }

        if ($crop && $imageFile->width() != $imageFile->height()) {
            $smallestSize = $imageFile->width() > $imageFile->height() ? $imageFile->height() : $imageFile->width();

            $imageFile = $imageFile->crop($smallestSize, $smallestSize);
        }

        $path = Storage::disk('img')
            ->put(
                config('image.' . $imageClassName) . '/' . $fileName,
                $imageFile->encode()
            );

        $pathWp = Storage::disk('img')
            ->put(
                config('image.' . $imageClassName) . '/' . $fileNameWp,
                $imageFile->encode('webp', $webpQuality)
            );

        if (!$path || !$pathWp) {
            return false;
        }

        return $fileName;
    }
}

if (!function_exists('delete_img_with_webp')) {
    /**
     * @param $filePath
     */
    function delete_img_with_webp($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $webpPath = preg_replace('/.[^.]*$/', '.webp', $filePath);
        if (file_exists($webpPath)) {
            unlink($webpPath);
        }
    }
}

