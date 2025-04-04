<?php
/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;
use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerCssFile('@web/css/main.css', [
    'depends' => [AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100 modern-body">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => Html::img('@web/logo.png', [
                'alt' => Yii::$app->name,
                'class' => 'navbar-brand-logo'
            ]),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar navbar-expand-lg navbar-modern fixed-top'],
            'innerContainerOptions' => ['class' => 'container'],
        ]);

        // Menu items lato sinistro
        $leftItems = [
            ['label' => 'Home', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'nav-link-main']],
            ['label' => 'About', 'url' => ['/site/about'], 'linkOptions' => ['class' => 'nav-link-main']],
            ['label' => 'Contact', 'url' => ['/site/contact'], 'linkOptions' => ['class' => 'nav-link-main']],
        ];

        // Menu items lato destro
        $rightItems = [];

        if (!Yii::$app->user->isGuest && Yii::$app->user->can('user') && !Yii::$app->user->can('author') && !Yii::$app->user->can('admin')) {
            $rightItems[] = ['label' => 'News', 'url' => ['/news/public'], 'linkOptions' => ['class' => 'nav-link-main']];
        }

        if (!Yii::$app->user->isGuest && Yii::$app->user->can('author')) {
            $rightItems[] = [
                'label' => 'News',
                'items' => [
                    ['label' => 'Pubblicate', 'url' => ['/news/public']],
                    ['label' => 'Dashboard', 'url' => ['/news']],
                ]
            ];
        }

        if (!Yii::$app->user->isGuest && Yii::$app->user->can('user') && !Yii::$app->user->can('admin')) {
            $rightItems[] = ['label' => 'LFG', 'url' => ['/lfg'], 'linkOptions' => ['class' => 'nav-link-main']];
        }

        if (!Yii::$app->user->isGuest && Yii::$app->user->can('admin')) {
            $rightItems[] = [
                'label' => 'LFG',
                'items' => [
                    ['label' => 'Lista LFG', 'url' => ['/lfg']],
                    ['label' => 'Dashboard attività', 'url' => ['/activity']],
                    ['label' => 'Dashboard tipologie attività', 'url' => ['/activity-type']],
                ]
            ];
        }

        if (!Yii::$app->user->isGuest && Yii::$app->user->can('admin')) {
            $rightItems[] = [
                'label' => 'Admin',
                'items' => [
                    ['label' => 'Utenti', 'url' => ['/admin/user']],
                    ['label' => 'Ruoli', 'url' => ['/admin/role']],
                    ['label' => 'Permessi', 'url' => ['/admin/permission']],
                    ['label' => 'Route', 'url' => ['/admin/route']],
                    ['label' => 'Assegnazioni', 'url' => ['/admin/assignment']],
                    ['label' => 'Menu', 'url' => ['/admin/menu']],
                    ['label' => 'Gii', 'url' => ['/gii']],
                ]
            ];
        }

        if (Yii::$app->user->isGuest) {
            $rightItems[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'linkOptions' => ['class' => 'nav-btn nav-btn-signup']];
            $rightItems[] = ['label' => 'Login', 'url' => ['/site/login'], 'linkOptions' => ['class' => 'nav-btn nav-btn-login']];
        } else {
            $userIdentity = Yii::$app->user->identity;
            $profileImage = !empty($userIdentity->icon_url)
                ? Yii::getAlias('@web') . '/' . $userIdentity->icon_url
                : Yii::getAlias('@web') . '/uploads/default.jpg';
            $username = $userIdentity->username;
            $rightItems[] = [
                'label' => '<div class="user-icon-wrapper">'
                    . Html::encode($username)
                    . Html::img($profileImage, [
                        'class' => 'user-icon',
                        'alt' => $username,
                    ])
                    . '</div>',
                'encode' => false,
                'items' => [
                    ['label' => 'Profilo', 'url' => ['/profile/update']],
                    ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto'],
            'items' => $leftItems,
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => $rightItems,
            'encodeLabels' => false,
        ]);

        NavBar::end();
        ?>
    </header>

    <main id="main-content" class="flex-shrink-0">
        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-4">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <img src="<?= Yii::getAlias('@web/logo.png') ?>" alt="<?= Yii::$app->name ?>" class="footer-logo">
                    <p>Comunità di sviluppatori e appassionati di gaming. Innovazione, codice e divertimento in un unico
                        posto.</p>
                </div>
                <div class="footer-links">
                    <h5>Link utili</h5>
                    <ul>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['site/about']) ?>">Chi siamo</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['site/contact']) ?>">Contattaci</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['site/privacy']) ?>">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h5>Seguici</h5>
                    <ul>
                        <li><a href="#"><i class="bi bi-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="bi bi-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="bi bi-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-divider"></div>
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">
                    &copy; GXE Devs <?= date('Y') ?> // Sito in evoluzione
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <?= Yii::powered() ?>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>