<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    const TYPE_PHONE = 1;
    const TYPE_EMAIL = 2;
    const TYPE_LOCATION = 3;
    const TYPE_SOCIAL_LINK = 4;
    const TYPE_SCHEDULE = 12;

    const DEFAULT_EMAIL = 'zhenya@webmaestro.com.ua';

    protected $fillable = [
        'type',
        'data',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected $visible = [
        'data',
        'type',
        'id'
    ];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getPhoneAttribute()
    {
        if (!empty($this->data['number'])) {
            return $this->data['number'];
        }

        return '';
    }

    public function getTelegramNickAttribute()
    {
        if (!empty($this->data['telegram-nick'])) {
            return str_replace('@', '', $this->data['telegram-nick']);
        }


        return '';
    }

    public function getPhoneWithoutBracketAttribute()
    {
        if (!empty($this->data['number'])) {
            return str_replace(['(', ')'], '', $this->data['number']);
        }

        return '';
    }

    public function getPhoneCodeOperatorAttribute()
    {
        return substr($this->data['number'], 0, 3);
    }

    public function getPhoneOperatorAttribute()
    {
        if (!empty($this->data['operator'])) {
            return $this->data['operator'];
        }

        return '';
    }


    public function getClearPhoneAttribute()
    {
        if (!empty($this->data['number'])) {
            return str_replace([' ', '-' , '(', ')'], '', $this->data['number']);
        }

        return '';
    }

    public function getIsHasViberAttribute()
    {

        return (!empty($this->data['messenger']['viber']) AND $this->data['messenger']['viber']);
    }

    public function getIsHasWhatsappAttribute()
    {

        return (!empty($this->data['messenger']['whatsapp']) AND $this->data['messenger']['whatsapp']);
    }

    public function getIsHasTelegramAttribute()
    {

        return (!empty($this->data['messenger']['telegram']) AND $this->data['messenger']['telegram']);
    }

    public function getEmailAttribute()
    {
        if (!empty($this->data[0])) {
            return $this->data[0];
        }

        return '';
    }

    public function getManagerIndexAttribute()
    {
        if (!empty($this->data[0])) {
            return $this->data[0];
        }

        return 1;
    }

    public function getLocationAttribute()
    {
        if (!empty($this->data[get_locale()])) {
            return $this->data[get_locale()];
        }

        return '';
    }

    public function getCacheName()
    {
        return self::CACHE_NAME_ALLEGRO_NEW_PRODUCT . $this->id;
    }

    public function getTokenAttribute()
    {
        return !empty($this->data['access_token']) ? $this->data['access_token'] : "";
    }

    public function getRefreshTokenAttribute()
    {
        return !empty($this->data['refresh_token']) ? $this->data['refresh_token'] : "";
    }

    public function getExpiresInAttribute()
    {
        return !empty($this->data['expires_in']) ? $this->data['expires_in'] : "";
    }

    public function getExpiresAtAttribute()
    {
        return !empty($this->data['expires_at']) ? $this->data['expires_at'] : (time() - 1);
    }

    public function getLastMarkSitemap()
    {
        return !empty($this->data['mark']) ? $this->data['mark'] : 0;
    }

    public function getLastModelSitemap()
    {
        return !empty($this->data['model']) ? $this->data['model'] : 0;
    }

    public function getLastModSitemap()
    {
        return !empty($this->data['mod']) ? $this->data['mod'] : 0;
    }

    public function getLastModelDetailsSitemap()
    {
        return !empty($this->data['model_details']) ? $this->data['model_details'] : 0;
    }

    public function getLastModDetailsSitemap()
    {
        return !empty($this->data['mod_details']) ? $this->data['mod_details'] : 0;
    }

    public function getLastONSitemap()
    {
        return !empty($this->data['on']) ? $this->data['on'] : 0;
    }

    public function getPaginationCatalogAttribute()
    {
        if (!empty($this->data['catalog'])) {
            return (int) $this->data['catalog'];
        }

        return 10;
    }


    public function getKeyIndexificationAttribute()
    {
        if (!empty($this->data[0])) {
            return $this->data[0];
        }

        return '';
    }

    public function getIsVisibleBinotelAttribute()
    {
        if (!empty($this->data[0])) {
            return (int) $this->data[0];
        }

        return 0;
    }

    public function getScheduleWeekdaysAttribute()
    {
        if (!empty($this->data['weekdays'])) {
            return  $this->data['weekdays'];
        }

        return [];
    }

    public function getScheduleSaturdayAttribute()
    {
        if (!empty($this->data['saturday'])) {
            return  $this->data['saturday'];
        }

        return [];
    }
}
