<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\MonitoringPerjadin $model */

$this->title = $model->idPerjadin;
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Perjadins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="monitoring-perjadin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idPerjadin' => $model->idPerjadin], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idPerjadin' => $model->idPerjadin], [
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
            'idPerjadin',
            'idPegawai',
            'jenisSurat',
            'idSurat',
            'perihal',
            'tanggal',
            'tempat',
            'statusVerifikasi',
            'verifikasiBy',
            'createdOn',
        ],
    ]) ?>

</div>
