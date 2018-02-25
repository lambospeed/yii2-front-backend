<?php

namespace backend\controllers;

use backend\components\Controller;
use yii\web\Response;

/**
 * Class CacheController
 * @package backend\controllers
 */
class CacheController extends Controller
{
    /**
     * @return Response
     */
    public function actionClear()
    {
        $this->flushCache();

        return $this->redirect(['/']);
    }
}
