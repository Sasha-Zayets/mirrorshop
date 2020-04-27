<?php

namespace App\Http\Resources\Admin;

use App\Templates\TemplateModels\TemplateImageModel;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sort' => $this->sort,
            'active' => $this->active,
            'desktop' => url('') . $this->images->getPath(250, TemplateImageModel::DESKTOP),
            'tablet' => url('') . $this->images->getPath(250, TemplateImageModel::TABLET),
            'mobile' => url('') . $this->images->getPath(250, TemplateImageModel::MOBILE),
            'title_ua' => $this->title_ua,
            'title_ru' => $this->title_ru,
            'description_ua' => $this->description_ua,
            'description_ru' => $this->description_ru,
        ];
    }
}
