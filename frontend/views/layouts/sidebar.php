<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use mdm\admin\components\MenuHelper;
use yii\helpers\Url;;
use mdm\admin\components\Helper;

// if (!empty(Yii::$app->user->identity->id)) {
//     $items = MenuHelper::getAssignedMenu(Yii::$app->user->identity->id, 3);
// } else {
//     $items = array();
// }
?>
<aside class="main-sidebar sidebar-light-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../web/img/logo.png" alt="LogoDeliSerdang" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AMANAT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                <?php
                if (Yii::$app->user->isGuest) {
                   echo "LOGIN";
                } else { 
                    echo \Yii::$app->user->identity->username;
                    }?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            // echo \hail812\adminlte\widgets\Menu::widget([
            //     'items' => [
                    
            //         ['label' => 'Dashboard', 'url' => ['site/index'], 'icon' => 'tachometer-alt'],
            //         ['label' => 'Arsip Surat', 'header' => true],
            //         ['label' => 'Surat Masuk',  'icon' => 'inbox', 'url' => ['surat-masuk/index']],
            //         ['label' => 'Surat Keluar',  'icon' => 'file', 'url' => ['surat-keluar/index']],
            //         ['label' => 'Akun', 'header' => true],
            //         ['label' => 'Ganti Password',  'icon' => 'user', 'url' => ['']],
            //     ],
            // ]);  

            $menuItems  = [
                    ['label' => 'Dashboard', 'url' => ['site/index'], 'icon' => 'tachometer-alt'],
                   
                    ['label' => 'Arsip Surat', 'header' => true],
                    ['label' => 'Surat Masuk',  'icon' => 'inbox', 'url' => ['surat-masuk/index']],
                    ['label' => 'Surat Keluar',  'icon' => 'file', 'url' => ['surat-keluar/index']],
                    ['label' => 'Akun', 'header' => true],
                    ['label' => 'Ganti Password',  'icon' => 'user', 'url' => ['']],
            ];

            $callback = function($menu){
                $data = $menu['data']; 
                //if have syntax error, unexpected 'fa' (T_STRING)  Errorexception,can use
               //$data = $menu['data'];
                return [
                    'label' => $menu['name'],
                    'url' => [$menu['route']],
                    'option' => $data,
                    'icon' => $menu['data'], 
                    'items' => $menu['children'],
                ];
            };

            
            $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);

             echo  \hail812\adminlte\widgets\Menu::widget(
                [
                    'options' => ['class' => ' nav nav-pills nav-sidebar flex-column sidebar-menu', 'data-widget' => 'treeview'], 
                    'items' => $items
                ]
            )

            // echo Nav::widget([
            //     'options' => ['class' => 'nav nav-pills nav-sidebar flex-column sidebar-menu'],
            //     'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true)
            // ]);

            // $menuItems = Helper::filter($menuItems);

            // echo \hail812\adminlte\widgets\Menu::widget([
            //     'items' => $menuItems,
            // ]);
            
            ?> 

    
            
           
            
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>