<?php

use common\models\MonitoringHonorarium;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap5\Modal;
use mdm\admin\components\Helper;
/** @var yii\web\View $this */
/** @var common\models\search\MonitoringHonorariumSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Monitoring Honorarium';
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
<div class="monitoring-honorarium-index">
    <div class = "card">
        <div class = "card-header">

        <p>
        <?= Helper::checkRoute('monitoring-honorarium/create') ? Html::a('Tambah Honorarium', ['create'], ['class' => 'btn btn-success']) : ''; ?>
        </p>
        </div>

        <div class = "card-body table-responsive">

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
                //'jenisSurat',
                
                'tanggal',
                'tujuan',
                'tempat',
                [
                    //'attribute'=>'noSurat',
                    'headerOptions' => ['style' => 'color:#047bfb'],
                    'format' => 'raw',
                    'label' => 'Dasar Surat',
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
                        
                        //return $model->suratKeluar->noSurat.' '.$buttonLengkap;
                    }
                ],
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
                [
                    'class' => ActionColumn::className(),
                    'template' => '{edit}{delete}{verifikasi}',
                    'headerOptions' => ['style' => 'color:#047bfb'],
                    'header' => 'Aksi',
                    'buttons' => [
                        'edit' => function($url, $model, $key) {     // render your custom button
                            $userId =  \Yii::$app->user->getId();
                            if (Helper::checkRoute('monitoring-honorarium/update') && $model->createdBy == $userId) {
                                if ($model->statusVerifikasi != 1) {
                                return Html::a('<i class="fas fa-edit"></i>', ['update', 'idHonor'=>$model->idHonor], ['class' => 'btn btn-link', 'data-pjax' => 0]);
                            }
                        }
                        },
                        'delete' => function ($url, $model, $key) {
                            $userId =  \Yii::$app->user->getId();
                            if (Helper::checkRoute('monitoring-honorarium/delete') && $model->createdBy == $userId) {
                                if ($model->statusVerifikasi != 1) {
        
                                    $buttonHapus = Html::a('<i class="fas fa-trash"></i>', ['delete', 'idHonor'=>$model->idHonor], ['class' => 'btn btn-link', 
                                        'data-confirm' => Yii::t('yii', 'Yakin hapus data ini?'),
                                        'data-method' => 'post', 'data-pjax' => '0']); 
        
                                    return $buttonHapus;
        
                                }
                            }
                        } ,
                        'verifikasi' => function($url, $model, $key) { 
                            $buttonVerifikasi = 
                            Html::button('<span class="fas fa-check-circle"></span> Verifikasi', ['value'=>Url::to(['monitoring-honorarium/verifikasi','idHonor'=> $model['idHonor']]), 'class'=>'modalButton btn btn-md btn-primary']);
                            $buttonUbah = 
                            Html::button('<span class=""></span> Ubah', ['value'=>Url::to(['monitoring-honorarium/verifikasi','idHonor'=> $model['idHonor']]), 'class'=>'modalButton btn btn-md btn-outline-primary']);
                            if (Helper::checkRoute('monitoring-honorarium/verifikasi')) {
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
                    'filter' => $bidang,
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->pengguna->username;
                    }
                ],
                // [
                //     'class' => ActionColumn::className(),
                //     'urlCreator' => function ($action, MonitoringHonorarium $model, $key, $index, $column) {
                //         return Url::toRoute([$action, 'idHonor' => $model->idHonor]);
                //     }
                // ],
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
