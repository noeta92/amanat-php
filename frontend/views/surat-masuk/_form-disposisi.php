<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;
use yii\helpers\Url;
use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var common\models\SuratMasuk $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Disposisi';
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
  jQuery('#checkAll').change(function(){
    jQuery('.bidang').prop('checked',this.checked?'checked':'');}
  ); 
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

<div class="surat-masuk-form">
    <div class="card">
        
            <div class = "row">
                <div class="col-md-6">
                    <div class="card-body">
              
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'noSurat',
                        'tanggalSurat',
                        [
                            'attribute' => 'tanggalTerimaKirim',
                            'label' => 'Tanggal Diterima'
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
                                    $buttonLihat = Html::button('<span class="fas fa-image"></span> Lihat', ['value'=>Url::to(['surat-masuk/daftar-file','id'=> $model['id']]),'class' => 'modalButtonView btn btn-md btn-outline-primary']);
                                    $buttonTambah = Html::button('Tambah', ['value'=>Url::to(['surat-masuk/upload-file','id'=> $model['id']]), 'class'=>'modalButton btn btn-link']);

                                    if($media != NULL){
                                        return $buttonLihat.$buttonTambah;
                                    }  else {
                                      
                                        return  '<span class="badge badge-info">Belum diunggah</span>&nbsp<i>Isi Disposisi terlebih dahulu</i>';
                                    }
                            }
                        ],
                       
                      
                    ],
                ]) ?>
            </div>
            </div>
           
            <div class="col-md-6 ">
            <div class="card-header">
                <h5><span class="fas fa-comments"></span> Disposisi</h5>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                
                <?= $form->field($model, 'statusSurat')->radioList(array(1=>'Biasa',2=>'Penting', 3=>'Segera')); ?>

                <?= $form->field($model, 'isiDisposisi')->textarea(['rows' => 6]) ?>

                <?php // $form->field($model, 'kodeBidang')->widget(Select2::classname(), [
                    // 'data' => $bidang,
                    // 'options' => ['placeholder' => 'Pilih Bidang'],
                    // 'pluginOptions' => [
                    //     'allowClear' => true
                    // ],
                 //]); ?>

                <?= $form->field($model2, 'kodeBidang[]')->checkboxList($bidang, [
                'itemOptions' => [
                'class' => 'bidang'
                ]
                ])->label('Bidang <label><input type="checkbox" id="checkAll">Pilih semua</label>');
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

Modal::begin([
    'title'=>'<h4>Daftar Berkas</h4>',
    'id'=>'modalView',
    'size'=>'modal-lg',
]);
echo "<div id='modalContentView'></div>";
Modal::end();

?>
