<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'memcached' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached' => true,
            'keyPrefix' => 'truedefense',
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => '11211',
                    'weight' => '100'
                ],
            ]
        ],
        'expansion' => [
            'class' => 'common\components\Expansion',
        ],
        'formatter' => [
            'class' => 'common\components\Formatter',
        ],
        'geoip' => [
            'class' => 'dpodium\yii2\geoip\components\CGeoIP',
            'mode' => 'STANDARD',
        ],
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ]
];
