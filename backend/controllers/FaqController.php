<?php

namespace backend\controllers;

use common\components\Expansion;
use common\models\Expansion as ExpansionModel;
use common\models\Faq;
use backend\components\Controller;
use yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Class FaqController
 * @package backend\controllers
 *
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Faq models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Faq::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Faq();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            /** add duplicates to all Expansions */

            /** @var Expansion $expansionComponent */
            $expansionComponent = Yii::$app->get('expansion');

            /** @var ExpansionModel[] $expansions */
            $expansions = ExpansionModel::find()->all();
            foreach($expansions as $expansion) {
                $expansionComponent->setForceExpansion($expansion->id);
                $model->isNewRecord = true;
                $model->save();
            }

            $this->flushCache();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Faq model.
     * If update is successful, the browser will be redirected to the 'view' page.
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
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Deletes an existing Faq model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /** @var Expansion $expansionComponent */
        $expansionComponent = Yii::$app->get('expansion');

        /** @var ExpansionModel[] $expansions */
        $expansions = ExpansionModel::find()->all();
        foreach($expansions as $expansion) {
            $expansionComponent->setForceExpansion($expansion->id);
            $this->findModel($id)->delete();
        }

        $this->flushCache();

        return $this->redirect(['index']);
    }
}
