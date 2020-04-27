<?php

namespace App\Templates\TemplateModels;

use App\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

/**
 * Class TemplateContentModel
 * @package App\TemplateModels
 */
abstract class TemplateContentModel extends Model
{
    /**
     * @param $lang
     */
    public function setLocale($lang)
    {
        $langs = config('app.langs', []);
        if (in_array($lang, $langs)) {
            \App::setLocale($lang);
        }
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        $content = $this->contents->where('lang', App::getLocale())->first();

        return ($content->name ?? "");
    }

    /**
     * @return string
     */
    public function getH1Attribute()
    {
        $content = $this->contents->where('lang', App::getLocale())->first();

        return ($content->h1 ?? "");
    }

    /**
     * @return string
     */
    public function getTitleAttribute()
    {
        $content = $this->contents->where('lang', App::getLocale())->first();

        return ($content->title ?? "");
    }

    /**
     * @return string
     */
    public function getDescriptionAttribute()
    {
        $content = $this->contents->where('lang', App::getLocale())->first();

        return ($content->description ?? "");
    }

    /**
     * @return string
     */
    public function getTextAttribute()
    {
        $content = $this->contents->where('lang', App::getLocale())->first();

        return ($content->text ?? "");
    }

    /**
     * @return |null
     */
    public function createContent()
    {
        $class = get_class($this) . 'Content';

        if (class_exists($class)) {
            return new $class();
        }

        return null;
    }

    /**
     * @return |null
     */
    public function createImage()
    {
        $class = get_class($this) . 'Image';

        if (class_exists($class)) {
            return new $class();
        }

        return null;
    }

    public function scopeOrderByName($query)
    {
        $contentTable = $this->contents()->getRelated()->getTable();
        $contentKey   = $this->contents()->getForeignKeyName();
        $mainTable    = $this->getTable();

        $query->where($contentTable . '.lang', App::getLocale())
            ->join($contentTable, $mainTable .'.id', '=', $contentTable . '.' . $contentKey)
            ->orderBy($contentTable . '.name');

        return $query;
    }

    /**
     * @return string
     */
    public function getCanonical()
    {
        if (empty($this->canonical)) {
            return '';
        }

        return request()->root() . '/' . get_locale() . '/' . $this->canonical . '/';
    }
}
