<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2

/** @var yii\web\View $this */
/** @var common\models\SuratMasuk $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="surat-masuk-form">
    <div class="card">
        <div class="card-body">
            <div class = "row">
                <div class="col-md-6">
                    <?php $form = ActiveForm::begin(); ?>
                    
                    <?= $form->field($model, 'noSurat')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'asalTujuan')->textInput(['maxlength' => true])->label('Asal') ?>

                    <?= $form->field($model, 'kodeKlasifikasi')->widget(Select2::classname(), [
                        'data' => $klasifikasi,
                        'options' => ['placeholder' => 'Pilih Klasifikasi'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]); ?>
                
                    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

                    <?= '<label class="form-label">Tanggal Surat</label>'; ?>

                    <?= DatePicker::widget([
                        'model' => $model, 
                        'attribute' => 'tanggalSurat',
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'options' => ['placeholder' => 'Pililh Tanggal Surat', 'autocomplete' => 'off'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ],
                    
                    ]); ?>

                    <br>
        
                    <?= '<label class="form-label">Tanggal Diteruskan</label>'; ?>
                    <?= DatePicker::widget([
                        'model' => $model, 
                        'attribute' => 'tanggalTerimaKirim',
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'options' => ['placeholder' => 'Pililh Tanggal Diteruskan', 'autocomplete' => 'off'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'yyyy-mm-dd',
                            
                        ],
                        
                    ]); ?>
                    
                    <br>

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
