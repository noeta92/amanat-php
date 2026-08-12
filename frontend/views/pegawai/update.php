<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pegawai $model */

$this->title = Yii::t('app', 'Update Pegawai: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pegawais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'bidang' => $bidang,
        'eselon' => $eselon,
    ]) ?>

</div>
