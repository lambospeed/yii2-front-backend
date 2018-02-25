<?php

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\CookieCollection;

/**
 * Class CookiesLawController
 * @package frontend\controllers
 */
class CookiesLawController extends Controller
{
    public function actionGotIt()
    {
        /** @var CookieCollection $cookies */
        $cookies = Yii::$app->response->cookies;

        $cookies->add(
            new Cookie([
                'name'  => 'cookies_law_got_it',
                'value' => true,
            ])
        );

        return json_encode(['response' => true]);
    }

    public function actionGetState()
    {
        $cookie = Yii::$app->request->cookies->get('cookies_law_got_it');

        $result = empty($cookie) ? false : $cookie->value;

        return json_encode(['response' => $result]);
    }
}
