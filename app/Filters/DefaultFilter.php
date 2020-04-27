<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

/**
 * Class ImgCarBrand
 * @package App\Filters
 */
class DefaultFilter implements FilterInterface
{
    public $ss;

    /**
     * @param Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        $width = null;
        $height = null;
        $size = (int) request()->segment(3);

        $width = $image->width() > $size
            ? $size
            : $image->width();

        return $image->resize($width, $height, static function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
