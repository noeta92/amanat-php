<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SuratMasukBidang $model */

$this->title = Yii::t('app', 'Create Surat Masuk Bidang');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Surat Masuk Bidangs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-masuk-bidang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
