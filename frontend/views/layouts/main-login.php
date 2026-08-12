<?php

/* @var $this \yii\web\View */
/* @var $content string */

\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);

$this->registerCss(
    ".login-page {
        background-color: #A8DAE7;
      }"
          
);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Manajemen Administrasi | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php  $this->beginBody() ?>
<div class="row">
    <div class = "col-md-6">
        <img src="<?= Yii::$app->request->baseUrl . '/img/welcome.jpg' ?>" class=" img-fluid" >
    </div>
    <div class = "col-md-6">
        <div class="mt-5 offset-lg-2 col-lg-8">
        <div class = "card">
        <div class="card-body">
            <div class="login-logo">
                <a href="<?=Yii::$app->homeUrl?>"><b>Amanat</b>Bappedalitbang</a>
            </div>
            <!-- /.login-logo -->
            <div class="text-center"><p><i>Aplikasi Manajemen Administrasi Bappedalitbang <br>Deli Serdang </i></p></div>
            <?= $content ?>
        </div>
        </div>
        </div>
    </div>
</div>
<!-- /.login-box -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>