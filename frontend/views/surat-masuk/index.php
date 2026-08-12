<?php

use common\models\SuratMasuk;
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
/** @var common\models\search\SuratMasukSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Surat Masuk';
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
      'content' => 'Rekapitulasi Surat Masuk',
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
<div class="surat-masuk-index">
    <div class ="card">
        <!-- <div class ="card-header"> -->
        <?php $buttonTambah = Html::a('<span class="fas fa-plus"></span> Tambah Surat Masuk', ['create'], ['class' => 'btn btn-success']);
            $buttonCetak = Html::a('<span class="fas fa-print"></span> Cetak', ['cetak-surat'], ['class' => 'btn float-right btn-outline-primary', 'target'=> '_blank']);
            //echo Helper::checkRoute('surat-masuk/create') ? $buttonTambah : '';
           // echo $buttonCetak;
        ?>
        <!-- </div> -->
    <div class ="card-body table-responsive">
          
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Tambah Surat Masuk', ['create'],
                ['title'=> 'Tambah Surat Masuk','class'=>'btn btn-default']).
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
                'filename' => 'Rekapitulasi Surat Masuk',
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
        'panel' => [
            'type' => 'secondary', 
            'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Surat Masuk',
            //'before'=>'<em>* Resize kolom table  serte kolom kanan dan kiri.</em>',
            
        ],   
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            // 'id',
            [
                //'attribute' => 'statusSurat',
                'label' => 'Status',
                'format' => "raw",
                'headerOptions' => ['style' => 'color:#337ab7'],
                'value' => function ($model) {

                    $status = $model->statusSurat;
                    if ($status == 0) {
                        return "-";    
                    } elseif ($status == 1) {
                        return "<strong><span class = 'badge badge-primary'>Sifat: Biasa</span></strong>";
                        
                    } elseif ($status == 2) {
                        return "<strong><span class = 'badge badge-warning'>Sifat: Penting</span></strong>";
                    } else {
                        
                        return "<strong><span class = 'badge badge-danger'>Sifat: Segera</span></strong>";
                    }
                }
            ],
          
            [
                'attribute' => 'noSurat',
                'contentOptions' => ['class' => 'font-weight-bold', 'style'=> 'width:50px'],
                
            ],
            [
                'attribute' => 'asalTujuan',
                'label' => 'Asal',
            ],
            'tanggalSurat',

            [
                'attribute' => 'kodeKlasifikasi',
                'hiddenFromExport'=>true,
                'value' => function ($model){
                    return $model->klasifikasi->klasifikasi.':'.$model->klasifikasi->Keterangan;
                }
            ],
            [
                'attribute'=>'perihal',
                'headerOptions' => ['style'=> 'width:300px'],
                //'contentOptions' => ['class' => "text-truncate", 'style'=> "word-wrap:break-word"],
                'width' => '300px',
            ],

            [
                'attribute' => 'tanggalTerimaKirim',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'label' => 'Tanggal Diteruskan',
            ],

            [
           
                //'attribute'=>'kodeSurat',
                'format' => 'raw',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'label' => 'Diteruskan ke:',
                //'hiddenFromExport'=>true,
                //'filter'=> $bidang,
                'contentOptions' => ['class' => "text-truncate"],
                
                'value' => function ($model, $key, $value){

                    $totalBidang = $model->getMasukBidang()->count();

                    $modelBidang = $model->getMasukBidang()->all();

                    if ($modelBidang != NULL) {
                            foreach ($modelBidang as $valueBidang) {
                            //$terima [] = isset($valueBidang->namaTerimaKirim) ? 'Penerima:'.$valueBidang->namaTerimaKirim : 'Belum diterima';
                            //$terima [] = $valueBidang->namaTerimaKirim;
                            // $isiTujuan = $valueBidang->bidang->bidang.'<br><strong>'.'('.$terima.')</strong>';
                            //$isiTujuan [] = '-'.$valueBidang->bidang->bidang.' '.(isset($valueBidang->namaTerimaKirim) ? '<span class = "badge badge-success"><i class = "fas fa-check"></i></span>' : '<span class = "badge badge-danger"><i class = "fas fa-times"></i></span>');
                            if ($valueBidang->statusSurat == 0){
                                $isiTujuan [] = $valueBidang->bidang->bidang.' '.'<span class = "badge badge-danger"><i class = "fas fa-paper-plane"></i></span>';
                            } else if ($valueBidang->statusSurat == 1) {
                                $isiTujuan [] = $valueBidang->bidang->bidang.' '.'<span class = "badge badge-primary"><i class = "fas fa-envelope"></i></span>';
                            } else {
                                $isiTujuan [] = $valueBidang->bidang->bidang.' '.'<span class = "badge badge-success"><i class = "fas fa-envelope-open"></i></span>';
                            }
                            }
                            return implode('<br>', $isiTujuan);
                    } else{
                    
                        return '<i> Isi Disposisi </i>';
                    }
                }
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'hiddenFromExport' => true,
                'template' => '{foto}',
                'header' => 'Berkas',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'buttons' => [
                    'foto' => function($url, $model, $key) {  
                        $media = $model->medias;
                        $isi = $model->getMasukBidang()->all();

                        $buttonTambah = Html::button('Tambah', ['value'=>Url::to(['surat-masuk/upload-file','id'=> $model['id']]), 'class'=>'modalButton btn btn-link']);
                        $buttonLihat = Html::button('<span class="fas fa-image"></span> Lihat', ['value'=>Url::to(['surat-masuk/daftar-file','id'=> $model['id']]),'class' => 'modalButtonView btn btn-md btn-outline-primary']);
                        $buttonUnggah = Html::button('<span class="fas fa-upload"></span> Unggah', ['value'=>Url::to(['surat-masuk/upload-file','id'=> $model['id']]),'class' => 'modalButton btn btn-md btn-primary']);

                        if($media == NULL) {
                            return $buttonUnggah.'<span class="badge badge-warning"> Belum diunggah</span>';

                        } else {

                            return Helper::checkRoute('surat-masuk/upload-file') ? $buttonLihat.$buttonTambah : $buttonLihat;
                        }
                        
                    }   
                ],
                
            ],

            [
                'attribute' => 'isiDisposisi',
                'label'=>'Disposisi',
                'hiddenFromExport'=>true,
                'format' => 'raw',
                'value' => function ($model) {
                    //$isi = $model->isiDisposisi;
                    $isi = $model->getMasukBidang()->all();

                    
                    $buttonTerima = 
                    Html::button('<span class="fas fa-check-circle"></span> Terima', ['value'=>Url::to(['surat-masuk/update-terima','id'=> $model['id']]), 'class'=>'modalButtonTerima btn btn-md btn-primary']); 
                    $buttonBaca = Html::a('<span class="fas fa-eye"></span> Baca', ['surat-masuk/view-disposisi','id'=> $model->id],['class' => 'btn btn-md btn-primary']);
                    $buttonIsi = Html::a('<span class="fa fa-comments"></span> Isi disposisi', ['update-disposisi', 'id'=>$model->id], ['class' => 'btn btn-md btn-warning']);
                    $buttonCheck = isset($model->namaTerimaKirim) ? $buttonBaca : $buttonTerima;

                    //$tindakLanjut = isset($model->jawabanDisposisi) ? '' : '<span class="badge badge-secondary">Belum ditindaklanjuti</span>';
                    if ($isi == NULL) {
                        return Helper::checkRoute('surat-masuk/update-disposisi') ? $buttonIsi : 'Belum diisi';
                    } else {
                        
                        return Helper::checkRoute('surat-masuk/update-disposisi') ? $buttonBaca : $buttonCheck;//else
                       
                    }
                },
                'contentOptions' => ['style' =>'word-wrap:break-word;white-space:pre-line;width:300px;height:100px'],
            ],
         
            //'timeCreated:datetime',
            
            // [
            //     'class' => ActionColumn::className(),
            //     'header' => 'Aksi',
            //     'urlCreator' => function ($action, SuratMasuk $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],

            [
                'label' => 'Monitoring',
                'format' => "raw",
                'hiddenFromExport'=>true,
                'headerOptions' => ['style' => 'color:#047bfb'],
                'value' => function ($model) {

                    
                    $monitoringPerjadin = $model->getPerjadins()->andWhere(['jenisSurat'=>'1'])->all();
                    $monitoringLembur = $model->getLemburs()->andWhere(['jenisSurat'=>'1'])->all();
                    $monitoringHonor = $model->getHonors()->andWhere(['jenisSurat'=>'1'])->all();

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
                'headerOptions' => ['style' => 'color:#337ab7'],
                'header' => 'Aksi',
                'buttons' => [
                    'edit' => function($url, $model, $key) {     // render your custom button
                        return Html::a('<i class="fas fa-edit"></i>', ['surat-masuk/update', 'id'=>$model->id], ['class' => 'btn btn-link', 'data-pjax' => 0]);
                    },
                    'delete' => function ($url, $model, $key) {

                        $monitoringPerjadin = $model->getPerjadins()->andWhere(['jenisSurat'=>'1'])->all();
                        $monitoringLembur = $model->getLemburs()->andWhere(['jenisSurat'=>'1'])->all();
                        $monitoringHonor = $model->getHonors()->andWhere(['jenisSurat'=>'1'])->all();

                        //$isi = $model->isiDisposisi;
                        $isi = $model->getMasukBidang()->all();

                        if ($isi == NULL) {
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
    


    <?php
            Modal::begin([
                'title'=>'<h4>Unggah Berkas</h4>',
                'id'=>'modal',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";
            Modal::end();

           
            Modal::begin([
                'title'=>'<h4>Daftar Berkas</h4>',
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


