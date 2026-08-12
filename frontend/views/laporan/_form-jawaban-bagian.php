<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\file\FileInput;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */
/* @var $form yii\widgets\ActiveForm */

// $this->params['breadcrumbs'][] = ['label' => 'Pengaduan', 'url' => ['laporan/harian']];
// $this->params['breadcrumbs'][] = $this->title;
?>

        <div class="ref-sektor-form">
            
            <div class="col-md-6">
                <div class="alert alert-success">
                Silahkan Pilih Bagian!
                </div>


            <?php $form = ActiveForm::begin(); ?>

            <?php // $form->field($model, 'noTiket')->textInput(['readonly' => true]) ?>
            <?php // $form->field($model, 'pelaporInternal_id')->textInput(['readonly' => true]) ?>
            <?php // $form->field($model, 'emailPelapor')->textInput(['readonly' => true]) ?>
            <?php // $form->field($model, 'handphone')->textInput(['readonly' => true]) ?>
            <?= $form->field($model, 'jenisIdentitas_id')->hiddenInput (['readonly' => true, 'id'=> 'jenisIdentitas_id'])->label(false) ?>
            <?= $form->field($model, 'noIdentitas')->hiddenInput(['readonly' => true])->label(false) ?>
            <?= $form->field($model, 'namaPelapor')->hiddenInput(['readonly' => true])->label(false) ?>
            <?= $form->field($model, 'perihal')->hiddenInput(['readonly' => true])->label(false) ?>
            <?= $form->field($model, 'instansiPelapor')->hiddenInput(['readonly' => true])->label(false) ?>
            <?= $form->field($model, 'uraianLapor')->hiddenInput(['readonly' => true])->label(false) ?>
            <?= $form->field($model, 'tanggalLapor')->hiddenInput(['readonly' => false])->label(false) ?>
            <?= $form->field($model, 'timeLapor')->hiddenInput(['readonly' => true])->label(false) ?>
        
            <?= $form->field($model, 'kodeBagian')->dropDownList($bagian, ['prompt'=>'Pilih Bagian', 'id'=> 'kodeBagian'])?>
            <?php // echo $form->field($model, 'uraianPenyelesaian')->textArea() ?>

            <?php 
//                echo $form->field($model, 'tanggalPenyelesaian')
//                ->widget(DatePicker::className(),
//                ['pluginOptions'=> 
//                    ['format' => 'yyyy-m-dd' ,'options'=>['class'=>'form-control']
//                ]
//                ]); 
            ?>

            
            <?= $form->field($model, 'timeJawaban')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'statusAduan')->hiddenInput()->label(false) ?>
            
            <?php // $form->field($model, 'userJawab_id')->textInput() ?>
            <?php // $form->field($model, 'timeVerifikasi')->textInput() ?>
            <?php // $form->field($model, 'userVerifikasi')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Kirim', ['class' => 'btn btn-success', 'name'=>'kirim']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>