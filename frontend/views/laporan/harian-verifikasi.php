<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use mdm\admin\components\Helper;
/* @var $this yii\web\View */

$this->title = 'Rekap Pengaduan Harian';
$this->params['breadcrumbs'][] = ['label' => 'Laporan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="box box-warning">
    <div class="box-body">
        <table id="" class="table table-bordered table-hover">
 <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
                'id',
                'noTiket',

                // 'pelaporInternal_id',
                // 'jenisIdentitas_id',
                // 'noIdentitas',
                // 'namaPelapor:ntext',
                // 'emailPelapor:ntext',
                // 'handphone',
                'perihal',
                //'kodeBagian',
                [
                    'attribute'=>'kodeBagian',
                    'value' => 'kodeBagian0.bagian',
                    'label' => 'Bagian',
                ],
                // 'instansiPelapor:ntext',
                // 'uraianLapor:ntext',
                
                //'tanggalLapor',
                [   
                    'attribute' => 'timeLapor',
                    'label' => 'Waktu Laporan',
                    'value' => 'timeLapor',
                    'format' => ['datetime', 'php:d-m-Y / H:i:s'],
                
                ],

                // 'timeLapor:datetime',
                // 'uraianPenyelesaian',
                //'tanggalJawaban',
                // 'timeJawaban:datetime',
                // 'userJawab_id',
                //'tanggalPenyelesaian',
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
                //'tanggalverifikasi',
                //'timeVerifikasi:datetime',
                [   
                    'attribute' => 'timeVerifikasi',
                    'label' => 'Waktu Verifikasi',
                    'value' => 'timeVerifikasi',
                    'format' => ['datetime', 'php:d-m-Y / H:i:s'],
                
                ],
                // 'userVerifikasi',
                [  
                    'attribute' => 'statusAduan',
                    'label' => 'Status Verifikasi',
                    'value' => function($model) {
                        $status = [
                            0 => 'Belum',
                            1 => 'Belum',
                            2 => 'Sudah',
                            3 => 'Revisi',
                        ];
                        return $status[$model->statusAduan];
                    },
                ],
                [
                  'class' => 'yii\grid\ActionColumn',
                  'header' => 'Detail',
                  'headerOptions' => ['style' => 'color:#337ab7'],
                  'template' => '{update} '.(Helper::checkRoute('laporan/lihat-verifikasi') ? '{view}' : ''),
                  'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="far fa-eye"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },

                    'update' => function ($url, $model) {
                        return Html::a('<span class="far fa-eye"></span>', $url, [
                                    'title' => Yii::t('app', 'Detail'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="far fa-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-delete'),
                        ]);
                    }

                  ],
                  'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='index.php?r=laporan/lihat-verifikasi&id='.$model->id;
                        return $url;
                    }

                    if ($action === 'update') {
                        $url ='index.php?r=laporan/edit-verifikasi&id='.$model->id;
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url ='index.php?r=client-login/lead-delete&id='.$model->id;
                        return $url;
                    }

                  }


                ],
                //  [
                //     'format' => 'raw',
                //     'label' => 'Aksi',
                //     'value' => function($model) {
                //         $url = Url::to(['laporan/update',
                //                      'id'=>$id
                //                 ]);

                         
                //         $btn = '<a href="#" title="Ubah" class="ubah_laporan" value="'.$url.'"><i class="fa fa-pencil"></i></a>';


                //         // $btn = $btn1." ".$btn2;
                //         // return $btn;

                //     }
                // ],
            ],
        ]);
        ?>
    	</table>
    </div>
</div>
