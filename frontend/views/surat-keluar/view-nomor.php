<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\bootstrap5\Modal;
use mdm\admin\components\Helper;

/** @var yii\web\View $this */
/** @var common\models\SuratKeluar $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Detail Surat Keluar';
$this->params['breadcrumbs'][] = ['label' => 'Surat Keluar', 'url' => ['index']];
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
        $('.modalButtonKirim').click(function (){
        $('#modalKirim').modal('show')
            .find('#modalContentKirim')
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

?>

<div class="surat-keluar-form">
    <div class="card">
        
            <div class = "row">
                <div class="col-md-6">
                    <div class="card-body">
              
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'tanggalSurat',
                        
                        [
                            'attribute' => 'noSurat',
                            'format' => 'raw',
                            'label' => 'No. Surat',
                            'value' => function ($model){

                                $buttonUbah = Html::a('<span class="fas fa-edit"></span> ubah', ['surat-keluar/update-nomor','id'=> $model->id],['class' => 'btn btn-md btn-link']); 
                                if ($model->statusKirim == 1) {
                                    return Helper::checkRoute('surat-keluar/update-nomor') ? $model->noSurat.$buttonUbah : $model->noSurat;
                                } else {
                                    return $model->noSurat;
                                }
                            }
                        ],

                        [
                            'attribute' => 'asalTujuan',
                            'label' => 'Tujuan'
                        ],
                            'perihal',
                            'uraianSurat:ntext',

                        [
                            'attribute'=>'kodeBidang',
                            'format' => 'raw',
                            'label' => 'Bidang Asal:',
                            'value' => function ($model){    
                                    return $model->bidang->bidang;
                            }
                         
                        ],
                        
                        [
                            'attribute' => 'kodeKlasifikasi',
                            'value' => function ($model){
                                return $model->klasifikasi->klasifikasi.' ('.$model->klasifikasi->Keterangan.')';
                            }
                        ],

                        [
                            'attribute'=>'tanggalTerimaKirim',
                            'format' => 'raw',
                            'label' => 'Tanggal Dikirim:',
                            'value' => function ($model){ 
                                    if ($model->tanggalTerimaKirim != NULL) {   
                                        return $model->tanggalTerimaKirim.'<br>Penerima: '.$model->namaTerimaKirim;
                                    } else {
                                        return "Belum Dikirim";
                                    }
                            }
                         
                        ],
                        
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{foto}',
                            'format' => 'raw',
                            'label' => 'Berkas Terverifikasi',
                            'value' => function ($model) {
                                $media = $model->getMedias()->andWhere(['jenisSurat' => '2'])->all();
                                    $buttonLihat = Html::button('<span class="fas fa-image"></span> Lihat', ['value'=>Url::to(['surat-keluar/daftar-file-verified','id'=> $model['id']]),'class' => 'modalButtonView btn btn-md btn-primary']);
                                    $buttonUnggah = Html::button('<span class="fas fa-upload"></span> Unggah', ['value'=>Url::to(['surat-keluar/upload-file-verified','id'=> $model['id']]),'class' => 'modalButton btn btn-md btn-outline-primary']);
                                    
                                    $checkUnggah = Helper::checkRoute('surat-keluar/update-verifikasi') ? $buttonUnggah : ''; 
                                    if($media != NULL){
                                        return $buttonLihat;
                                    }  else {
                                      
                                        return  '<i class="">Belum diunggah</i>'.' '.$checkUnggah ;
                                    }
                            }
                        ],
                    ],
                ]) ?>

            </div>
            </div>
           
            <div class="col-md-6 ">
            <div class="card-header">
                <h5><span class="fas fa-envelope"></span> Status Surat</h5>
            </div>
            <div class="card-body">
                
               
                <?php
                
                $buttonConfirm = Html::a('<span class="fas fa-check-circle"></span> Konfirmasi', ['update-verifikasi', 'id'=>$model->id], ['class' => 'btn btn-md btn-outline-success', 
                'data-confirm' => Yii::t('yii', 'Yakin verifikasi? Surat keluar tidak dapat diubah / dihapus'),
                'data-method' => 'post', 'data-pjax' => '0']);

                $buttonConfirmDisabled = Html::a('<span class="fas fa-check-circle"></span> Konfirmasi', ['update-verifikasi', 'id'=>$model->id], ['class' => 'btn btn-md btn-outline-success disabled']);
               
                $buttonCetakDisabled = Html::button('<span class="fas fa-print"></span> Cetak Tanda Terima ', ['value'=>Url::to(['surat-keluar/update-terima','id'=> $model['id']]), 'class'=>'btn btn-outline-primary disabled']);
                $buttonIsiDisabled = Html::button('<span class="fas fa-paper-plane"></span> Konfirmasi Kirim', ['value'=>Url::to(['surat-keluar/update-terima','id'=> $model['id']]), 'class'=>'modalButtonKirim btn btn-outline-primary disabled']);

                $buttonCetak = Html::button('<span class="fas fa-print"></span> Cetak Tanda Terima ', ['value'=>Url::to(['surat-keluar/update-terima','id'=> $model['id']]), 'class'=>'btn btn-outline-primary']);
                $buttonIsi= Html::button('<span class="fas fa-paper-plane"></span> Konfirmasi Kirim', ['value'=>Url::to(['surat-keluar/update-terima','id'=> $model['id']]), 'class'=>'modalButtonKirim btn btn-outline-primary']);

                ?>
                <?php if($model->statusKirim == 0 || $model->statusKirim == 1): ?>

                    <strong>Status verifikasi: </strong> 
                    <div class='callout callout-danger'>
                    Belum diverifikasi</div>
                    <?php 
                    $media = $model->getMedias()->andWhere(['jenisSurat'=>'2'])->all();

                    if ($media !=NULL ) 
                    { echo Helper::checkRoute('surat-keluar/update-verifikasi') ? $buttonConfirm : ''; 
                    } else { 
                        echo Helper::checkRoute('surat-keluar/update-verifikasi') ? $buttonConfirmDisabled.'<i>* Tidak dapat verifikasi, Berkas surat belum diunggah</i>' : ''; 
                    } ?>
                    <br>
                    <br>
                    
                    <strong>Status Kirim: </strong> 
                    <div class='callout callout-danger'>
                    Belum dikirim</div>
                    <?= Helper::checkRoute('surat-keluar/update-terima') ? $buttonIsiDisabled :'' ; ?>
                       
                <?php elseif ($model->statusKirim == 2) : ?>

                    <strong>Status verifikasi: </strong> 
                    <div class='callout callout-success'>
                    Terverifikasi</div>

                    <strong>Status Kirim: </strong> 
                    <div class='callout callout-danger'>
                    Belum dikirim</div>
                    <?= Helper::checkRoute('surat-keluar/update-terima') ? $buttonIsi : ''; ?>

                <?php elseif ($model->statusKirim == 3) :
                    $buttonBukti = Html::a('<span class="fa fa-download"></span> Bukti Kirim', ['view-bukti', 'idDok'=>$model['id']], ['class' => 'btn btn-sm btn-link', 'target'=> '_blank']); 
                    ?>

                    <strong>Status verifikasi: </strong> 
                    <div class='callout callout-success'>
                    Terverifikasi</div>

                    <strong>Status Kirim: </strong> 
                    <div class='callout callout-success'>
                    Terkirim</div>
                    <?= $buttonBukti?>  
                    
                <?php endif; ?>
               
                </div>
            </div>
        </div>
    </div>
</div>

<?php
            Modal::begin([
                'title'=>'<h4>Unggah Berkas</h4>',
                'id'=>'modal',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";
            Modal::end();

            Modal::begin([
                'title'=>'<h4>Isi Bukti Terima</h4>',
                'id'=>'modalKirim',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContentKirim'></div>";
            Modal::end();

            Modal::begin([
                'title'=>'<h4>Daftar Berkas Terverifikasi</h4>',
                'id'=>'modalView',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContentView'></div>";
            Modal::end();

?>
