<?php

namespace frontend\controllers;

use common\components\Expansion;
use common\models;
use common\models\Product;
use yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class SiteController
 * @package frontend\controllers
 */
class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @param string $code
     */
    protected function setExpansionByCode($code)
    {
        if (empty($code)) {
            return;
        }

        /** @var models\Expansion $expansion */
        $expansion = models\Expansion::find()->andFilterWhere(['code' => $code])->one();

        if (empty($expansion)) {
            return;
        }

        /** @var Expansion $expansionComponent */
        $expansionComponent = Yii::$app->get('expansion');
        $expansionComponent->setForceExpansion($expansion->id, $code);
    }

    /**
     * Displays homepage.
     *
     * @param string $code
     *
     * @return string
     */
    public function actionIndex($code = null)
    {
        
        if (empty($code)) {
            /** @var Expansion $expansionComponent */
            $expansionComponent = Yii::$app->get('expansion');
            
            return $this->redirect(['index', 'code' => $expansionComponent->getCode()]);
        }
        /** @var \Yii\caching\MemCache $memcached */
        // $memcached = Yii::$app->get('memcached');
        $url = Yii::$app->request->getUrl();

        // $output    = $memcached->get($url);

        if ( ! empty($output)) {
            return $output;
        }
        
        $this->setExpansionByCode($code);
        
        $query = Product::find()->active();
        $expansion = models\Expansion::find()->andFilterWhere(['code' => $code])->one();
        $priceShow = $expansion->price;
        $models = new ActiveDataProvider(
            [
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'sort_order' => SORT_DESC,
                        'score_rating' => SORT_DESC,
                        ]
                    ],
            ]
        );

        $output = $this->render('index', ['models' => $models, 'priceShow' => $priceShow]);
        
        // $memcached->set($url, $output);
        return $output;
    }
            
    /**
     * Display review page for product
     *
     * @param string $title
     * @param string $code
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionReview($title, $code = null)
    {
        /** @var \Yii\caching\MemCache $memcached */
        // $memcached = Yii::$app->get('memcached');
        
        // $url = Yii::$app->request->getUrl();
        // $output    = $memcached->get($url);
        
        if ( ! empty($output)) {
            return $output;
        }
                
        if ( ! empty($code)) {
            $this->setExpansionByCode($code);
        }
        
        $model = Product::find()->byTitle($title)->active()->one();
        $expansion = models\Expansion::find()->andFilterWhere(['code' => $code])->one();
        $priceShow = $expansion->price;
        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        $output = $this->render('review', ['model' => $model, 'priceShow' => $priceShow]);

        // $memcached->set($url, $output);

        return $output;
    }

    public function actionPrivacyPolicy($code)
    {
        if ( ! empty($code)) {
            $this->setExpansionByCode($code);
        }

        return $this->render('privacy-policy');
    }
}
