<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Bidang $model */

$this->title = Yii::t('app', 'Create Bidang');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bidangs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
