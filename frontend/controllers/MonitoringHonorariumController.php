<?php

namespace frontend\controllers;

use common\models\MonitoringHonorarium;
use common\models\search\MonitoringHonorariumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Pegawai;
use common\models\SuratKeluar;

/**
 * MonitoringHonorariumController implements the CRUD actions for MonitoringHonorarium model.
 */
class MonitoringHonorariumController extends Controller
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
     * Lists all MonitoringHonorarium models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $bidang = ArrayHelper::map(\common\models\User::find()->where(['NOT', ['id' => [1,29, 30]]])->All(),
        function($model) {
            return  $model->id;
        }, function($model) {
            return  $model->username;
        });

        $searchModel = new MonitoringHonorariumSearch();
        $dataProvider = $searchModel->searchRelasi($this->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['idHonor'=>SORT_DESC]];
        
        return $this->render('index', [
            'bidang' => $bidang,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MonitoringHonorarium model.
     * @param int $idHonor Id Honor
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idHonor)
    {
        return $this->render('view', [
            'model' => $this->findModel($idHonor),
        ]);
    }

    /**
     * Creates a new MonitoringHonorarium model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MonitoringHonorarium();

        $pegawai = ArrayHelper::map(Pegawai::find()->All(),
        function($model) {
              return  $model->id;
          }, function($model) {
              return  $model->namaLengkap;
          });

        $surat = ArrayHelper::map(SuratKeluar::find()->Where(['not', ['noSurat'=> NULL]])->orderBy(['id'=> SORT_DESC])->All(),
        function($model) {
            return  $model->id;
        }, function($model) {
            return  $model->noSurat.' : '.$model->perihal;
        });

        $userId =  \Yii::$app->user->getId();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()))  {

                $model->jenisSurat = 0;
                $model->statusVerifikasi = 0;
                $model->verifikasiBy = 0;
                $model->createdOn = date('Y-m-d H:i:s'); 
                $model->createdBy = $userId;

                $post_data = \Yii::$app->request->post('MonitoringHonorarium');

                $tanggal = $post_data['tanggal'];
                $tanggal = strtotime($tanggal);
                $bulan = date("n", $tanggal);
                $bulan_char = date("F", $tanggal);
                $tahun = date("Y", $tanggal);

                $model->bulan = $bulan;
                $model->tahun = $tahun;
            
                $array_pegawai = $post_data['idPegawai'];
                $dataPegawai = Pegawai::find()->andwhere(['id' =>  $array_pegawai])->one();
                $eselon = $dataPegawai->eselon;

                $data_honorarium = MonitoringHonorarium::find()->where(['idPegawai' => $array_pegawai])->andWhere(['bulan'=>$bulan])->andWhere(['tahun'=> $tahun])->count();
                
                if ($eselon == 2 ) {
                    if ($data_honorarium < 2) {
                        $model->save(false); 
                        \Yii::$app->session->addFlash('success', 'Berhasil tambah data.');
                        return $this->redirect(['index']);
                    } else {
                        \Yii::$app->session->addFlash('danger', '<strong>'.$dataPegawai->namaLengkap.'</strong> untuk <strong> bulan '.$bulan.' tahun '.$tahun.'</strong> sudah terpenuhi');
                    }
                } elseif ($eselon == 3 ) {
                    if ($data_honorarium < 4) {
                        $model->save(false); 
                        \Yii::$app->session->addFlash('success', 'Berhasil tambah data.');
                    return $this->redirect(['index']);
                    } else {
                        \Yii::$app->session->addFlash('danger', '<strong>'.$dataPegawai->namaLengkap.'</strong> untuk <strong> bulan '.$bulan.' tahun '.$tahun.'</strong> sudah terpenuhi');
                    }
                } elseif ($eselon == 4) {
                    if ($data_honorarium < 5) {
                        $model->save(false); 
                        \Yii::$app->session->addFlash('success', 'Berhasil tambah data.');
                        return $this->redirect(['index']);
                    } else {
                        \Yii::$app->session->addFlash('danger', '<strong>'.$dataPegawai->namaLengkap.'</strong> untuk <strong> bulan '.$bulan.' '.$tahun.'</strong> sudah terpenuhi');
                    }
                } else {
                    $model->save(false); 
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'pegawai' => $pegawai,
            'surat' => $surat,
        ]);
    }

    /**
     * Updates an existing MonitoringHonorarium model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idHonor Id Honor
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idHonor)
    {
        $model = $this->findModel($idHonor);

        $pegawai = ArrayHelper::map(Pegawai::find()->andWhere(['id' => $model->idPegawai])->All(),
        function($model) {
              return  $model->id;
          }, function($model) {
              return  $model->namaLengkap;
          });

        $surat = ArrayHelper::map(SuratKeluar::find()->Where(['not', ['noSurat'=> NULL]])->orderBy(['id'=> SORT_DESC])->All(),
        function($model) {
            return  $model->id;
        }, function($model) {
            return  $model->noSurat.' : '.$model->perihal;
        });

        $userId =  \Yii::$app->user->getId();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()))  {

                //$model->jenisSurat = 0;
                $model->statusVerifikasi = 0;
                $model->verifikasiBy = 0;
                $model->createdOn = date('Y-m-d H:i:s'); 
                $model->createdBy = $userId;

                $post_data = \Yii::$app->request->post('MonitoringHonorarium');

                $tanggal = $post_data['tanggal'];
                $tanggal = strtotime($tanggal);
                $bulan = date("n", $tanggal);
                $bulan_char = date("F", $tanggal);
                $tahun = date("Y", $tanggal);

                $model->bulan = $bulan;
                $model->tahun = $tahun;
            
                $array_pegawai = $post_data['idPegawai'];
                $dataPegawai = Pegawai::find()->andwhere(['id' =>  $array_pegawai])->one();
                $eselon = $dataPegawai->eselon;

                $data_honorarium = MonitoringHonorarium::find()->where(['idPegawai' => $array_pegawai])->andWhere(['bulan'=>$bulan])->andWhere(['tahun'=> $tahun])->count();
                
                if ($eselon == 2 ) {
                    if ($data_honorarium < 2) {
                        $model->save(false); 
                        \Yii::$app->session->addFlash('success', 'Berhasil tambah data.');
                        return $this->redirect(['index']);
                    } else {
                        \Yii::$app->session->addFlash('danger', '<strong>'.$dataPegawai->namaLengkap.'</strong> untuk <strong> bulan '.$bulan.' tahun '.$tahun.'</strong> sudah terpenuhi');
                    }
                } elseif ($eselon == 3 ) {
                    if ($data_honorarium < 4) {
                        $model->save(false); 
                        \Yii::$app->session->addFlash('success', 'Berhasil tambah data.');
                    return $this->redirect(['index']);
                    } else {
                        \Yii::$app->session->addFlash('danger', '<strong>'.$dataPegawai->namaLengkap.'</strong> untuk <strong> bulan '.$bulan.' tahun '.$tahun.'</strong> sudah terpenuhi');
                    }
                } elseif ($eselon == 4) {
                    if ($data_honorarium < 5) {
                        $model->save(false); 
                        \Yii::$app->session->addFlash('success', 'Berhasil tambah data.');
                        return $this->redirect(['index']);
                    } else {
                        \Yii::$app->session->addFlash('danger', '<strong>'.$dataPegawai->namaLengkap.'</strong> untuk <strong> bulan '.$bulan.' '.$tahun.'</strong> sudah terpenuhi');
                    }
                } else {
                    $model->save(false); 
                    \Yii::$app->session->addFlash('success', 'Berhasil tambah data.');
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'pegawai' => $pegawai,
            'surat' => $surat,
        ]);
    }

    /**
     * Deletes an existing MonitoringHonorarium model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idHonor Id Honor
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idHonor)
    {
        $this->findModel($idHonor)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MonitoringHonorarium model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idHonor Id Honor
     * @return MonitoringHonorarium the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idHonor)
    {
        if (($model = MonitoringHonorarium::findOne(['idHonor' => $idHonor])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVerifikasi($idHonor, $status=0)
    {
        $model = $this->findModel($idHonor);

        // $roles = \common\models\AuthAssignment::find()->where(['user_id' => \Yii::$app->user->getId()])->one();
        // $item_name = $roles->item_name;
        $userId = \Yii::$app->user->getId();

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->verifikasiBy = $userId;
            $model->save(false);
            return $this->redirect(['index']);
        } 

        return $this->renderAjax('_form-verifikasi', [
            'model' => $model,
        ]);
    }
}
