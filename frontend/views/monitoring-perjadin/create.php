<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MonitoringPerjadin $model */

$this->title = 'Tambah Monitoring Perjadin';
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Perjadin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitoring-perjadin-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pegawai' => $pegawai,
        'surat' => $surat,
    ]) ?>

</div>
