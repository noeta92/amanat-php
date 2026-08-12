<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SuratMasuk $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Disposisi';
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="surat-masuk-form">
    
    <?php $form = ActiveForm::begin(); ?>
    
    

    <?= $form->field($model, 'namaTerimaKirim')->textarea(['rows' => 1])->label('Diterima Oleh:') ?>


    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

