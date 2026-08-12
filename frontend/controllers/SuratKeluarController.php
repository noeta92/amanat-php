<?php

namespace frontend\controllers;

use common\models\SuratKeluar;
use common\models\search\SuratKeluarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Bidang;
use common\models\Klasifikasi;
use common\models\Media;
use common\models\UploadFile;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

/**
 * SuratKeluarController implements the CRUD actions for SuratKeluar model.
 */
class SuratKeluarController extends Controller
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
     * Lists all SuratKeluar models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $roles = \common\models\AuthAssignment::find()->where(['user_id' => \Yii::$app->user->getId()])->one();
        $item_name = $roles->item_name;
        $bidang = \common\models\User::find()->where(['id' => \Yii::$app->user->getId()])->one();
        $kode_bidang = $bidang->bagian_id;
       
        $searchModel = new SuratKeluarSearch();

        if ($item_name == 'Kabid') {
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->sort = ['defaultOrder' => ['statusKirim'=> SORT_ASC, 'tanggalSurat' => SORT_DESC]];
            $dataProvider->query->andWhere(['kodeBidang' => $kode_bidang]); 

        } else {
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->sort = ['defaultOrder' => ['statusKirim'=> SORT_ASC, 'tanggalSurat' => SORT_DESC]];
            
        }

        $bidang = ArrayHelper::map(Bidang::find()
        ->all() , 'id', 'bidang');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bidang' => $bidang,
        ]);
    }

    /**
     * Displays a single SuratKeluar model.
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

    public function actionViewNomor($id)
    {
        return $this->render('view-nomor', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SuratKeluar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $roles = \common\models\AuthAssignment::find()->where(['user_id' => \Yii::$app->user->getId()])->one();
        $item_name = $roles->item_name;
        
        $bidang = \common\models\User::find()->where(['id' => \Yii::$app->user->getId()])->one();
        $kode_bidang = $bidang->bagian_id;

        $model = new SuratKeluar();

        $bidang = ArrayHelper::map(Bidang::find()
        ->all() , 'id', 'bidang');
        
        $klasifikasi = ArrayHelper::map(Klasifikasi::find()->All(),
              function($model) {
                    return  $model->id;
                }, function($model) {
                    return  $model->klasifikasi . ' : ' .
                            $model->Keterangan;
                });
        
        $arrayBidang = ArrayHelper::map(Bidang::find()->All(),
            function($model) {
                    return  $model->id;
                }, function($model) {
                    return  $model->bidang;
                });

        
        if($item_name == 'Kabid'){
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $time = date("Y-m-d");
                    $time = strtotime($time);
                    $model->statusKirim = 0;
                    $model->kodeBidang = $kode_bidang;
                    $model->timeCreated = $time;
                    $model->save(false);
                    return $this->redirect(['index']);
                }
            } else {
                $model->loadDefaultValues();
            }
        } else {
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {

                    $time = date("Y-m-d");
                    $time = strtotime($time);
                    $model->statusKirim = 1;
                    $model->timeCreated = $time;

                    if ($model->validate()) {
                        $model->save(false);
                        return $this->redirect(['index']);
                    } else {
                        $data = $model->getErrors();
                        \Yii::$app->session->setFlash('warning', '<strong>Nomor surat sudah ada!!!</strong>');// its dislplays error msg on your form
                    }

                    
                }
            } else {
                $model->loadDefaultValues();
            }
        }
        return $this->render('create', [
            'model' => $model,
            'arrayBidang' => $arrayBidang,
            'klasifikasi' => $klasifikasi,
            'item_name' => $item_name,
        ]); 
     
    }

    /**
     * Updates an existing SuratKeluar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $roles = \common\models\AuthAssignment::find()->where(['user_id' => \Yii::$app->user->getId()])->one();
        $item_name = $roles->item_name;
        
        $model = $this->findModel($id);

        $bidang = ArrayHelper::map(Bidang::find()
        ->all() , 'id', 'bidang');

        $klasifikasi = ArrayHelper::map(Klasifikasi::find()->All(),
        function($model) {
              return  $model->id;
          }, function($model) {
              return  $model->klasifikasi . ' : ' .
                      $model->Keterangan;
          });

          $arrayBidang = ArrayHelper::map(Bidang::find()->All(),
          function($model) {
                  return  $model->id;
              }, function($model) {
                  return  $model->bidang;
              });

        if ($this->request->isPost && $model->load($this->request->post())) { 

            $model->save(false);
            \Yii::$app->session->setFlash('success', 'Berhasil ubah data');// its dislplays error msg on your form
            return $this->redirect(['index']);
        } 

        return $this->render('update', [
            'model' => $model,
            'bidang' => $bidang,
            'klasifikasi' => $klasifikasi,
            'item_name' => $item_name,
            'arrayBidang' => $arrayBidang,
        ]);
    }

    public function actionUpdateNomor($id)
    {
        $model = $this->findModel($id);

        $bidang = ArrayHelper::map(Bidang::find()
        ->all() , 'id', 'bidang');

        $klasifikasi = ArrayHelper::map(Klasifikasi::find()->All(),
        function($model) {
              return  $model->id;
          }, function($model) {
              return  $model->klasifikasi . ' : ' .
                      $model->Keterangan;
          });

        if ($this->request->isPost && $model->load($this->request->post())) { 

            //$model->tanggalSurat = \Yii::$app->formatter->asDate($model->tanggalSurat, "Y-m-d");
            if ($model->validate()) {
                $model->save(false);
                return $this->redirect(['index']);
            } else {
                $data = $model->getErrors();
                \Yii::$app->session->setFlash('warning', '<strong>Nomor surat sudah ada!!!</strong>');// its dislplays error msg on your form
            }

            // $model->save(false);
            // return $this->redirect(['view-nomor', 'id' => $model->id]);
        } 

        return $this->render('_form-nomor', [
            'model' => $model,
            'bidang' => $bidang,
            'klasifikasi' => $klasifikasi,
        ]);
    }

    public function actionUpdateVerifikasi($id)
    {
        $model = $this->findModel($id);
        $model->statusKirim = 2;
        $model->save(false);
        return $this->redirect(['view-nomor', 'id' => $model->id]);
       
    }


    public function actionUpdateTerima($id)
    {
        $modelSurat = $this->findModel($id);

        $model = new Media;

        $idUser  = \Yii::$app->user->getId();

        $request = \Yii::$app->request;

        if ($model->load($request->post())) { 

            $date = date('Y-m-d H:i:s');
            
            $image = UploadedFile::getInstance($model, 'file');
            if ($image !== null) {
                $image->saveAs('dok/keluar/' . $image->baseName . '.' . $image->extension);

                // $model->namaDokumen = $image->baseName . $date . '.' . $image->extension;
                $model->file = $image->baseName .'.'. $image->extension;
                $model->surat_id = $id;
                $model->jenisSurat = 3;
                $model->type   = $image->extension;
                $model->uploadAt = $date;
                $model->uploadBy = $idUser;
                $model->save(false);
            }

            $tanggalKirim = date('Y-m-d');
            $namaTerima = $model->namaFile;

            $modelSurat->tanggalTerimaKirim = $tanggalKirim;
            $modelSurat->namaTerimaKirim = $namaTerima;
            $modelSurat->statusKirim = 3;
            $modelSurat->save(false);
            return $this->redirect(['view-nomor', 'id' => $modelSurat->id]);
        } 

        return $this->renderAjax('_form-terima', [
            'model' => $model,
            
        ]);
    }


    /**
     * Deletes an existing SuratKeluar model.
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

    /**
     * Finds the SuratKeluar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SuratKeluar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuratKeluar::findOne(['id' => $id])) !== null) {
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

    public function actionDaftarFile($id){

        $model = Media::find()->where(['surat_id' => $id])->andWhere(['jenisSurat'=>'1'])->all();

        return $this->renderAjax('daftar-file', [
            'model' => $model,
        ]);

    }

    public function actionDaftarFileVerified($id){

        $model = Media::find()->where(['surat_id' => $id])->andWhere(['jenisSurat'=>'2'])->all();

        $modelCheck = $this->findModel($id);
     

        return $this->renderAjax('daftar-file-verified', [
            'model' => $model,
            'modelCheck' => $modelCheck,
        ]);

    }

    public function actionUploadFile($id){

        $model = new Media;

        $request = \Yii::$app->request;

        $idUser  = \Yii::$app->user->getId();

        if ($model->load($request->post())) {

            $date = date('Y-m-d H:i:s');
            
            $image = UploadedFile::getInstance($model, 'file');
            if ($image !== null) {
                $image->saveAs('dok/keluar/' . $image->baseName . '.' . $image->extension);

                // $model->namaDokumen = $image->baseName . $date . '.' . $image->extension;
                $model->file = $image->baseName .'.'. $image->extension;
                $model->surat_id = $id;
                $model->jenisSurat = 1;
                $model->type   = $image->extension;
                $model->uploadAt = $date;
                $model->uploadBy = $idUser;
                $model->save(false);

                if  ($model->save(false)){
                    \Yii::$app->session->addFlash('success', 'Berhasil mengupload file.');
                    return $this->redirect(['index']);
                }
          }
        } else {

        return $this->renderAjax('upload-file', [
            'model' => $model
        ]);
        }
    }

    public function actionUploadFileVerified($id){

        $model = new Media;

        $request = \Yii::$app->request;

        $idUser  = \Yii::$app->user->getId();

        if ($model->load($request->post())) {

            $date = date('Y-m-d H:i:s');
            
            $image = UploadedFile::getInstance($model, 'file');
            if ($image !== null) {
                $image->saveAs('dok/keluar/' . $image->baseName . '.' . $image->extension);

                // $model->namaDokumen = $image->baseName . $date . '.' . $image->extension;
                $model->file = $image->baseName .'.'. $image->extension;
                $model->surat_id = $id;
                $model->jenisSurat = 2;
                $model->type   = $image->extension;
                $model->uploadAt = $date;
                $model->uploadBy = $idUser;
                $model->save(false);

                if  ($model->save(false)){
                    \Yii::$app->session->addFlash('success', 'Berhasil mengupload file.');
                    return $this->redirect(['view-nomor', 'id' => $model->surat_id]);
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

        $model = Media::find()->where(['id' => $idDok])
                      ->one();
    
        $filePath = '/dok/keluar/';
        $completePath = \Yii::getAlias('@frontend/web'.$filePath.'/'.$model->file);

        return \Yii::$app->response->sendFile($completePath, $model->file, ['inline'=>true]);
    }

    public function actionViewBukti($idDok) 
    {

        $model = Media::find()->where(['surat_id' => $idDok])->andWhere(['jenisSurat'=>'3'])
                      ->one();
    
        $filePath = '/dok/keluar';
        $completePath = \Yii::getAlias('@frontend/web'.$filePath.'/'.$model->file);

        return \Yii::$app->response->sendFile($completePath, $model->file, ['inline'=>true]);
    }

    
    public function actionDeleteFile($id)
    {
        $data = Media::findOne($id);
        unlink(\Yii::$app->basePath . '/web/dok/keluar/' . $data->file);
        $this->findModelMedia($id)->delete();

        \Yii::$app->session->addFlash('warning', 'Berhasil menghapus file.', null, true);
        return $this->redirect(['surat-keluar/index']);
    }

    public function actionDeleteFileVerified($id)
    {
        $data = Media::findOne($id);
        unlink(\Yii::$app->basePath . '/web/dok/keluar/' . $data->file);
        $this->findModelMedia($id)->delete();

        \Yii::$app->session->addFlash('warning', 'Berhasil menghapus file.', null, true);
        return $this->redirect(['view-nomor', 'id' => $data->surat_id]);
    }

    public function actionCetakSurat() {

        $modelSurat = \common\models\SuratKeluar::find()->orderBy(['tanggalSurat'=>SORT_DESC])->all();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-surat', [
                'modelSurat' => $modelSurat,
                ]),
            'options' => [
                'target' => '_blank',
                'title' => 'Cetak Rekapitulasi Surat Keluar',
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
