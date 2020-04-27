<?php

namespace App\Http\Resources;

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
            'desktop' => url('') . $this->images->getPath(1060, TemplateImageModel::DESKTOP),
            'tablet' => url('') . $this->images->getPath(600, TemplateImageModel::TABLET),
            'mobile' => url('') . $this->images->getPath(576, TemplateImageModel::MOBILE),
            'desktop_webp' => url('') . $this->images->getWebpPath(1060, TemplateImageModel::DESKTOP),
            'tablet_webp' => url('') . $this->images->getWebpPath(600, TemplateImageModel::TABLET),
            'mobile_webp' => url('') . $this->images->getWebpPath(576, TemplateImageModel::MOBILE),
            'title_ua' => $this->title_ua,
            'title_ru' => $this->title_ru,
            'description_ua' => $this->description_ua,
            'description_ru' => $this->description_ru,
        ];
    }
}
