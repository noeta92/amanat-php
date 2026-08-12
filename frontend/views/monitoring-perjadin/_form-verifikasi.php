<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\SuratMasuk $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Verifikasi';
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Perjadin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="surat-masuk-form">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?php $form->field($model, 'statusVerifikasi')->hiddenInput(['value' => '1'])->label(false) ?>

    <label class="form-label">Persetujuan Perjalanan Dinas Ini: </label>

   <?php  
    $buttonTerima = 
    Html::button('<span class="fas fa-check-circle"></span> Terima', ['value'=>Url::to(['monitoring-perjadin/verifikasi','idPerjadin'=> $model['idPerjadin'], $status=1]), 'class'=>'modalButton btn btn-md btn-success']);
    
    $buttonTolak = 
    Html::button('<span class="fas fa-times-circle"></span> Tolak', ['value'=>Url::to(['monitoring-perjadin/verifikasi','idPerjadin'=> $model['idPerjadin'], $status=2]), 'class'=>'modalButton btn btn-md btn-danger']);
    ?>

    <h5>
    <?= $form->field($model, 'statusVerifikasi')->radioList( [1=>'Terima', 2=> 'Tolak'], ['unselect' => null], ['style'=>'background:gray;color:#fff;'])->label(false); ?>

    </h5>
    <div class="form-group">
        <?= Html::submitButton('Kirim', ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

