<?php

use common\models\SuratKeluar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap5\Modal;
use mdm\admin\components\Helper;
use johnitvn\ajaxcrud\CrudAsset;

CrudAsset::register($this);

/** @var yii\web\View $this */
/** @var common\models\search\SuratKeluarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Surat Keluar';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    $(function(){
        $('.modalButton').click(function (){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        });
    });
");

$this->registerJs("
    $(function(){
        $('.modalButtonView').click(function (){
        $('#modalView').modal('show')
            .find('#modalContentView')
            .load($(this).attr('value'));
        });
    });
");

$this->registerJs("
    $(function(){
        $('.modalButtonTerima').click(function (){
        $('#modalTerima').modal('show')
            .find('#modalContentTerima')
            .load($(this).attr('value'));
        });
    });
");

$pdfHeader = [
    'L' => [
      'content' => 'Aplikasi Manajemen Administrasi (Amanat)',
    ],
    'C' => [
      'content' => 'Rekapitulasi Surat Keluar',
      'font-size' => 10,
      'font-style' => 'B',
      'font-family' => 'arial',
      'color' => '#333333'
    ],
    'R' => [
      'content' => 'Bappedalitbang Deli Serdang',
    ],
    'line' => true,
  ];
  
  $pdfFooter = [
    'L' => [
      'content' => 'Dicetak : '.date('d-m-Y h:i:s'),
    ],
    'C' => false,
    'line' => true,
  ];
  
?>
<div class="surat-keluar-index">
    <div class ="card">
        <!-- <div class ="card-header"> -->
        <?php $buttonTambah = Html::a('<span class="fas fa-plus"></span> Tambah Surat Keluar', ['create'], ['class' => 'btn btn-success']);
            $buttonCetak = Html::a('<span class="fas fa-print"></span> Cetak', ['cetak-surat'], ['class' => 'btn float-right btn-outline-primary', 'target'=> '_blank']);
            //echo Helper::checkRoute('surat-keluar/create') ? $buttonTambah : '';
            //echo $buttonCetak;
        ?>
        <!-- </div> -->
    <div class ="card-body table-responsive">
          
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'type' => 'secondary', 
            'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Surat Keluar',
            //'before'=>'<em>* Resize kolom table  serte kolom kanan dan kiri.</em>',
            
        ],
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Tambah Surat Keluar', ['create'],
                ['title'=> 'Tambah Surat Keluar','class'=>'btn btn-default']).
                Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i>', [''],
                ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                '{toggleData}'.
                '{export}'
            ],
        ],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'Unduh Excel'],
            GridView::PDF => [
                'label' => 'Unduh PDF',
                'filename' => 'Rekapitulasi Surat Keluar',
                'config' => [
                    'methods' => [
                      'SetHeader' => [
                        ['odd' => $pdfHeader, 'even' => $pdfHeader]
                      ],
                      'SetFooter' => [
                        ['odd' => $pdfFooter, 'even' => $pdfFooter]
                      ],
                    ],
                ]  
            ],
        ], 
        'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            
            'tanggalSurat',

            'noSurat',
            [
                'attribute' => 'asalTujuan',
                'label' => 'Tujuan / Nama',
                
            ],

            [
                'attribute'=>'perihal',
                'contentOptions' => ['style' =>'word-wrap:break-word;white-space:pre-line;width:300px;height:100px'],
            ],

            // [
            //     'attribute'=>'uraianSurat',
            //     'contentOptions' => ['style' =>'word-wrap:break-word;white-space:pre-line;width:300px;height:100px'],
            // ],

            [
                
                'format' => 'raw',
                'hiddenFromExport'=>true,
                'value' => function ($model) {
                    $isi = $model->noSurat;

                    $buttonTerima = 
                    Html::button('<span class="fas fa-check-circle"></span> Terima', ['value'=>Url::to(['surat-keluar/update-terima','id'=> $model['id']]), 'class'=>'modalButtonTerima btn btn-md btn-primary']); 
                    $buttonBaca = Html::a('<span class="fas fa-eye"></span> Baca', ['surat-keluar/view-nomor','id'=> $model->id],['class' => 'btn btn-md btn-primary']);
                    $buttonIsi = Html::a('<span class="fa fa-envelope"></span> Tambah No. Surat', ['update-nomor', 'id'=>$model->id], ['class' => 'btn btn-md btn-warning']);
                    $buttonCheck = isset($model->namaTerimaKirim) ? $buttonBaca : $buttonTerima;

                    $tindakLanjut = ($model->statusKirim==0 || $model->statusKirim == 1) ? '<span class="badge badge-warning">Belum diverifikasi</span>' : '';

                    if ($isi == NULL) {
                        return Helper::checkRoute('surat-keluar/update-nomor') ? $buttonIsi : 'No. Surat Belum diisi';
                    } else {
                        
                        return Helper::checkRoute('surat-keluar/view-nomor') ? $buttonBaca.$tindakLanjut : $buttonBaca.$tindakLanjut;//else
                       
                    }
                },
                'contentOptions' => ['style' =>'word-wrap:break-word;white-space:pre-line;width:300px;height:100px'],
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'hiddenFromExport'=>true,
                'template' => '{foto}',
                'header' => 'Draft Surat',
                'headerOptions' => ['style' => 'color:#047bfb'],
                'buttons' => [
                    'foto' => function($url, $model, $key) {  
                        $media = $model->getMedias()->andWhere(['jenisSurat'=>'1'])->all();
                        $media_terverifikasi = $model->getMedias()->andWhere(['jenisSurat'=>'2'])->all();
                        $buttonTambah = Html::button('Tambah', ['value'=>Url::to(['surat-keluar/upload-file','id'=> $model['id']]), 'class'=>'modalButton btn btn-link']);
                        $buttonLihat = Html::button('<span class="fas fa-image"></span> Lihat', ['value'=>Url::to(['surat-keluar/daftar-file','id'=> $model['id']]),'class' => 'modalButtonView btn btn-md btn-outline-primary']);

                        if ($media_terverifikasi != NULL ) {
                            return "<span class='badge badge-primary'>Surat telah diunggah</span><br><i>Klik baca</i>";
                        } else {
                            if($media != NULL){
                                return Helper::checkRoute('surat-keluar/upload-file') ? $buttonLihat.$buttonTambah : $buttonLihat;
                            }  else {
                                
                                $buttonUnggah = Html::button('<span class="fas fa-upload"></span> Unggah', ['value'=>Url::to(['surat-keluar/upload-file','id'=> $model['id']]),'class' => 'modalButton btn btn-md btn-primary']);
                                return Helper::checkRoute('surat-keluar/upload-file') ? $buttonUnggah : '<span class="badge badge-info">Draft belum diunggah</span>';
                            }
                        }
                    }
                ]
            ],

            [
                'label' => 'Status',
                'format' => "raw",
                'hiddenFromExport'=>true,
                'headerOptions' => ['style' => 'color:#047bfb'],
                'value' => function ($model) {

                    $status = $model->statusSurat;
                    $sifat = ($status = 1) ? 'Sifat: Penting' : 'Sifat: Biasa';
                    $statusKirim = $model->statusKirim;

                    $media_terverifikasi = $model->getMedias()->andWhere(['jenisSurat'=>'2'])->all();

                    if ($media_terverifikasi != NULL ){
                        return "<strong><span class = 'badge badge-warning'>Belum dikirim </span></strong><br>".$sifat;
                    } else {
                        if ($statusKirim == 0 || $statusKirim == 1 ) {
                            return "<strong><span class = 'badge badge-danger'>Belum lengkap</span></strong><br>".$sifat;
                            
                        } elseif ($statusKirim == 2) {
                            return "<strong><span class = 'badge badge-warning'>Belum dikirim </span></strong><br>".$sifat;
                        } else {
                            return "<strong><span class = 'badge badge-success'>Terkirim</span></strong><br>".$sifat;  
                        }
                    }
                }
            ],

            [
                'attribute'=>'kodeBidang',
                'format' => 'raw',
                'label' => 'Bidang',
                'filter'=> $bidang,
                'value' => function ($model){
                    
                    return $model->bidang->bidang;
                }
            ],

            // [
            //     'attribute' => 'kodeKlasifikasi',
            //     'value' => function ($model){
            //         return $model->klasifikasi->klasifikasi.':'.$model->klasifikasi->Keterangan;
            //     }
            // ],

            
            // [
            //     'class' => ActionColumn::className(),
            //     'header' => 'Aksi',
            //     'urlCreator' => function ($action, SuratKeluar $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],

            [
                'label' => 'Monitoring',
                'format' => "raw",
                'hiddenFromExport'=>true,
                'headerOptions' => ['style' => 'color:#047bfb'],
                'value' => function ($model) {

                    
                    $monitoringPerjadin = $model->getPerjadins()->andWhere(['jenisSurat'=>'0'])->all();
                    $monitoringLembur = $model->getLemburs()->andWhere(['jenisSurat'=>'0'])->all();
                    $monitoringHonor = $model->getHonors()->andWhere(['jenisSurat'=>'0'])->all();

                    if ($monitoringPerjadin != NULL || $monitoringLembur != NULL || $monitoringHonor != NULL ){
                        return "<strong><span class = 'badge badge-success'> <i class='fas fa-check'> </i> </span></strong>";
                    } else {
                        return "- ";
                    }
                }
            ],
            
            [
                'class' => 'kartik\grid\ActionColumn',
                'hiddenFromExport'=>true,
                'template' => '{edit}{delete}',
                'header' => 'Aksi',
                'buttons' => [
                    'edit' => function($url, $model, $key) {     // render your custom button
                        $media_terverifikasi = $model->getMedias()->andWhere(['jenisSurat'=>'2'])->all();

                        if ($model->statusKirim !=2 ) {
                        return Html::a('<i class="fas fa-edit"></i>', ['surat-keluar/update', 'id'=>$model->id], ['class' => 'btn btn-link', 'data-pjax' => 0]);
                        }
                    },
                    'delete' => function ($url, $model, $key) {

                        $monitoringPerjadin = $model->getPerjadins()->andWhere(['jenisSurat'=>'0'])->all();
                        $monitoringLembur = $model->getLemburs()->andWhere(['jenisSurat'=>'0'])->all();
                        $monitoringHonor = $model->getHonors()->andWhere(['jenisSurat'=>'0'])->all();

                        if ($model->statusKirim != 2 ) {
                            if ($monitoringPerjadin != NULL || $monitoringLembur != NULL || $monitoringHonor != NULL){
                                return '';
                            } 
                            else {   
                            $buttonHapus = Html::a('<i class="fas fa-trash"></i>', ['delete', 'id'=>$model->id], ['class' => 'btn btn-link', 
                                'data-confirm' => Yii::t('yii', 'Yakin hapus surat masuk ini?'),
                                'data-method' => 'post', 'data-pjax' => '0']); 

                            return $buttonHapus;
                            }

                        }

                    } 
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    
    </table>

    <?php
            Modal::begin([
                'title'=>'<h4>Unggah Berkas</h4>',
                'id'=>'modal',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";
            Modal::end();

           
            Modal::begin([
                'title'=>'<h4>Daftar Surat</h4>',
                'id'=>'modalView',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContentView'></div>";
            Modal::end();

            Modal::begin([
                'title'=>'<h4>Diterima:</h4>',
                'id'=>'modalTerima',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContentTerima'></div>";
            Modal::end();
            
    ?>
        </div>
    </div>
</div>


