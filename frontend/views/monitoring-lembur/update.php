<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MonitoringLembur $model */

$this->title = 'Update Lembur: ' . $model->pegawai->namaLengkap;
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Lembur', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idLembur, 'url' => ['view', 'idLembur' => $model->idLembur]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="monitoring-lembur-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pegawai' => $pegawai,
        'surat' => $surat,
    ]) ?>

</div>
