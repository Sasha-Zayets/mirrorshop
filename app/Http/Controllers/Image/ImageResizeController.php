<?php

namespace App\Http\Controllers\Image;

use Intervention\Image\ImageCacheController;
use Intervention\Image\ImageManager;
use Config;

/**
 * Class ImageResizeController
 * @package App\Http\Controllers\Image
 */
class ImageResizeController extends ImageCacheController
{
    /**
     * @param string $template
     * @param string $args {size}/{filename}
     * @return \Intervention\Image\Illuminate\Http\Response
     */
    public function getResponse($template, $args)
    {
        $size = request()->segment(3);
        $filename = request()->segment(4);

        switch (strtolower($template)) {
            case 'original':
                return $this->getOriginal($filename);

            default:
                return $this->getImageWithSize($template, $filename, $size);
        }
    }

    /**
     * @param $template
     * @param $filename
     * @param $size
     * @return \Intervention\Image\Illuminate\Http\Response
     */
    public function getImageWithSize($template, $filename, $size)
    {
        $template = $this->getTemplate($template);
        $path = $this->getImagePath($filename);

        // image manipulation based on callback
        $manager = new ImageManager(Config::get('image'));
        $template->ss = $size;
        $content = $manager->cache(static function ($image) use ($template, $path) {
                $image->make($path)->filter($template);
        }, config('imagecache.lifetime'));

        return $this->buildResponse($content);
    }
}
