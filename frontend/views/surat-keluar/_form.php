<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2

/** @var yii\web\View $this */
/** @var common\models\SuratKeluar $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="surat-keluar-form">
    <div class="card">
        <div class="card-body">
            <div class = "row">
                <div class="col-md-6">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'asalTujuan')->textInput(['maxlength' => true])->label('Tujuan / Nama') ?>

                <?= $form->field($model, 'kodeKlasifikasi')->widget(Select2::classname(), [
                    'data' => $klasifikasi,
                    'options' => ['placeholder' => 'Pilih Klasifikasi'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($model, 'statusSurat')->radioList(array(1=>'Biasa',2=>'Penting')); ?>
            
                <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'uraianSurat')->textarea(['rows' => 6])->label('Isi Ringkas') ?>   

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
