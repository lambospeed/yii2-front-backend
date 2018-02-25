<?php

namespace frontend\widgets;

use common\models\Product;
use yii\base\Widget;

/**
 * Class TopWidget
 * @package frontend\widgets
 * @var $models Product[]
 */
class TopWidget extends Widget
{
    public $category;

    public function run()
    {
        $models = Product::find()->active()
                         ->andFilterWhere([
                             'category' => $this->category
                         ])
                         ->orderBy(['score_rating' => SORT_DESC])
                         ->limit(5)
                         ->all();

        return $this->render('top', [
            'models' => $models
        ]);
    }
}
