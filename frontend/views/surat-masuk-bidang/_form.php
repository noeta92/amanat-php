<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SuratMasukBidang $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="surat-masuk-bidang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'noSurat')->textInput() ?>

    <?= $form->field($model, 'statusSurat')->textInput() ?>

    <?= $form->field($model, 'kodeBidang')->textInput() ?>

    <?= $form->field($model, 'jawabanDisposisi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timeJawaban')->textInput() ?>

    <?= $form->field($model, 'userJawab_id')->textInput() ?>

    <?= $form->field($model, 'tanggalTerimaKirim')->textInput() ?>

    <?= $form->field($model, 'namaTerimaKirim')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
