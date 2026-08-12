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
/** @var common\models\SuratMasuk $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Disposisi';
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuk', 'url' => ['index']];
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
        $('.modalButtonKaban').click(function (){
        $('#modalKaban').modal('show')
            .find('#modalContentKaban')
            .load($(this).attr('value'));
        });
    });
");

$this->registerJs("
    $(function(){
        $('.modalButtonUpload').click(function (){
        $('#modalUpload').modal('show')
            .find('#modalContentUpload')
            .load($(this).attr('value'));
        });
    });
");

?>

<div class="surat-masuk-form">
    <div class="card">
        
            <div class = "row">
                <div class="col-md-6">
                    <div class="card-body">
              
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'status',
                            'label'=>'Sifat',
                            'format' => 'raw',
                            'value' => function ($model) {

                                $status = $model->statusSurat;
                                
                                if ($status == 0) {
                                    return "-";    
                                } elseif ($status == 1) {
                                    return "<strong><span class = 'badge badge-primary'>Biasa</span></strong>";
                                    
                                } elseif ($status == 2) {
                                    return "<strong><span class = 'badge badge-warning'>Penting</span></strong>";
                                } else {
                                    
                                    return "<strong><span class = 'badge badge-danger'>Segera</span></strong>";
                                }
                            
                            }
                        ],
                        'noSurat',
                        [
                            'attribute' => 'asalTujuan',
                            'label' => 'Asal'
                        ],

                        'tanggalSurat',
                        [
                            'attribute' => 'tanggalTerimaKirim',
                            'label' => 'Tanggal Diteruskan'
                        ],

                        [
                            //'attribute'=>'kodeSurat',
                            'format' => 'raw',
                            'label' => 'Diteruskan ke:',
                            'options' => [
                                'style'=>'max-width:150px; min-height:100px; overflow: auto; word-wrap: break-word;'
                            ],
                            //'filter'=> $bidang,
                            'value' => function ($model){

                                
                                $modelBidang = $model->getMasukBidang()->all();
            
                                if ($modelBidang != NULL) {
                                    foreach ($modelBidang as $valueBidang) {
                                    $isiTujuan [] = $valueBidang->bidang->bidang.' '.(isset($valueBidang->namaTerimaKirim) ? '[Penerima: '.$valueBidang->namaTerimaKirim.']' : '<span class = "badge badge-danger"><i class = "fas fa-paper-plane"></i></span>');
                                    }
                                    return implode('<br>', $isiTujuan);
                                } else{
                                    return '<i> Isi Disposisi </i>';
                                }
                            }
                        ],
                        
                        [
                            'attribute' => 'kodeKlasifikasi',
                            'value' => function ($model){
                                return $model->klasifikasi->klasifikasi.' ('.$model->klasifikasi->Keterangan.')';
                            }
                        ],
                        'perihal',
                        'uraianSurat:ntext',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{foto}',
                            'format' => 'raw',
                            'label' => 'Berkas Surat',
                            'value' => function ($model) {
                                    $media = $model->medias;
                                    
                                    $buttonUnggah = Html::button('<span class="fas fa-upload"></span> Unggah', ['value'=>Url::to(['surat-masuk/upload-file','id'=> $model['id']]),'class' => 'modalButtonUpload btn btn-md btn-primary']);
                                    $buttonTambah = Html::button('Tambah', ['value'=>Url::to(['surat-masuk/upload-file','id'=> $model['id']]), 'class'=>'modalButtonUpload btn btn-link']);
                                    $buttonLihat = Html::button('<span class="fas fa-image"></span> Lihat', ['value'=>Url::to(['surat-masuk/daftar-file','id'=> $model['id']]),'class' => 'modalButtonView btn btn-md btn-outline-primary']);
            
                                    if($media != NULL){
                                        return $buttonLihat.$buttonTambah;
                                    }  else {
                                      
                                        return  '<span class="badge badge-info">Belum diunggah</span>'.' '.$buttonUnggah;
                                    }
                            }
                        ],
                        
                    ],
                ]) ?>
                
            </div>
            </div>
           
            <div class="col-md-6 ">
            <div class="card-header">
            <h5><span class="fas fa-comments"></span> Disposisi </span></h5>
            </div>
            <div class="card-body">
               
                <div class='callout callout-default'>
                 <span class="fas fa-comment"></span> <strong> Sekretaris :  </strong> <br> <?= $model->isiDisposisi?>
                 
                <?php
                $buttonUbah = Html::a('<span class="fas fa-edit"></span> ubah', ['surat-masuk/update-disposisi-ubah','id'=> $model->id],['class' => 'btn btn-md btn-link']);

                echo Helper::checkRoute('surat-masuk/update-disposisi') ? $buttonUbah : '';
                ?>
                <br><br>
                <span class="fas fa-user"></span> <strong> Kepala Bappedalitbang : </strong> <p> <?= $model->disposisiKaban?> </p>

                <?php
                $buttonKaban = Html::button('<span class="fas fa-edit"></span> Tulis', ['value'=>Url::to(['surat-masuk/update-disposisi-kaban','id'=> $model->id]), 'class'=>'modalButtonKaban btn btn-outline-primary']);      
                echo Helper::checkRoute('surat-masuk/update-disposisi-kaban') ? $buttonKaban : '';
            
                
                ?>
                </div>

                <p> <strong> Tindak Lanjut Bidang: </strong></span> </p>

                <?php
                if ($item_name == 'Kabid') {
                    $modelBidang = $model->getMasukBidang()->andWhere(['kodeBidang' => $kode_bidang])->one();

                    if ($modelBidang == NULL) {
                        echo '<div class="callout callout-danger">';
                        echo '<h5>Error! Tujuan belum dipilih</h5>';

                    } else {
                        $isi = $modelBidang->jawabanDisposisi;

                        $buttonIsi = Html::button('<span class="fas fa-plus"></span> Isi', ['value'=>Url::to(['surat-masuk/update-tindaklanjut','id'=> $modelBidang['id']]), 'class'=>'modalButton btn btn-outline-primary']);
                        $buttonTindak = Html::button('<span class="fas fa-edit"></span>Ubah', ['value'=>Url::to(['surat-masuk/update-tindaklanjut','id'=> $modelBidang['id']]), 'class'=>'modalButton btn btn-xs btn-outline-primary']);
                        
                        if ($modelBidang->jawabanDisposisi !=NULL) {
                            echo '<div class="callout callout-success">';
                            echo $isi.' '.$buttonTindak;
                            echo '</div>';

                        } else {
                            echo '<div class="callout callout-success">';
                            echo '<h5>Belum ditindaklanjuti</h5>'.$buttonIsi;
                            echo '</div>';
                        } 
                    }

                } else {
                    $modelBidang = $model->getMasukBidang()->all();
                    if ($modelBidang !=NULL) {
                        foreach ($modelBidang as $value) :
                            echo '<div class="callout callout-info">';
                            echo '<strong>'.$value->bidang->bidang.'</strong> : ';
                            echo isset($value->jawabanDisposisi) ? $value->jawabanDisposisi : '[Belum Diisi]';
                            echo '<br>';
                            echo '</div>';
                        endforeach;
                    } else {
                        echo '<div class="callout callout-default">';
                        echo '<strong>Bidang Belum Dipilih!</strong> Ubah disposisi';
                        echo '</div>';

                    } 
                    
                }
                // if ($model->jawabanDisposisi !=NULL) {
                //     $buttonTindak = Html::button('<span class="fas fa-edit"></span>Ubah', ['value'=>Url::to(['surat-masuk/update-tindaklanjut','id'=> $model['id']]), 'class'=>'modalButton btn btn-xs btn-outline-primary']);
                    
         
                //     echo Helper::checkRoute('surat-masuk/update-tindaklanjut') ? $buttonTindak : '';
                // } else {
                //     $buttonIsi = Html::button('<span class="fas fa-plus"></span> Isi', ['value'=>Url::to(['surat-masuk/update-tindaklanjut','id'=> $model['id']]), 'class'=>'modalButton btn btn-outline-primary']);
                //     echo Helper::checkRoute('surat-masuk/update-tindaklanjut') ? $buttonIsi : '<h5>Belum ditindaklanjuti</h5>';
                // }
                 ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
            Modal::begin([
                'title'=>'<h4>Isi Tindak Lanjut</h4>',
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
                'title'=>'<h4>Disposisi Kaban</h4>',
                'id'=>'modalKaban',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContentKaban'></div>";
            Modal::end();

            Modal::begin([
                'title'=>'<h4>Unggah Berkas</h4>',
                'id'=>'modalUpload',
                'size'=>'modal-lg',
            ]);
            echo "<div id='modalContentUpload'></div>";
            Modal::end();

?>
