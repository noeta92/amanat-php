<?php

namespace backend\controllers;

use common\models\Laman;
use common\models\search\LamanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LamanController implements the CRUD actions for Laman model.
 */
class LamanController extends Controller
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
     * Lists all Laman models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LamanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Laman model.
     * @param int $idLaman Id Laman
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idLaman)
    {
        return $this->render('view', [
            'model' => $this->findModel($idLaman),
        ]);
    }

    /**
     * Creates a new Laman model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Laman();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idLaman' => $model->idLaman]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Laman model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idLaman Id Laman
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idLaman)
    {
        $model = $this->findModel($idLaman);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idLaman' => $model->idLaman]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Laman model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idLaman Id Laman
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idLaman)
    {
        $this->findModel($idLaman)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Laman model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idLaman Id Laman
     * @return Laman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idLaman)
    {
        if (($model = Laman::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
