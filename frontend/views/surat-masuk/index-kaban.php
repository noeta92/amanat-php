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

            // 'id',
            [
                //'attribute' => 'statusSurat',
                'label' => 'Status',
                'format' => "raw",
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
                'contentOptions' => ['class' => 'font-weight-bold']
                
            ],
            [
                'attribute' => 'asalTujuan',
                'label' => 'Asal',
            ],
            'tanggalSurat',

            [
                'attribute' => 'kodeKlasifikasi',
                'value' => function ($model){
                    return $model->klasifikasi->klasifikasi.':'.$model->klasifikasi->Keterangan;
                }
            ],
            [
                'attribute'=>'perihal',
                //'contentOptions' => ['class' => "text-truncate", 'style'=> "word-wrap:break-word"],
            ],

            [
                'attribute' => 'tanggalTerimaKirim',
                'label' => 'Tanggal Diteruskan',
            ],

            [
           
                //'attribute'=>'kodeSurat',
                'format' => 'raw',
                'label' => 'Diteruskan ke:',
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
                'attribute' => 'isiDisposisi',
                'label'=>'Disposisi',
                'format' => 'raw',
                'value' => function ($model) {
                    $isi = $model->isiDisposisi;
                    
                    if ($isi == NULL) {
                        return 'Belum diisi Sekretaris';
                    } else {
                        return  Html::a('<span class="fas fa-eye"></span> Baca', ['surat-masuk/view-disposisi','id'=> $model->id],['class' => 'btn btn-md btn-primary']); 
                    }
                },
                'contentOptions' => ['style' =>'word-wrap:break-word;white-space:pre-line;width:300px;height:100px'],
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


