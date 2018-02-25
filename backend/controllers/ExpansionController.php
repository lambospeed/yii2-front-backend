<?php

namespace backend\controllers;

use common\models\Expansion;
use common\models\ExpansionSearch;
use backend\components\Controller;
use yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Class ExpansionController
 * @package backend\controllers
 *
 * ExpansionController implements the CRUD actions for Expansion model.
 */
class ExpansionController extends Controller
{
    /**
     * List of targets tables. They are used expansion multisite feature
     * @var array
     */
    protected $expansionsTables = [
        'faq',
        'product',
        'setting',
        'text_block',
    ];

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
     * Lists all Expansion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpansionSearch();
        $query = Expansion::find();

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Finds the Expansion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expansion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expansion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Expansion model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expansion();
        $model->price = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /** @var Expansion $defaultExpansion */
            $defaultExpansion = Expansion::find()->andFilterWhere(['default' => 1])->one();
            if (!empty($defaultExpansion)) {

                foreach ($this->expansionsTables as $tableName) {
                    $command = Yii::$app->db->createCommand(
                        "CREATE TABLE `" . $tableName . "_" . $model->id . "`" .
                        " LIKE `" . $tableName . "_" . $defaultExpansion->id . "`"
                    );

                    $command->execute();

                    $command = Yii::$app->db->createCommand(
                        "INSERT INTO `" . $tableName . "_" . $model->id . "`" .
                        " SELECT * FROM `" . $tableName . "_" . $defaultExpansion->id . "`"
                    );

                    $command->execute();

                    $connectionUrl = str_replace(":", "://host/?", Yii::$app->db->dsn);
                    $connectionUrl = str_replace(";", "&", $connectionUrl);
                    $params = parse_url($connectionUrl);
                    parse_str($params['query'], $params);

                    $command = Yii::$app->db->createCommand(
                        "SELECT `AUTO_INCREMENT`
                        FROM  INFORMATION_SCHEMA.TABLES
                        WHERE TABLE_SCHEMA = :database
                        AND   TABLE_NAME   = :default_table_name;",
                        [
                            ':database'           => $params['dbname'],
                            ':default_table_name' => $tableName . "_" . $defaultExpansion->id,
                        ]
                    );

                    $autoIncrementValue = $command->queryScalar();

                    $command = Yii::$app->db->createCommand(
                        "ALTER TABLE `" . $tableName . "_" . $model->id . "` AUTO_INCREMENT = " . (int)$autoIncrementValue
                    );

                    $command->execute();

                }
            } else {
                // TODO this is error in logic, because default expansion isn't existed in database
            }

            $this->flushCache();

            return $this->redirect(['index']);
        } else {
            return $this->render(
                'create',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Updates an existing Expansion model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->flushCache();

            return $this->redirect(['index']);
        } else {
            return $this->render(
                'update',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Deletes an existing Expansion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        foreach ($this->expansionsTables as $tableName) {
            $command = Yii::$app->db->createCommand(
                "DROP TABLE `" . $tableName . "_" . $id . "`"
            );

            $command->execute();
        }

        $this->flushCache();

        return $this->redirect(['index']);
    }
}
