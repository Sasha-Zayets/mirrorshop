<?php

namespace App;

use App\Exceptions\ServiceErrorException;
use App\Templates\TemplateModels\TemplateImageModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Slider extends Model
{
    protected $fillable = [
        'title_ru',
        'title_ua',
        'description_ua',
        'description_ru',
        'sort',
        'active',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function images()
    {
        return $this->hasOne('App\SliderImage', 'slider_id', 'id');
    }

    public function getFileType($type)
    {
        switch ($type) {
            case 'desktop':
                return TemplateImageModel::DESKTOP;
            case 'mobile':
                return TemplateImageModel::MOBILE;
            case 'tablet':
                return TemplateImageModel::TABLET;
            default:
                return TemplateImageModel::DESKTOP;
        }
    }

    /**
     * Scope a query to only include active elements.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function getImage($size, $type = TemplateImageModel::DESKTOP, $filter = '')
    {
        $image = $this->images->where('lang', App::getLocale())->first();
        if (is_null($image)) {
            $image = new SliderImage();
        }

        return $image->getPath($size, $type, $filter);
    }

    public function getWebpImage($size, $type = TemplateImageModel::DESKTOP, $filter = '')
    {
        $image = $this->images->where('lang', App::getLocale())->first();
        if (is_null($image)) {
            $image = new SliderImage();
        }

        return $image->getWebpPath($size, $type, $filter);
    }

    public function hasFile($type = TemplateImageModel::DESKTOP)
    {
        $image = $this->images->where('lang', App::getLocale())->first();
        if (is_null($image)) {
            $image = new SliderImage();
        }

        return $image->hasFile($type);
    }

    public static function getSlider()
    {
        if (!$items = cache('slider')) {
            $items = Slider::with('images')->whereActive(1)
                ->orderBy('sort')->get();

            $expiresAt = now()->addMinutes(30);
            cache(['slider' => $items], $expiresAt);
        }

        return $items;
    }

    /**
     * @return bool|null
     * @throws ServiceErrorException
     */
    public function delete()
    {
        if (!$this->images->delete()) {
            $error = new ServiceErrorException('Помилка при видалені зображення');
            report($error);
            throw $error;
        }

        if (!parent::delete()) {
            $error = new ServiceErrorException('Помилка видалення');
            report($error);
            throw $error;
        }

        return true;
    }
}
