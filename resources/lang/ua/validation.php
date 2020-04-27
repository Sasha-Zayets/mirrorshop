<?php
/*
 * мета теги і HTML тут не зберігати!!
 */

return [

    'attributes' => [
        'login'         => 'ім\'я користувача',
        'password'      => 'пароль',
        'phone'         => 'телефон',
        'phones.*.number' => 'номер телефону',
        'name'          => 'ім\'я',
        'email'         => 'email',
        'delivery'      => 'спосіб доставки',
        'typeDelivery'  => 'тип доставки',
        'city'          => 'місто',
        'warehouse'     => 'адреса відділення',
        'address'       => 'адреса',
        'comment'       => 'коментар',
        'location'      => [
            'data'  => [
                'ru' => 'локація RU',
                'ua' => 'локація UA'
            ]
        ],
    ],

    'required'  => 'Поле :attribute обов\'язкове.',
    'email'     => 'Email вказано невірно.',
    'numeric' => 'Поле :attribute може містити тільки число',
    'max'   => [
        'numeric'   => 'Поле :attribute повинно містити до 255 символов.',
    ],

];
