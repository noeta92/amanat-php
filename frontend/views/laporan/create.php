<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */

$this->title = 'Buat Pengaduan';
$this->params['breadcrumbs'][] = ['label' => 'Pengaduans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('img/post-bg1.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1>Buat Pengaduan</h1>
                    <h2 class="subheading">Pengaduan Baru</h2>

                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="pengaduan-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <?=
        $this->render('_form', [
            'model' => $model,
            'identitas' => $identitas,
        ])
        ?>

    </div>
</div>
