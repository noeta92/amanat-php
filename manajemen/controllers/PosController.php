<?php

namespace backend\controllers;

use common\models\Pos;
use common\models\search\PosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PosController implements the CRUD actions for Pos model.
 */
class PosController extends Controller
{
    /**
     * @inheritDoc
     */
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
     * Lists all Pos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pos model.
     * @param int $idPos Id Pos
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idPos)
    {
        return $this->render('view', [
            'model' => $this->findModel($idPos),
        ]);
    }

    /**
     * Creates a new Pos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idPos' => $model->idPos]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idPos Id Pos
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idPos)
    {
        $model = $this->findModel($idPos);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idPos' => $model->idPos]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idPos Id Pos
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idPos)
    {
        $this->findModel($idPos)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idPos Id Pos
     * @return Pos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idPos)
    {
        if (($model = Pos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
