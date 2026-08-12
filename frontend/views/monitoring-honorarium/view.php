<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\MonitoringHonorarium $model */

$this->title = $model->idHonor;
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Honoraria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="monitoring-honorarium-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idHonor' => $model->idHonor], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idHonor' => $model->idHonor], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idHonor',
            'idPegawai',
            'jenisSurat',
            'idSurat',
            'tanggal',
            'tujuan',
            'tempat',
            'statusVerifikasi',
            'verifikasiBy',
            'createdOn',
            'createdBy',
        ],
    ]) ?>

</div>
