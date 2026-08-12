<?php

namespace frontend\controllers;

use common\models\SuratMasuk;
use common\models\search\SuratMasukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Bidang;
use common\models\Klasifikasi;
use common\models\Media;
use common\models\UploadFile;
use yii\web\UploadedFile;
use common\models\SuratMasukBidang;
use common\models\search\SuratMasukBidangSearch;
use kartik\mpdf\Pdf;

/**
 * SuratMasukController implements the CRUD actions for SuratMasuk model.
 */
class SuratMasukController extends Controller
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
     * Lists all SuratMasuk models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $roles = \common\models\AuthAssignment::find()->where(['user_id' => \Yii::$app->user->getId()])->one();
        $item_name = $roles->item_name;
        $bidang = \common\models\User::find()->where(['id' => \Yii::$app->user->getId()])->one();
        $kode_bidang = $bidang->bagian_id;
        $searchModel = new SuratMasukSearch();
        
        if ($item_name == 'Kabid') {

            $dataProvider = $searchModel->searchBidang($this->request->queryParams);
            $dataProvider->sort = ['defaultOrder' => ['id'=>SORT_DESC]];
            $dataProvider->query->andWhere(['surat_masuk_bidang.kodeBidang' => $kode_bidang]);
            
            return $this->render('index-bidang', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } elseif ($item_name == 'Kaban') {
                $dataProvider = $searchModel->search($this->request->queryParams);
                $dataProvider->sort = ['defaultOrder' => ['id'=>SORT_DESC]]; 
    
                return $this->render('index-kaban', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                   // 'bidang' => $bidang,
                ]);  
        } else {
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->sort = ['defaultOrder' => ['id'=>SORT_DESC]]; 

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                //'bidang' => $bidang,
            ]);  
        }
        
    }

    /**
     * Displays a single SuratMasuk model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewDisposisi($id)
    {
        $roles = \common\models\AuthAssignment::find()->where(['user_id' => \Yii::$app->user->getId()])->one();
        $item_name = $roles->item_name;
        $bidang = \common\models\User::find()->where(['id' => \Yii::$app->user->getId()])->one();
        $kode_bidang = $bidang->bagian_id;

        return $this->render('view-disposisi', [
            'model' => $this->findModel($id),
            'item_name' => $item_name,
            'kode_bidang' => $kode_bidang,
        ]);
    }

    /**
     * Creates a new SuratMasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SuratMasuk();

        $bidang = ArrayHelper::map(Bidang::find()->All(),
        function($model) {
              return  $model->id;
          }, function($model) {
              return  $model->bidang . '<br>';
          });

        // $klasifikasi = ArrayHelper::map(Klasifikasi::find()
        // ->all() , 'id', 'Keterangan');

        $klasifikasi = ArrayHelper::map(Klasifikasi::find()->All(),
              function($model) {
                    return  $model->id;
                }, function($model) {
                    return  $model->klasifikasi . ' : ' .
                            $model->Keterangan;
                });

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                //$model->tanggalSurat = \Yii::$app->formatter->asDate($model->tanggalSurat, "Y-m-d");
                //$model->tanggalTerimaKirim = \Yii::$app->formatter->asDate($model->tanggalTerimaKirim, "Y-m-d");
   
                $time = date("Y-m-d H:i:s");
                $time = strtotime($time);

                $model->timeCreated = $time;
                $model->save(false);
                return $this->redirect(['index']);
             
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'bidang' => $bidang,
            'klasifikasi' => $klasifikasi,
        ]);
    }

    /**
     * Updates an existing SuratMasuk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $bidang = ArrayHelper::map(Bidang::find()->All(),
        function($model) {
              return  $model->id;
          }, function($model) {
              return  $model->bidang . '<br>';
          });

        // $klasifikasi = ArrayHelper::map(Klasifikasi::find()
        // ->all() , 'id', 'Keterangan');

        $klasifikasi = ArrayHelper::map(Klasifikasi::find()->All(),
              function($model) {
                    return  $model->id;
                }, function($model) {
                    return  $model->klasifikasi . ' : ' .
                            $model->Keterangan;
                });
        if ($this->request->isPost && $model->load($this->request->post())) { 

            $model->save(false);
            return $this->redirect(['index']);
        } 

        return $this->render('update', [
            'model' => $model,
            'bidang' => $bidang,
            'klasifikasi' => $klasifikasi,
        ]);
    }

    public function actionUpdateDisposisi($id)
    {
        $model = $this->findModel($id);

        $model2 = new SuratMasukBidang;

        $modelBidang = SuratMasukBidang::find()->andWhere(['noSurat' => $id])->all();

        $bidang = ArrayHelper::map(Bidang::find()
        ->all() , 'id', 'bidang');

        $klasifikasi = ArrayHelper::map(Klasifikasi::find()->All(),
        function($model) {
              return  $model->id;
          }, function($model) {
              return  $model->klasifikasi . ' : ' .
                      $model->Keterangan;
          });

        if ($this->request->isPost && $model->load($this->request->post()) && $model2->load($this->request->post())) { 

            $model->save(false);
            
            $data = $model2->kodeBidang;

            foreach ($data as $value) {

                $model2 = new SuratMasukBidang;
                $model2->statusSurat  = 0;
                $model2->noSurat = $model->id;
                $model2->kodeBidang = $value;
                $model2->save(false);
                
              }
            
            return $this->redirect(['view-disposisi', 'id' => $model->id]);
        } 

        return $this->render('_form-disposisi', [
            'model' => $model,
            'model2' => $model2,
            'bidang' => $bidang,
            'klasifikasi' => $klasifikasi,
        ]);
    }

    public function actionUpdateDisposisiUbah($id)
    {
        $model = $this->findModel($id);

        $modelBidang = SuratMasukBidang::find()->andWhere(['noSurat' => $id])->all();
        
        $model2 = new SuratMasukBidang;

        if ($modelBidang !=NULL) { 

            foreach($modelBidang as $valueTujuan) {
                $arrayTujuan [] = $valueTujuan->kodeBidang;
    
            }

            $isiTujuan = implode(',', $arrayTujuan);
            
            $arrayBidang = [$isiTujuan];

            $bidang = ArrayHelper::map(Bidang::find()->WHERE([ 'NOT',['id'=> $arrayTujuan]])
            ->all() , 'id', 'bidang');

        } else {
            $bidang = ArrayHelper::map(Bidang::find()->all() , 'id', 'bidang');
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model2->load($this->request->post())) { 
            
            $model->save(false);
            $data = $model2->kodeBidang;

            if ($data !=NULL) {
                foreach ($data as $value) {
                    $model2 = new SuratMasukBidang;
                    $model2->statusSurat  = 0;
                    $model2->noSurat = $model->id;
                    $model2->kodeBidang = $value;
                    $model2->save(false);
                    
                }
            }

            return $this->redirect(['view-disposisi', 'id' => $model->id]);
        } 

        return $this->render('_form-disposisi-ubah', [
            'model' => $model,
            'modelBidang' => $modelBidang,
            'model2' => $model2,
            'bidang' => $bidang,
            
        ]);
    }

    public function actionUpdateDisposisiKaban($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) { 

            $model->save(false);
            return $this->redirect(['view-disposisi', 'id' => $id]);
        } 

        return $this->renderAjax('_form-kaban', [
            'model' => $model,
        ]);
    }

    public function actionUpdateTindaklanjut($id)
    {
        $model = $this->findModelBidang($id);

        if ($this->request->isPost && $model->load($this->request->post())) { 

            $model->statusSurat = 2;
            $model->save(false);
            return $this->redirect(['view-disposisi', 'id' => $model->noSurat]);
        } 

        return $this->renderAjax('_form-tindaklanjut', [
            'model' => $model,
        ]);
    }


    public function actionUpdateTerima($id)
    {
        $model = $this->findModelBidang($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->statusSurat = 1;
            $model->save(false);
            return $this->redirect(['view-disposisi', 'id' => $model->noSurat]);
        } 

        return $this->renderAjax('_form-terima', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing SuratMasuk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteMasukBidang($id)
    {
        $modelMasuk = $this->findModelBidang($id);

        $this->findModelBidang($id)->delete();

        return $this->redirect(['update-disposisi-ubah', 'id' => $modelMasuk->noSurat]);;
    }

    /**
     * Finds the SuratMasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SuratMasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuratMasuk::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelMedia($id)
    {
        if (($model = Media::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelBidang($id)
    {
        if (($model = SuratMasukBidang::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionDaftarFile($id){

        $model = Media::find()->where(['surat_id' => $id])->all();

        return $this->renderAjax('daftar-file', [
            'model' => $model,
        ]);

    }

    public function actionUploadFile($id){

        $model = new Media;

        $request = \Yii::$app->request;

        $idUser  = \Yii::$app->user->getId();

        if ($model->load($request->post())) {

            $date = date('Y-m-d H:i:s');
            
            $image = UploadedFile::getInstance($model, 'file');
            
            if ($image !== null ) {
                $image->saveAs('dok/masuk/' . $image->baseName . '.' . $image->extension);

                // $model->namaDokumen = $image->baseName . $date . '.' . $image->extension;
                $model->file = $image->baseName .'.'. $image->extension;
                $model->surat_id = $id;
                $model->jenisSurat = 0;
                $model->type   = $image->extension;
                $model->uploadAt = $date;
                $model->uploadBy = $idUser;
                $model->save(false);

                if  ($model->save(false)){
                    \Yii::$app->session->addFlash('success', 'Berhasil mengupload file.');
                    return $this->redirect(['view-disposisi', 'id' => $model->surat_id]);
                }
          }
        } else {

        return $this->renderAjax('upload-file', [
            'model' => $model
        ]);
        }
    }

    public function actionViewFile($idDok) 
    {
        $roles = \common\models\AuthAssignment::find()->where(['user_id' => \Yii::$app->user->getId()])->one();
        $item_name = $roles->item_name;

        $model = Media::find()->where(['id' => $idDok])
                      ->one();

        $filePath = '/dok/masuk/';
        $completePath = \Yii::getAlias('@frontend/web'.$filePath.'/'.$model->file);

        return \Yii::$app->response->sendFile($completePath, $model->file, ['inline'=>true]);
    }
    
    public function actionDeleteFile($id, $idSurat)
    {
        $data = Media::findOne($id);
        unlink(\Yii::$app->basePath . '/web/dok/masuk/' . $data->file);
        $this->findModelMedia($id)->delete();

        \Yii::$app->session->addFlash('warning', 'Berhasil menghapus file.', null, true);
        //return $this->redirect(['surat-masuk/index']);
        return $this->redirect(['view-disposisi', 'id' => $idSurat]);
    }

    public function actionCetakSurat() {

        $modelSurat = SuratMasuk::find()->orderBy(['id'=>SORT_DESC])->all();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-surat', [
                'modelSurat' => $modelSurat,
                ]),
            'options' => [
                'target' => '_blank',
                'title' => 'Cetak Rekapitulasi Surat Masuk',
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Aplikasi Manajemen Administrasi (Amanat) Bappedalitbang Deli Serdang || Dicetak: ' . date("d-m-Y h:i:s")
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    
}
