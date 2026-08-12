<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SuratKeluar $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Tambah no. Surat Keluar';
$this->params['breadcrumbs'][] = ['label' => 'Surat Keluar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="surat-keluar-form">
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

                        [
                            'attribute'=>'kodeBidang',
                            'format' => 'raw',
                            'label' => 'Bidang',
                            'filter'=> $bidang,
                            'value' => function ($model){
                              
                                return $model->bidang->bidang;
                            }
                        ],
            
                        'perihal',
                        'uraianSurat:ntext',
                       
                      
                    ],
                ]) ?>

            </div>
            </div>
           
            <div class="col-md-6 ">
            <div class="card-header">
                <h5><span class="fas fa-envelope"></span> No. Surat</h5>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                
                <?= $form->field($model, 'noSurat')->textInput() ?>

                <?= '<label class="form-label">Tanggal Surat</label>'; ?>

                <?= DatePicker::widget([
                    'model' => $model, 
                    'attribute' => 'tanggalSurat',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'options' => ['placeholder' => 'Pililh Tanggal Surat', 'autocomplete' => 'off'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                            'todayBtn' => true,

                    ],
                ]); ?>

                <br>

                <?= $form->field($model, 'kodeKlasifikasi')->widget(Select2::classname(), [
                    'data' => $klasifikasi,
                    'options' => ['placeholder' => 'Pilih Klasifikasi'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <div class="form-group">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
