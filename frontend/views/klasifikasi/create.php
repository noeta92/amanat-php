<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Klasifikasi $model */

$this->title = Yii::t('app', 'Create Klasifikasi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Klasifikasis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="klasifikasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
