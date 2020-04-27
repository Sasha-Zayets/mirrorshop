<?php

namespace App\Templates\TemplateModels;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateImageModel
 * @package App\TemplateModels
 */
abstract class TemplateImageModel extends Model
{
    public const DESKTOP = '';
    public const TABLET = 't_';
    public const MOBILE = 'm_';

    public const ARRAY_DEVICE = [self::DESKTOP, self::TABLET, self::MOBILE];

    public const BASE_FIELD_NAME = 'file_name';

    private $dir;
    private $path;

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getDir()
    {
        return config(
            'image.' . class_basename($this),
            config('image.DefaultImage')
        );
    }

    /**
     * TemplateImageModel constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dir = $this->getDir();
        $this->path = public_path('/img/' . $this->dir . '/');
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        foreach (self::ARRAY_DEVICE as $prefix) {
            if (!empty($this->{$prefix . self::BASE_FIELD_NAME})
                && is_file($this->path . $this->{$prefix . self::BASE_FIELD_NAME})
            ) {
                delete_img_with_webp($this->path . $this->{$prefix . self::BASE_FIELD_NAME});
            }
        }

        return parent::delete();

    }

    /**
     * @param $size
     * @param string $type
     * @return string
     */
    public  function getPath($size, $type = self::DESKTOP)
    {
        $path = '/images/' . $this->dir . '/' . $size . '/';

        $file_name = config('image.no_img', 'no-img.png');
        if (!empty($this->{$type . self::BASE_FIELD_NAME})
            && file_exists($this->path . $this->{$type . self::BASE_FIELD_NAME})
        ) {
            $file_name =  $this->{$type . self::BASE_FIELD_NAME};
        }

        return $path . $file_name;
    }

    public function hasFile($type = self::DESKTOP)
    {
        if (!empty($this->{$type . self::BASE_FIELD_NAME})
            && file_exists($this->path . $this->{$type . self::BASE_FIELD_NAME})
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param $size
     * @param string $type
     * @param string $filter
     * @return string
     */
    public  function getWebpPath($size, $type = self::DESKTOP, $filter = '')
    {
        $path = '/images/' . (empty($filter) ? $this->dir : $filter) . '/' . $size . '/';

        $file_name = config('image.no_img', 'no-img.png');
        $webpFile  = preg_replace('/.[^.]*$/', '.webp', $this->{$type . self::BASE_FIELD_NAME});
        if (!empty($webpFile)
            && file_exists($this->path . $webpFile)
        ) {
            $file_name =  $webpFile;
        }

        return $path . $file_name;
    }
}
