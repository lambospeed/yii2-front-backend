<?php

namespace backend\controllers;

use common\components\Expansion;
use common\models\Expansion as ExpansionModel;
use common\models\TextBlock;
use backend\components\Controller;
use yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class TextBlockController
 * @package backend\controllers
 *
 * TextBlockController implements the CRUD actions for TextBlock model.
 */
class TextBlockController extends Controller
{
    /**
     * Lists all TextBlock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = TextBlock::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing TextBlock model.
     * If update is successful, the browser will be redirected to the index page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $expansionId = Yii::$app->request->get('expansionId', null);
        if (empty($expansionId)) {
            /** @var ExpansionModel $expansion */
            $expansion = ExpansionModel::find()->andFilterWhere(['default' => (int)true])->one();
            if (!empty($expansion)) {
                $expansionId = $expansion->id;
            }
        }

        /** @var Expansion $expansionComponent */
        $expansionComponent = Yii::$app->get('expansion');
        $expansionComponent->setForceExpansion($expansionId);

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->flushCache();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the TextBlock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TextBlock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TextBlock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
