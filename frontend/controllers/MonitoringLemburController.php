<?php

namespace frontend\controllers;

use common\models\MonitoringLembur;
use common\models\search\MonitoringLemburSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Pegawai;
use common\models\SuratKeluar;
use common\models\MonitoringPerjadinTanggal;
use common\models\MonitoringLemburTanggal;

/**
 * MonitoringLemburController implements the CRUD actions for MonitoringLembur model.
 */
class MonitoringLemburController extends Controller
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
     * Lists all MonitoringLembur models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userId =  \Yii::$app->user->getId();
        $roles = \common\models\AuthAssignment::find()->where(['user_id' => $userId])->one();
        $item_name = $roles->item_name;

        $bidang = ArrayHelper::map(\common\models\User::find()->where(['NOT', ['id' => [1,29, 30]]])->All(),
        function($model) {
            return  $model->id;
        }, function($model) {
            return  $model->username;
        });

        $searchModel = new MonitoringLemburSearch();
        $dataProvider = $searchModel->searchRelasi($this->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['idLembur'=>SORT_DESC]];

        // if ($item_name == 'Kabid') {
        //     $dataProvider->query->andWhere(['monitoring_lembur.createdBy' => $userId]);
        // } 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bidang' => $bidang,
        ]);
    }

    /**
     * Displays a single MonitoringLembur model.
     * @param int $idLembur Id Lembur
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idLembur)
    {
        return $this->render('view', [
            'model' => $this->findModel($idLembur),
        ]);
    }

    /**
     * Creates a new MonitoringLembur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MonitoringLembur();

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

                //$model->jenisSurat = 0;
                $model->statusVerifikasi = 0;
                $model->createdOn = date('Y-m-d H:i:s'); 
                $model->createdBy = $userId;

                $post_data = \Yii::$app->request->post('MonitoringLembur');

                $tanggal = $post_data['tanggal_awal'];
                $tanggal_akhir = $post_data['tanggal_akhir'];

                $array_pegawai = $post_data['idPegawai'];
                $nama_pegawai = Pegawai::find()->andwhere(['id' =>  $array_pegawai])->one();

                $data_lembur = MonitoringLemburTanggal::find()->where(['idPegawai'=>$array_pegawai])->andWhere(['tanggal' => $tanggal])->all();
                $data_perjadin = MonitoringPerjadinTanggal::find()->where(['idPegawai'=>$array_pegawai])->andWhere(['tanggal' => $tanggal])->all();

                if ($data_lembur == NULL && $data_perjadin == NULL) {

                    $model->save(false); 

                    if ($tanggal_akhir != NULL) {

                        $begin = strtotime($tanggal);
                        $end = strtotime($tanggal_akhir);

                        for ($currentDate = $begin; $currentDate <= $end; $currentDate += (86400)) {
                            $model2 = new MonitoringLemburTanggal();
                            $model2->idLembur = $model->idLembur;
                            $model2->idPegawai = $model->idPegawai;
                            $model2->tanggal = date('Y-m-d', $currentDate);
                            $model2->save(false); 
                        }
                    } else {

                        $model2 = new MonitoringLemburTanggal();
                        $model2->idLembur = $model->idLembur;
                        $model2->idPegawai = $model->idPegawai;
                        $model2->tanggal = $model->tanggal_awal;
                        $model2->save(false); 
                    }

                    \Yii::$app->session->addFlash('success', 'Berhasil tambah data.');
                    return $this->redirect(['index']);

                } elseif ($data_lembur != NULL && $data_perjadin == NULL) {
                    \Yii::$app->session->addFlash('danger', '<strong>'.$nama_pegawai->namaLengkap.'</strong> untuk tanggal <strong>'.$model->tanggal_awal.(ISSET($model->tanggal_akhir) ? ' - '.$model->tanggal_akhir : '').'</strong> sudah dipakai untuk <i> lembur </i>');

                } elseif ($data_lembur == NULL && $data_perjadin != NULL) {
                    \Yii::$app->session->addFlash('danger', '<strong>'.$nama_pegawai->namaLengkap.'</strong> untuk tanggal <strong>'.$model->tanggal_awal.(ISSET($model->tanggal_akhir) ? ' - '.$model->tanggal_akhir : '').'</strong> sudah dipakai untuk <i> perjalanan dinas </i>');

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
     * Updates an existing MonitoringLembur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idLembur Id Lembur
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idLembur)
    {
        $model = $this->findModel($idLembur);

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

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->statusVerifikasi = 0;
            $model->createdOn = date('Y-m-d H:i:s'); 

            $post_data = \Yii::$app->request->post('MonitoringLembur');

            $tanggal = $post_data['tanggal_awal'];
            $tanggal_akhir = $post_data['tanggal_akhir'];

            $pegawai = $post_data['idPegawai'];
            $nama_pegawai = Pegawai::find()->andwhere(['id' =>  $pegawai])->one();
            
            $data_perjadin = MonitoringPerjadinTanggal::find()->where(['idPegawai'=>$pegawai])->andWhere(['tanggal' => $tanggal])->all();
            $data_lembur = MonitoringLemburTanggal::find()->where(['idPegawai'=>$pegawai])->andWhere(['tanggal' => $tanggal])->all();
           
            if ($data_perjadin == NULL && $data_lembur == NULL) {

                $model->save(false); 

                $data_lama = MonitoringLemburTanggal::deleteAll('idLembur = :idLembur', [':idLembur' => $idLembur]);

                if ($tanggal_akhir != NULL) {

                    $begin = strtotime($tanggal);
                    $end = strtotime($tanggal_akhir);

                    for ($currentDate = $begin; $currentDate <= $end; $currentDate += (86400)) {
                        $model2 = new MonitoringLemburTanggal();
                        $model2->idLembur = $model->idLembur;
                        $model2->idPegawai = $model->idPegawai;
                        $model2->tanggal = date('Y-m-d', $currentDate);
                        $model2->save(false); 
                    }

                } else  {

                    $model2 = new MonitoringLemburTanggal();
                    $model2->idLembur = $model->idLembur;
                    $model2->idPegawai = $model->idPegawai;
                    $model2->tanggal = $model->tanggal_awal;
                    $model2->save(false); 

                }

                \Yii::$app->session->addFlash('success', 'Berhasil ubah data.');
                return $this->redirect(['index']);

            }
            elseif ($data_lembur != NULL && $data_perjadin == NULL) {
                \Yii::$app->session->addFlash('danger', '<strong>'.$nama_pegawai->namaLengkap.'</strong> untuk tanggal <strong>'.$model->tanggal_awal.(ISSET($model->tanggal_akhir) ? ' - '.$model->tanggal_akhir : '').'</strong> sudah dipakai untuk <i>lembur</i>');

                return $this->redirect(['index']);

            } elseif ($data_lembur == NULL && $data_perjadin != NULL) {
                \Yii::$app->session->addFlash('danger', '<strong>'.$nama_pegawai->namaLengkap.'</strong> untuk tanggal <strong>'.$model->tanggal_awal.(ISSET($model->tanggal_akhir) ? ' - '.$model->tanggal_akhir : '').'</strong> sudah dipakai untuk <i> perjalanan dinas </i>');

                return $this->redirect(['index']);
            } 
            
        }

        return $this->render('update', [
            'model' => $model,
            'pegawai' => $pegawai,
            'surat' => $surat,
        ]);
    }

    /**
     * Deletes an existing MonitoringLembur model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idLembur Id Lembur
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idLembur)
    {
        $this->findModel($idLembur)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MonitoringLembur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idLembur Id Lembur
     * @return MonitoringLembur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idLembur)
    {
        if (($model = MonitoringLembur::findOne(['idLembur' => $idLembur])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVerifikasi($idLembur, $status=0)
    {
        $model = $this->findModel($idLembur);

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
