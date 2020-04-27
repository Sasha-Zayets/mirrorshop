<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhoneResource extends JsonResource
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
            'number' => array_get($this->data, 'number', ''),
            'is_viber' => array_get($this->data, 'messenger.viber', 0),
            'is_telegram' => array_get($this->data, 'messenger.telegram', 0),
            'telegram_name' => array_get($this->data, 'telegram-nick', ''),
        ];
    }
}
