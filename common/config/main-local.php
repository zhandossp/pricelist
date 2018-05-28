<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=priceclick1',
            'username' => 'root',
            'password' => 'Cvetok_847',
            'charset' => 'utf8',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@backend/views/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'ukiuki.zakaz@gmail.com',
                'password' => 'Maint112233',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ], 
];
