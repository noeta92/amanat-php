<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MonitoringHonorarium $model */

$this->title = 'Update Honorarium: ' . $model->pegawai->namaLengkap;
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Honorarium', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idHonor, 'url' => ['view', 'idHonor' => $model->idHonor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="monitoring-honorarium-update">


    <?= $this->render('_form', [
        'model' => $model,
        'pegawai' => $pegawai,
        'surat' => $surat,
    ]) ?>

</div>
