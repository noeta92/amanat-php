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
use Yii;
use yii\helpers\FileHelper;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;

/**
 * SuratMasukController implements the CRUD actions for SuratMasuk model.
 */
class SuratMasukController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->user->loginRequired();
            return false;
        }
        if (!Yii::$app->user->can('/surat-masuk/' . $action->id)
            && !Yii::$app->user->can('/surat-masuk/*')
            && !Yii::$app->user->can('/*')) {
            throw new ForbiddenHttpException('Anda tidak memiliki akses ke surat masuk.');
        }
        return parent::beforeAction($action);
    }

    private function isDepartmentScoped()
    {
        $user = Yii::$app->user;
        return !$user->can('admin') && !$user->can('Kaban') && !$user->can('Super Admin');
    }

    private function departmentId()
    {
        return Yii::$app->user->identity->bagian_id;
    }

    private function assertLetterAccess($model)
    {
        if ($this->isDepartmentScoped()
            && (!$this->departmentId() || !$model->getMasukBidang()
                ->andWhere(['kodeBidang' => $this->departmentId()])->exists())) {
            throw new ForbiddenHttpException('Surat ini tidak ditugaskan ke bidang Anda.');
        }
    }

    private function loadLetterFields($model)
    {
        $data = $this->request->post($model->formName(), []);
        $model->setAttributes(array_intersect_key($data, array_flip([
            'noSurat', 'asalTujuan', 'kodeKlasifikasi', 'perihal',
            'tanggalSurat', 'tanggalTerimaKirim', 'uraianSurat',
        ])));
    }

    private function saveDisposition($model, $selection, $requireDepartment)
    {
        $data = $this->request->post($model->formName(), []);
        $model->setAttributes(array_intersect_key($data, array_flip(['statusSurat', 'isiDisposisi'])));
        $data = $this->request->post($selection->formName(), []);
        $ids = $data['kodeBidang'] ?? [];
        if (is_array($ids)) {
            $ids = array_values(array_filter($ids, static function ($id) {
                return $id !== '';
            }));
        }
        if (!is_array($ids) || ($requireDepartment && !$ids)) {
            $selection->addError('kodeBidang', 'Pilih setidaknya satu bidang.');
            return false;
        }
        foreach ($ids as $id) {
            if (!is_scalar($id) || !ctype_digit((string) $id) || (int) $id <= 0) {
                $selection->addError('kodeBidang', 'Pilihan bidang tidak valid.');
                return false;
            }
        }
        $ids = array_values(array_unique(array_map('intval', $ids)));
        if (count($ids) !== (int) Bidang::find()->where(['id' => $ids])->count()) {
            $selection->addError('kodeBidang', 'Pilihan bidang tidak valid.');
            return false;
        }
        if (!$model->validate(['statusSurat', 'isiDisposisi'])) {
            return false;
        }

        return Yii::$app->db->transaction(function () use ($model, $ids, $selection) {
            // Serialize assignment changes for this letter, including submissions with no changed fields.
            Yii::$app->db->createCommand()->update('surat_masuk', ['id' => $model->id], ['id' => $model->id])->execute();
            if (SuratMasukBidang::find()->where(['noSurat' => $model->id, 'kodeBidang' => $ids])->exists()) {
                $selection->addError('kodeBidang', 'Bidang tersebut sudah ditugaskan.');
                return false;
            }
            if (!$model->save(false, ['statusSurat', 'isiDisposisi'])) {
                throw new ServerErrorHttpException('Gagal menyimpan disposisi.');
            }
            foreach ($ids as $id) {
                $assignment = new SuratMasukBidang();
                $assignment->statusSurat = 0;
                $assignment->noSurat = $model->id;
                $assignment->kodeBidang = $id;
                if (!$assignment->save()) {
                    throw new ServerErrorHttpException('Gagal menyimpan tujuan disposisi.');
                }
            }
            return true;
        });
    }

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
                        'delete-masuk-bidang' => ['POST'],
                        'delete-file' => ['POST'],
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

        $item_name = $this->isDepartmentScoped() ? 'Kabid' : (Yii::$app->user->can('Kaban') ? 'Kaban' : 'admin');
        $kode_bidang = $this->departmentId();
        $searchModel = new SuratMasukSearch();
        
        if ($this->isDepartmentScoped()) {

            $dataProvider = $searchModel->searchBidang($this->request->queryParams);
            $dataProvider->sort->attributes['id'] = [
                'asc' => ['surat_masuk_bidang.id' => SORT_ASC],
                'desc' => ['surat_masuk_bidang.id' => SORT_DESC],
            ];
            $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];
            $dataProvider->query->andWhere($kode_bidang
                ? ['surat_masuk_bidang.kodeBidang' => $kode_bidang]
                : '0=1');
            
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
        $item_name = $this->isDepartmentScoped() ? 'Kabid' : (Yii::$app->user->can('Kaban') ? 'Kaban' : 'admin');
        $kode_bidang = $this->departmentId();

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
            $this->loadLetterFields($model);
            $model->timeCreated = time();
            $model->statusSurat = 0;
            if ($model->save()) {
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
        if ($this->request->isPost) {
            $this->loadLetterFields($model);
            if ($model->save()) {
                return $this->redirect(['index']);
            }
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

        if ($this->request->isPost && $this->saveDisposition($model, $model2, true)) {
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

        if ($this->request->isPost && $this->saveDisposition($model, $model2, false)) {
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

        if ($this->request->isPost) {
            $data = $this->request->post($model->formName(), []);
            $model->disposisiKaban = $data['disposisiKaban'] ?? null;
            if ($model->validate(['disposisiKaban']) && $model->save(false, ['disposisiKaban'])) {
                return $this->redirect(['view-disposisi', 'id' => $id]);
            }
        }

        return $this->renderAjax('_form-kaban', [
            'model' => $model,
        ]);
    }

    public function actionUpdateTindaklanjut($id)
    {
        $model = $this->findModelBidang($id);

        if ($this->request->isPost) {
            $data = $this->request->post($model->formName(), []);
            $model->jawabanDisposisi = $data['jawabanDisposisi'] ?? null;
            $model->statusSurat = 2;
            if ($model->validate(['jawabanDisposisi']) && $model->save(false, ['statusSurat', 'jawabanDisposisi'])) {
                return $this->redirect(['view-disposisi', 'id' => $model->noSurat]);
            }
        } 

        return $this->renderAjax('_form-tindaklanjut', [
            'model' => $model,
        ]);
    }


    public function actionUpdateTerima($id)
    {
        $model = $this->findModelBidang($id);

        if ($this->request->isPost) {
            $data = $this->request->post($model->formName(), []);
            $model->namaTerimaKirim = $data['namaTerimaKirim'] ?? null;
            $model->statusSurat = 1;
            if ($model->validate(['namaTerimaKirim']) && $model->save(false, ['statusSurat', 'namaTerimaKirim'])) {
                return $this->redirect(['view-disposisi', 'id' => $model->noSurat]);
            }
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
            $this->assertLetterAccess($model);
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelMedia($id)
    {
        if (($model = Media::findOne(['id' => $id, 'jenisSurat' => 0])) !== null) {
            $this->findModel($model->surat_id);
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelBidang($id)
    {
        if (($model = SuratMasukBidang::findOne(['id' => $id])) !== null) {
            $this->findModel($model->noSurat);
            if ($this->isDepartmentScoped() && (string) $model->kodeBidang !== (string) $this->departmentId()) {
                throw new ForbiddenHttpException('Disposisi ini bukan untuk bidang Anda.');
            }
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionDaftarFile($id){

        $this->findModel($id);
        $model = Media::find()->where(['surat_id' => $id, 'jenisSurat' => 0])->all();

        return $this->renderAjax('daftar-file', [
            'model' => $model,
        ]);

    }

    public function actionUploadFile($id){
        $this->findModel($id);
        $model = new Media;
        if ($this->request->isPost) {
            $data = $this->request->post($model->formName(), []);
            $model->namaFile = $data['namaFile'] ?? null;
            $upload = UploadedFile::getInstance($model, 'file');
            $model->file = $upload;
            if ($model->validate(['namaFile', 'file'])) {
                $directory = Yii::getAlias('@common/uploads/surat-masuk');
                FileHelper::createDirectory($directory, 0700, true);
                $filename = Yii::$app->security->generateRandomString(40) . '.' . strtolower($upload->extension);
                $path = $directory . DIRECTORY_SEPARATOR . $filename;
                if (!$upload->saveAs($path)) {
                    throw new ServerErrorHttpException('Gagal menyimpan berkas.');
                }
                $model->file = $filename;
                $model->surat_id = $id;
                $model->jenisSurat = 0;
                $model->type = strtolower($upload->extension);
                $model->uploadAt = date('Y-m-d H:i:s');
                $model->uploadBy = Yii::$app->user->id;
                try {
                    if (!$model->save(false)) {
                        throw new ServerErrorHttpException('Gagal menyimpan data berkas.');
                    }
                } catch (\Throwable $e) {
                    if (!unlink($path)) {
                        Yii::error('Gagal menghapus berkas setelah penyimpanan data gagal: ' . $path);
                    }
                    throw $e;
                }
                Yii::$app->session->addFlash('success', 'Berhasil mengupload file.');
                return $this->redirect(['view-disposisi', 'id' => $id]);
            }
        }
        return $this->renderAjax('upload-file', [
            'model' => $model
        ]);
    }

    public function actionViewFile($idDok) 
    {
        $model = $this->findModelMedia($idDok);
        $completePath = $this->attachmentPath($model);
        if (!is_file($completePath)) {
            throw new NotFoundHttpException('Berkas tidak ditemukan.');
        }
        Yii::$app->response->headers->set('X-Content-Type-Options', 'nosniff');
        Yii::$app->response->headers->set('Content-Security-Policy', 'sandbox');
        return \Yii::$app->response->sendFile($completePath, $model->file, ['inline'=>true]);
    }
    
    public function actionDeleteFile($id, $idSurat)
    {
        $data = $this->findModelMedia($id);
        if ((string) $data->surat_id !== (string) $idSurat) {
            throw new NotFoundHttpException('Berkas tidak ditemukan.');
        }
        $path = $this->attachmentPath($data);
        Yii::$app->db->transaction(function () use ($data, $path) {
            if ($data->delete() === false) {
                throw new ServerErrorHttpException('Gagal menghapus data berkas.');
            }
            if (!Media::find()->where(['jenisSurat' => 0, 'file' => $data->file])->exists()
                && is_file($path) && !unlink($path)) {
                throw new ServerErrorHttpException('Gagal menghapus berkas.');
            }
        });

        \Yii::$app->session->addFlash('warning', 'Berhasil menghapus file.', null, true);
        //return $this->redirect(['surat-masuk/index']);
        return $this->redirect(['view-disposisi', 'id' => $idSurat]);
    }

    private function attachmentPath($model)
    {
        if (!$model->file || basename($model->file) !== $model->file) {
            throw new NotFoundHttpException('Nama berkas tidak valid.');
        }
        return Yii::getAlias('@common/uploads/surat-masuk') . DIRECTORY_SEPARATOR . $model->file;
    }

    public function actionCetakSurat() {

        $query = SuratMasuk::find();
        if ($this->isDepartmentScoped()) {
            $query->andWhere(['id' => SuratMasukBidang::find()
                ->select('noSurat')->where(['kodeBidang' => $this->departmentId() ?: -1])]);
        }
        $modelSurat = $query->orderBy(['id'=>SORT_DESC])->all();

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
