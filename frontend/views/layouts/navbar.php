<?php

use yii\helpers\Html;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
             <?php
            $jumlah = \Yii::$app->manajemen->getSurat();
            $role = \Yii::$app->manajemen->getPenugasan();
            ?>

            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fas fa-bell"></i><strong><?= ($jumlah !=0) ? '<span class = "badge badge-warning navbar-badge"><strong>'.$jumlah.'</strong></span>' : '' ?></strong>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                
            <div class="dropdown-divider"></div>
                <?php if ($role == 'admin') : ?>
                    <a href="<?= \yii\helpers\Url::to(['/surat-keluar/index']) ?>" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 
                        <?= $jumlah.' surat butuh verifikasi';?> 
                    <span class="float-right text-muted text-sm"></span>
                    </a>
                <?php endif; ?>

                <?php if ($role == 'Kabid') :?>
                <a href="<?= \yii\helpers\Url::to(['/surat-masuk/index']) ?>" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 
                <?= $jumlah.' surat belum diterima'; ?> 
                <span class="float-right text-muted text-sm"></span>
                </a>
                <?php endif; ?>
            </div>
            
           
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-user"></i> Ganti Password', ['/admin/user/change-password'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>

        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i> Logout', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->