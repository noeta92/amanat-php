<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use common\components\Helper;
/* @var $this yii\web\View */

$this->title = 'Rekap Pengaduan Harian';
$this->params['breadcrumbs'][] = ['label' => 'Laporan', 'url' => ['harian']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="box box-warning">
    <div class="box-body">
        <table id="" class="table table-bordered table-hover">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'id',
                'noTiket',
                [
                    'attribute'=>'kodeBagian',
                    'value' => 'kodeBagian0.bagian',
                    'label' => 'Bagian',
                ],
                [   
                    'attribute' => 'timeLapor',
                    'label' => 'Waktu Laporan',
                    'value' => 'timeLapor',
                    'format' => ['datetime', 'php:d-m-Y / H:i:s'],
                
                ],

                // 'pelaporInternal_id',
                // 'jenisIdentitas_id',
                // 'noIdentitas',
                // 'namaPelapor:ntext',
                // 'emailPelapor:ntext',
                // 'handphone',
                'perihal',
                
                // 'instansiPelapor:ntext',
                // [ 'attribute' => 'uraianLapor',
                //   'label' => 'Uraian',
                // ],   
                
                
                // 'timeLapor:datetime',
                //'uraianPenyelesaian',
                [   
                    'attribute' => 'tanggalPenyelesaian',
                    'label' => 'Tanggal Penyelesaian',
                    'value' => 'tanggalPenyelesaian',
                    'format' => ['date', 'php:d-m-Y'],
                
                ],
                [   
                    'attribute' => 'timeJawaban',
                    'label' => 'Waktu Jawaban',
                    'value' => 'timeJawaban',
                    'format' => ['datetime', 'php:d-m-Y / H:i:s'],
                
                ],
                //'timeJawaban:datetime',

                // 'userJawab_id',
                // 'tanggalPenyelesaian',
                // 'tanggalverifikasi',
                // 'timeVerifikasi:datetime',
                // 'userVerifikasi',
                [  
                    'attribute' => 'statusAduan',
                    'value' => function($model) {
                        $status = [
                            0 => 'Belum Dijawab',
                            1 => 'Sudah Dijawab / Belum Verifikasi',
                            2 => 'Sudah Diverifikasi',
                            3 => 'Revisi',
                        ];
                        return $status[$model->statusAduan];
                    },
                ],
                [
                  'class' => 'yii\grid\ActionColumn',
                  'header' => 'Detail',
                  'headerOptions' => ['style' => 'color:#337ab7'],
                  'template' => '{update}'.(Helper::checkRoute('laporan/lihat-verifikasi') ? ' {lihat-verifikasi}' : ''),
                  'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },
                            
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'Detail'),
                        ]);
                    },

                    'liihat-verifikasi' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-delete'),
                        ]);
                    }

                  ],
                  'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='index.php?r=client-login/lead-view&id='.$model->id;
                        return $url;
                    }   

                    if ($action === 'update') {
                        $url ='index.php?r=laporan/lihat-verifikasi&id='.$model->id;
                        return $url;
                    }
                    
                    if ($action === 'lihat-verifikasi') {
                        $url ='index.php?r=laporan/lihat-verifikasi&id='.$model->id;
                        return $url;
                  }
              }


                ],

            ],
        ]);
        ?>
        </table>
    </div>
</div>