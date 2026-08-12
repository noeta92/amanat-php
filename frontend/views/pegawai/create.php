<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pegawai $model */

$this->title = Yii::t('app', 'Create Pegawai');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pegawais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'bidang' => $bidang,
        'eselon' => $eselon,
    ]) ?>

</div>
