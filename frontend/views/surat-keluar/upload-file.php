<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Dokumen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dokumen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namaFile')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'file')->fileInput()->label('Berkas:') ?>

    

    <div class="form-group">
        <?= Html::submitButton('Unggah', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
