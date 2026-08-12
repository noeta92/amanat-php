<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MonitoringHonorarium $model */

$this->title = 'Tambah Honorarium';
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Honorarium', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitoring-honorarium-create">


    <?= $this->render('_form', [
        'model' => $model,
        'pegawai' => $pegawai,
        'surat' => $surat,
    ]) ?>

</div>
