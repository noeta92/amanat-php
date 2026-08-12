<?php

use common\models\MonitoringLembur;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap5\Modal;
use mdm\admin\components\Helper;
/** @var yii\web\View $this */
/** @var common\models\search\MonitoringLemburSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Monitoring Lembur';
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

?>
<div class="monitoring-lembur-index">
    <div class = "card">
        <h1><?php // Html::encode($this->title) ?></h1>

        <div class ="card-header">
        <p>
  
            <?= Helper::checkRoute('monitoring-lembur/create') ? Html::a('Tambah Lembur', ['create'], ['class' => 'btn btn-success']) : ''; ?>
        </p>
        </div>

        <div class ="card-body table-responsive">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute'=>'namaLengkap',
                    'format' => 'raw',
                    'label' => 'Pegawai',
                    'headerOptions' => ['style' => 'color:#047bfb'],
                    //'filter'=> $bidang,
                    'value' => function ($model){
                        return $model->pegawai->namaLengkap;
                    }
                ],
                
                [
                    'attribute'=>'tanggal_awal',
                    'format' => 'raw',
                    'label' => 'Tanggal',
                    
                ],
                
                [
                    'attribute'=>'tanggal_akhir',
                    'format' => 'raw',
                    'label' => 'Tanggal Akhir',
                    'value' => function ($model){
                        
                        if (ISSET($model->tanggal_akhir)) {
                            return $model->tanggal_akhir;
                        }
                        else {
                            return '-';
                        }
                    }
                ],

                [
                    'attribute'=>'jenisPerjalanan',
                    'format' => 'raw',
                    'label' => 'Jenis Kegiatan',
                    'filter'=> ['0'=> 'Dinas Biasa', '1'=> 'Dalam Kota', '2'=> 'Lembur'],
                    'value' => function ($model){
                        
                        if ($model->jenisPerjalanan == 0) {
                            return '<strong><span class = "badge badge-info">Dinas Biasa</strong>';
                        }
                        elseif ($model->jenisPerjalanan == 1) {
                            return '<strong><span class = "badge badge-primary">Dalam Kota</strong>';
                        }
                        else {
                            return '<strong><span class = "badge badge-success">Lembur</strong>';
                        }
                    }
                ],
                [
                    'attribute'=>'perihal',
                    'label' => 'Tujuan',
                    
                ],
                'tempat',
                [
                    //'attribute'=>'noSurat',
                    'format' => 'raw',
                    'label' => 'Surat',
                    'headerOptions' => ['style' => 'color:#047bfb'],
                    //'filter'=> $bidang,
                    'value' => function ($model){

                        $buttonMasuk = Html::a('Selengkapnya', ['surat-masuk/view-disposisi','id'=> $model['idSurat']], ['target'=>'_blank']);
                        $buttonKeluar = Html::a('Selengkapnya', ['surat-keluar/view-nomor','id'=> $model['idSurat']], ['target'=>'_blank']);
                        
                        
                        if($model->jenisSurat == 1) {
                            return $model->suratMasuk->noSurat.' '.$buttonMasuk;
                        }
                        else {
                            return $model->suratKeluar->noSurat.' '.$buttonKeluar;
                        }
                    }
                ],
                //'statusVerifikasi',
                // [
                //     'attribute' => 'statusVerifikasi',
                //     'label' => 'status verifikasi',
                //     'format' => 'raw',
                //     'value' => function ($model) {
                //         $buttonVerifikasi = 
                //         Html::button('<span class="fas fa-check-circle"></span> Verifikasi', ['value'=>Url::to(['monitoring-lembur/verifikasi','idLembur'=> $model['idLembur']]), 'class'=>'modalButton btn btn-md btn-primary']);

                //         $buttonUbah = 
                //         Html::button('<span class=""></span> Ubah', ['value'=>Url::to(['monitoring-lembur/verifikasi','idLembur'=> $model['idLembur']]), 'class'=>'modalButton btn btn-xs btn-outline-primary']);

                //         if ($model->statusVerifikasi == 0) {
                //             return '<span class = "badge badge-warning">Diajukan</span> <br>'.$buttonVerifikasi;
                //         } else if ($model->statusVerifikasi == 1) {
                //             return '<span class = "badge badge-success"><i class = "fas fa-check-circle"></i> Diverifikasi </span>'.$buttonUbah;
                //         } else {
                //             return '<span class = "badge badge-info">Dibatalkan </span>'.$buttonUbah;
                //         }
                //     }
                // ],

                [
                    'attribute' => 'statusVerifikasi',
                    'format' => 'raw',
                    'label' => 'Status',
                    'filter'=> ['0'=> 'Diajukan', '1'=> 'Diverifikasi', '2'=> 'Dibatalkan'],
                    'value' => function ($model) {

                        if ($model->statusVerifikasi == 0) {
                            return '<span class = "badge badge-warning"><strong>Diajukan</strong></span>';
                        } else if ($model->statusVerifikasi == 1) {
                            return '<span class = "badge badge-success"><i class = "fas fa-check-circle"></i> Diverifikasi </span>';
                        } else {
                            return '<span class = "badge badge-info">Dibatalkan </span>';
                        }
                    }
                ],

                //'verifikasiBy',
                //'createdOn',
                // [
                //     'class' => ActionColumn::className(),
                //     'urlCreator' => function ($action, MonitoringLembur $model, $key, $index, $column) {
                //         return Url::toRoute([$action, 'idLembur' => $model->idLembur]);
                //     }
                // ],
                [
                    'class' => ActionColumn::className(),
                    'template' => '{edit}{delete}{verifikasi}',
                    'headerOptions' => ['style' => 'color:#047bfb'],
                    'header' => 'Aksi',
                    'buttons' => [
                        'edit' => function($url, $model, $key) {     // render your custom button
                            $userId =  \Yii::$app->user->getId();
                            if (Helper::checkRoute('monitoring-lembur/update') && $model->createdBy == $userId) {
                                if ($model->statusVerifikasi != 1) {
                                return Html::a('<i class="fas fa-edit"></i>', ['update', 'idLembur'=>$model->idLembur], ['class' => 'btn btn-link', 'data-pjax' => 0]);
                            }
                        }
                        },
                        'delete' => function ($url, $model, $key) {
                            $userId =  \Yii::$app->user->getId();
                            if (Helper::checkRoute('monitoring-lembur/delete') && $model->createdBy == $userId) {
                                if ($model->statusVerifikasi != 1) {
        
                                    $buttonHapus = Html::a('<i class="fas fa-trash"></i>', ['delete', 'idLembur'=>$model->idLembur], ['class' => 'btn btn-link', 
                                        'data-confirm' => Yii::t('yii', 'Yakin hapus data ini?'),
                                        'data-method' => 'post', 'data-pjax' => '0']); 
        
                                    return $buttonHapus;
        
                                }
                            }
                        } ,
                        'verifikasi' => function($url, $model, $key) { 
                            $buttonVerifikasi = 
                            Html::button('<span class="fas fa-check-circle"></span> Verifikasi', ['value'=>Url::to(['monitoring-lembur/verifikasi','idLembur'=> $model['idLembur']]), 'class'=>'modalButton btn btn-md btn-primary']);
                            $buttonUbah = 
                            Html::button('<span class=""></span> Ubah', ['value'=>Url::to(['monitoring-lembur/verifikasi','idLembur'=> $model['idLembur']]), 'class'=>'modalButton btn btn-md btn-outline-primary']);
                            if (Helper::checkRoute('monitoring-lembur/verifikasi')) {
                                if ($model->statusVerifikasi == 0) {
                                    return  $buttonVerifikasi;
                                } else if ($model->statusVerifikasi == 1) {
                                    return $buttonUbah;
                                } else {
                                    return $buttonUbah;
                                }
                            }
                        }
                    ]  
                ],
                [
                    'attribute' => 'createdBy',
                    'label' => 'Diajukan',
                    'format' => 'raw',
                    'filter' => $bidang,
                    'value' => function ($model) {

                        return $model->pengguna->username;
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

        <?php
            Modal::begin([
                'title'=>'Verifikasi',
                'id'=>'modal',
                'size'=>'modal-md',
            ]);
            echo "<div id='modalContent'></div>";
            Modal::end();
        ?>

        </div>
    </div>
</div>
