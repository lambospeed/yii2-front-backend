<?php
namespace frontend\widgets;


use yii\base\Widget;

class FeaturedWidget extends Widget
{
    public $model;
    public $priceShow;

    public function run()
    {
        return $this->render('featured', ['model' => $this->model, 'priceShow' => $this->priceShow]);
    }
}