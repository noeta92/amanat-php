<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MonitoringLembur $model */

$this->title = 'Tambah Monitoring Lembur';
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Lembur', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitoring-lembur-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pegawai' => $pegawai,
        'surat' => $surat,
    ]) ?>

</div>
