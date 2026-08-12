<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\Pegawai $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'statusAparatur')->radioList(array(1=>'ASN',2=>'Non ASN')); ?>

    <?= $form->field($model, 'namaLengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true])->label('NIP') ?>

    <?= $form->field($model, 'eselon')->widget(Select2::classname(), [
                    'data' => $eselon,
                    'options' => ['placeholder' => 'Pilih Eselon'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Eselon'); ?>

    <?= $form->field($model, 'kodeBidang')->widget(Select2::classname(), [
                    'data' => $bidang,
                    'options' => ['placeholder' => 'Pilih Bidang'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Bidang'); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
