<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\News $model */

$this->title = 'Create News';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Registra il CSS dedicato
$this->registerCssFile('@web/css/create-news.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<div class="news-create-page">
    <h1 class="page-title text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>