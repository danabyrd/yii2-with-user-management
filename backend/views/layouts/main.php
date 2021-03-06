<?php

/* @var $this \yii\web\View */
/* @var $content string */ 
/**
 *  
 * @category yii2-user-management extension added
 * @version yii2 2.0.13.1-bundled-extensions-0.0.1
 * 
 */

use backend\assets\AppAsset;
use yii\helpers\Html;
// Test replacing Yii Nav with GhostNav as implemented by GhostMenu
use yii\bootstrap\Nav;
// Ghost menu includes html markup for the menu items that I prefer not to use: dbyrd
// use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    // All users can see the Home menu item
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    // Get GhostMenu items from yii-user-management. Only elements that can 
    // be accessed by the logged on user are included in the menu items array.
    // Call a method that returns clean menu labels without html markup in the menu labels.
    $ghostMenu_items = UserManagementModule::menuItemsSansMarkup();
    // Use foreach to strip away the deep nesting of the menu items from GhostMenu's output
    foreach ($ghostMenu_items as $ghostMenu_item){
        $menuItems[] = $ghostMenu_item;
    }
    
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        /* default yii logout
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';        
        */
        // dbyrd simple logout url
        $logoutMenu_item = [
            'label'=> 'Logout (' . Yii::$app->user->identity->username . ')',
            'url'  => ['/site/logout'],
        ];        
        $menuItems[] = $logoutMenu_item;

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
