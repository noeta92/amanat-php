<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MonitoringPerjadin $model */

$this->title = 'Update Perjadin: ' . $model->pegawai->namaLengkap;
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Perjadin', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->pegawai->namaLengkap, 'url' => ['view', 'idPerjadin' => $model->pegawai->namaLengkap]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="monitoring-perjadin-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pegawai' => $pegawai,
        'surat' => $surat,
    ]) ?>

</div>
