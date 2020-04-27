<?php
/*
 * мета теги і HTML тут не зберігати!!
 */

return [

    'attributes' => [
        'login'         => 'имя пользователя',
        'password'      => 'пароль',
        'phone'         => 'телефон',
        'phones.*.number' => 'номер телефона',
        'name'          => 'имя',
        'email'         => 'email',
        'delivery'      => 'способ доставки',
        'typeDelivery'  => 'тип доставки',
        'city'          => 'город',
        'warehouse'     => 'адрес отделения',
        'address'       => 'адрес',
        'comment'       => 'комментарий',
        'location'      => [
            'data'  => [
                'ru' => 'локация RU',
                'ua' => 'локация UA'
            ]
        ],
    ],

    'required'  => 'Поле :attribute обязательное.',
    'email'     => 'Email указан неверно.',
    'numeric' => 'Поле :attribute может содержать только число',
    'max'   => [
        'string'   => 'Поле :attribute должно содержать до 255 символов.',
    ],

];
