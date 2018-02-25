<?php

namespace backend\controllers;

use common\components\Expansion;
use common\models\Expansion as ExpansionModel;
use common\models\Product;
use common\models\ProductClone;
use backend\models\ProductSearch;
use backend\components\Controller;
use yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Class ProductController
 * @package backend\controllers
 *
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'sort_order' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model           = new Product();
        $model->scenario = 'create';

        if ( ! $model->load(Yii::$app->request->post()) || ! $model->validate()) {
            return $this->render(
                'create',
                [
                    'model' => $model,
                ]
            );
        }

        $transaction = Yii::$app->db->beginTransaction();

        /** add duplicates to all Expansions */

        /** @var Expansion $expansionComponent */
        $expansionComponent = Yii::$app->get('expansion');

        try {
            /** @var ExpansionModel[] $expansions */
            $expansions = ExpansionModel::find()->all();

            foreach ($expansions as $expansion) {
                $expansionComponent->setForceExpansion($expansion->id);
                $model->save();

                $fileName = $model->image;

                $model = new ProductClone();
                $model->scenario = 'clone';
                $model->load(Yii::$app->request->post(), "Product");
                $model->image = $fileName;
            }
        } catch (yii\db\Exception $exception) {
            $transaction->rollBack();

            return $this->render(
                'create',
                [
                    'model' => $model,
                ]
            );
        }

        $transaction->commit();

        $this->flushCache();

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Product model.
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
     * Deletes an existing Product model.
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

    /**
     * Save preview image crop settings
     *
     * @param integer $id
     */
    public function actionSavePreview($id)
    {
        $model = $this->findModel($id);

        $request = Yii::$app->request;

        $x1 = $request->post('x1');
        $x2 = $request->post('x2');
        $y1 = $request->post('y1');
        $y2 = $request->post('y2');

        $h = $request->post('h');
        $w = $request->post('w');

        $imageHeight = $request->post('image_height');
        $imageWidth  = $request->post('image_width');

        if (empty($w)) {
            //nothing selected
            return;
        }

        $imageSource = $model->getUploadedFilePath('image');

        switch(pathinfo($imageSource, PATHINFO_EXTENSION)) {
            case image_type_to_extension(IMAGETYPE_PNG, false) :
                $originImageResource = imagecreatefrompng($imageSource);
                break;

            case image_type_to_extension(IMAGETYPE_JPEG, false) :
                $originImageResource = imagecreatefromjpeg($imageSource);
                break;

            case image_type_to_extension(IMAGETYPE_GIF, false) :
                $originImageResource = imagecreatefromgif($imageSource);
                break;

            default:
                // TODO error
                echo "Check format of image " . PHP_EOL;
                return;
        }

        $width  = imagesx($originImageResource);
        $height = imagesy($originImageResource);

        $resizedWidth  = ((int)$x2) - ((int)$x1);
        $resizedHeight = ((int)$y2) - ((int)$y1);

        $resizedImageResource = imagecreatetruecolor($resizedWidth, $resizedHeight);

        imagecopyresampled(
            $resizedImageResource,
            $originImageResource,
            0,
            0,
            (int)$x1,
            (int)$y1,
            $resizedWidth,
            $resizedHeight,
            $width,
            $height
        );

        $resizedImageSource = str_replace($model->image, "preview_" . $model->image, $imageSource);

        imagepng($resizedImageResource, $resizedImageSource);
        
        /** @var Expansion $expansionComponent */
        $expansionComponent = Yii::$app->get('expansion');

        /** @var ExpansionModel[] $expansions */
        $expansions = ExpansionModel::find()->all();
        foreach ($expansions as $expansion) {
            $expansionComponent->setForceExpansion($expansion->id);
            $model                = $this->findModel($id);
            $model->preview_image = $model->image;
            $model->save();
        }

        $this->flushCache();
    }
}
