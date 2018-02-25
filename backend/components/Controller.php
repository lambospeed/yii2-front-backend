<?php

namespace backend\components;

use yii;
use yii\caching\MemCache;
use yii\filters\AccessControl;

/**
 * Class Controller
 * @package backend\components
 */
class Controller extends yii\web\Controller
{
    protected function flushCache() {
        /** @var MemCache $memcached */
        $memcached = Yii::$app->get('memcached');

        $memcached->flush();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}