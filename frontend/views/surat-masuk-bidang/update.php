<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SuratMasukBidang $model */

$this->title = Yii::t('app', 'Update Surat Masuk Bidang: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Surat Masuk Bidangs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="surat-masuk-bidang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
