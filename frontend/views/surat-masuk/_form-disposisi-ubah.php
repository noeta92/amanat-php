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
    $(function(){
        $('.modalButton').click(function (){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        });
    });
");

$this->registerJs("
  jQuery('#checkAll').change(function(){
    jQuery('.bidang').prop('checked',this.checked?'checked':'');}
  );
  
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
                    ],
                ]) ?>
                <br>
                <div class="card-body table-responsive p-0">
                <table class= "table table-responsive text-nowrap">
                        
                    <tr>
                        <td><strong>Diteruskan ke: </strong></td>
                        <td></td>
                    </tr>
                        <?php foreach ($modelBidang as $valueBidang): ?>
                    <tr>
                        
                        <td><?= $valueBidang->bidang->bidang ?></td>
                        <td><?=  Html::a('<span class="fas fa-times"></span> Batal', ['delete-masuk-bidang', 'id'=>$valueBidang->id], ['class' => 'btn btn-sm btn-link', 
                                    'data-confirm' => Yii::t('yii', 'Yakin batalkan?'),
                                    'data-method' => 'post', 'data-pjax' => '0']); ?></td>
                    </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
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

                <?= $form->field($model2, 'kodeBidang[]')->checkboxList($bidang, [
                'itemOptions' => [
                'class' => 'bidang'
                ]
                ])->label('Tambah Bidang:');
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
        'title'=>'<h4>Unggah Berkas</h4>',
        'id'=>'modal',
        'size'=>'modal-lg',
        ]);
        echo "<div id='modalContent'></div>";
    Modal::end();
?>
