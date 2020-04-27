<?php

namespace App;

use App\Templates\TemplateModels\TemplateImageModel;

class SliderImage extends TemplateImageModel
{
    const FIELD_NAMES = [
        'desktop'   => 'file_name',
        'tablet'    => 't_file_name',
        'mobile'    => 'm_file_name',
    ];

    public $fileFields = [
        'file_name',
        't_file_name',
        'm_file_name',
    ];

    protected $fillable = [
        'slider_id',
        'file_name',
        't_file_name',
        'm_file_name',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];



    public static function boot()
    {
        parent::boot();

        self::updated(function($model) {
            foreach ($model->changes as $fieldName => $value) {
                // якщо відредаговано файлове поле
                if(in_array($fieldName, $model->fileFields)) {
                    if($imageToDelete = array_get($model->original, $fieldName)) {
                        //видаляємо старе зображення
                        delete_img_with_webp(public_path('/img/slider/' . $imageToDelete));
                    }
                }
            }
        });
    }
}
