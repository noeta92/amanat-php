<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use perencanaan\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

?> 

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>

<!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <?php
        $logo = Url::to('@web/img/logo.png');
        NavBar::begin([
            'brandLabel' => '<img src="'.$logo.'" class="img-fluid" style ="width:70px;height: 70px"/>' . Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                //'class' => 'navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm',
                'class' => 'navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm',
                
                
            ],
        ]);
        $menuItems = [
            ['label' => 'Beranda', 'url' => ['/site/index']],
            [
                'label' => 'Profil',
                'items' => [
                     ['label' => 'Visi dan Misi', 'url' => ['laman/visi-misi']],
                     ['label' => 'Tupoksi', 'url' => ['laman/tupoksi']],
                     ['label' => 'Struktur Organisasi', 'url' => ['laman/struktur']],
                ],
             ],
            ['label' => 'Dokumen Publik', 'url' => ['dokumen/index']],
            ['label' => 'Galeri', 'url' => ['laman/galeri']],
            ['label' => 'PPID', 'url' => 'http://ppid.deliserdangkab.go.id/', 'linkOptions' => ['target'=>'_blank']],
            ['label' => 'User', 'url' => 'http://localhost/webbappedalitbang/backend/web', 'linkOptions' => ['target'=>'_blank']],
        ];
        // if (Yii::$app->user->isGuest) {
        //     $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        // } else {
        //     $menuItems[] = '<li>'
        //         . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
        //         . Html::submitButton(
        //             'Logout (' . Yii::$app->user->identity->username . ')',
        //             ['class' => 'btn btn-link logout']
        //         )
        //         . Html::endForm()
        //         . '</li>';
        // }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto me-4 my-3 my-lg-0'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>


</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink'=> ['url'=>'site/index','label'=>'Beranda'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [
               
            ],
        ]) ?>
        <?= Alert::widget() ?>
    </div>
        <?= $content ?>
    
</main>

<!-- <footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?php // echo Html::encode(Yii::$app->name) ?> <?php // echo date('Y') ?></p>
        <p class="float-right"><?php //echo Yii::powered() ?></p>
    </div>
</footer> -->
<footer class="bg-black text-center py-5">
    <div class="container px-5">
        
        <div class="text-light medium">
            <div class="mb-2">Badan Perencanaan Pembangunan Penelitian dan Pengembangan Kabupaten Deli Serdang<br>
            Jl. Karya Dharma No. 2, Lubuk Pakam, Kabupaten Deli Serdang</div>
        </div>
        <div class="text-white-50 small">
            <div class="mb-2">&copy; Bappedalitbang Kabupaten Deli Serdang <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
