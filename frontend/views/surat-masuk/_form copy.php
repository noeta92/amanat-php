<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SuratMasuk $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="surat-masuk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'noSurat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggalSurat')->textInput() ?>

    <?= $form->field($model, 'statusSurat')->textInput() ?>

    <?= $form->field($model, 'kodeBidang')->textInput() ?>

    <?= $form->field($model, 'kodeKlasifikasi')->textInput() ?>

    <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uraianSurat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isiDisposisi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timeDisposisi')->textInput() ?>

    <?= $form->field($model, 'jawabanDisposisi')->textInput() ?>

    <?= $form->field($model, 'timeJawaban')->textInput() ?>

    <?= $form->field($model, 'userJawab_id')->textInput() ?>

    <?= $form->field($model, 'tanggalTerimaKirim')->textInput() ?>

    <?= $form->field($model, 'namaTerimaKirim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timeCreated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
