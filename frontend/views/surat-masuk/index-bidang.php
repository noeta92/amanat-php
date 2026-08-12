<?php

use common\models\SuratMasuk;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap5\Modal;
use mdm\admin\components\Helper;

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
?>
<div class="surat-masuk-index">
    <div class ="card">
        <div class ="card-header">
        <?php $buttonTambah = Html::a('<span class="fas fa-plus"></span> Tambah Surat Masuk', ['create'], ['class' => 'btn btn-success']);
            echo Helper::checkRoute('surat-masuk/create') ? $buttonTambah : '';
        ?>
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
                //'attribute' => 'statusSurat',
                'label' => 'Status',
                'headerOptions' => ['style' => 'color:#0275d8'],
                'format' => "raw",
                'value' => function ($model) {

                    $status = $model->noSurat0->statusSurat;
                
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
                //'attribute' => 'isiDisposisi',
                'label'=>'Disposisi',
                'headerOptions' => ['style' => 'color:#0275d8'],
                'format' => 'raw',
                'value' => function ($model) {
                    $isi = $model->noSurat0->isiDisposisi;

                    $buttonTerima = 
                    Html::button('<span class="fas fa-check-circle"></span> Terima', ['value'=>Url::to(['surat-masuk/update-terima','id'=> $model['id']]), 'class'=>'modalButtonTerima btn btn-md btn-primary']); 
                    $buttonBaca = Html::a('<span class="fas fa-eye"></span> Baca', ['surat-masuk/view-disposisi','id'=> $model->noSurat],['class' => 'btn btn-md btn-primary']);
                    $buttonCheck = isset($model->namaTerimaKirim) ? $buttonBaca : $buttonTerima;
                    //$tindakLanjut = isset($model->jawabanDisposisi) ? '' : '<span class="badge badge-secondary">Belum ditindaklanjuti</span>';
                    if ($isi == NULL) {
                        return 'Belum diisi';
                    } else {
                        return Helper::checkRoute('surat-masuk/update-disposisi') ? $buttonBaca : $buttonCheck;//else
                       
                    }
                },
                'contentOptions' => ['style' =>'word-wrap:break-word;white-space:pre-line;width:300px;height:100px'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{foto}',
                'header' => 'Berkas',
                'headerOptions' => ['style' => 'color:#0275d8'],
                'buttons' => [
                    'foto' => function($url, $model, $key) {  
                        $media = $model->medias;
                        $buttonTambah = Html::button('Tambah', ['value'=>Url::to(['surat-masuk/upload-file','id'=> $model['noSurat']]), 'class'=>'modalButton btn btn-link']);
                        $buttonLihat = Html::button('<span class="fas fa-image"></span> Lihat', ['value'=>Url::to(['surat-masuk/daftar-file','id'=> $model['noSurat']]),'class' => 'modalButtonView btn btn-md btn-outline-primary']);

                        if($media != NULL){
                            return Helper::checkRoute('surat-masuk/upload-file') ? $buttonLihat.$buttonTambah : $buttonLihat;
                        }  else {
                            
                            $buttonUnggah = Html::button('<span class="fas fa-upload"></span> Unggah', ['value'=>Url::to(['surat-masuk/upload-file','id'=> $model['noSurat']]),'class' => 'modalButton btn btn-md btn-primary']);
                            return Helper::checkRoute('surat-masuk/upload-file') ? $buttonUnggah : '<span class="badge badge-info">Belum diunggah</span>';
                        }
                    }
                ]
            ],
            [
                'attribute'=>'namaTerimaKirim',
                'format' => 'raw',
                'label' => 'Penerima',
                'value' => function ($model){

                    $terima = isset($model->namaTerimaKirim) ? $model->namaTerimaKirim : '<span class = "badge badge-danger"><i class = "fas fa-times"></i> Belum diterima</span>';
                   
                    return $terima;
                    
                }
            ],
            [
                'attribute'=>'noSurat',
                'headerOptions' => ['style' => 'color:#0275d8'],
                'label' => 'No. Surat',
                'format'=> 'raw',
                'value' => function ($model) {
                    return '<strong>'.$model->noSurat0->noSurat.'</strong>';
                }
            ],

            [
                'attribute'=>'asalTujuan',
                'headerOptions' => ['style' => 'color:#0275d8'],
                'label' => 'Asal',
                'value' => 'noSurat0.asalTujuan'
            ],

            [
                'attribute'=>'tanggalSurat',
                'headerOptions' => ['style' => 'color:#0275d8'],
                'label' => 'Tanggal Surat',
                'value' => 'noSurat0.tanggalSurat'
            ],
            [
                'attribute'=>'perihal',
                'headerOptions' => ['style' => 'color:#0275d8'],
                'contentOptions' => ['class' => "text-truncate", 'style'=> "word-wrap:break-word"],
                'value' => 'noSurat0.perihal'
            ],
            [
               
                'headerOptions' => ['style' => 'color:#0275d8'],
                'label' => 'Klasifikasi',
                'value' => function ($model){
                    return $model->noSurat0->klasifikasi->klasifikasi.':'.$model->noSurat0->klasifikasi->Keterangan;
                }
            ],
            [
                'attribute'=>'noSurat0.tanggalTerimaKirim',
                'headerOptions' => ['style' => 'color:#0275d8'],
                'label' => 'Tanggal Diteruskan',
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


