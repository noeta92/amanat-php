<?php

/* @var $this \yii\web\View */
/* @var $content string */

use manajemen\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use mdm\admin\components\MenuHelper;
use yii\helpers\Url;
use mdm\admin\components\Helper;


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
    <?php
    $logo = Url::to('');

    NavBar::begin([
        //'brandLabel' => '<img src="'.$logo.'" class="img-fluid" style ="width:70px;height: 70px"/>' . Yii::$app->name,
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
           // 'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top shadow-sm',
            'class' => 'navbar navbar-expand-md navbar-dark bg-info fixed-top shadow-sm',
        ],
    ]);
    $menuItems = [
        ['label' => 'Beranda', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {

        $menuItems[] = [
            'label' => 'Manajemen Pengguna',
            'items' => [
                 ['label' => 'Daftar Pengguna', 'url' => ['/admin/user']],
                 ['label' => 'Penugasan', 'url' => ['/admin/assignment']],
                 ['label' => 'Peran', 'url' => ['/admin/role']],
                 ['label' => 'Menu', 'url' => ['/admin/menu']],
                 ['label' => 'Route', 'url' => ['/admin/route']],

            ],
         ];
        $menuItems[] = ['label' => 'Sinkronisasi Data', 'url' => ['/verifikasi-aturan/index']];
    
        
        $menuItems[] = [
            'label' => 'Logout (' . \Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
                     
    }
    $menuItems = Helper::filter($menuItems);

    echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $menuItems,
    ]);

    NavBar::end();
    ?>
    
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container px-5">
        <p class="float-start">&copy; <?= date('Y') ?> <?= Html::encode(Yii::$app->name) ?></p>
        <p class="float-end"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
