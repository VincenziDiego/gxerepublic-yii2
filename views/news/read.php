<?php
use yii\helpers\Html;

date_default_timezone_set('Europe/Rome');

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News Pubblicate', 'url' => ['public']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/read-news.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<section class="news-read container mt-4">
    <article class="news-card">
        <header class="news-card-header">
            <h2 class="news-title"><?= Html::encode($model->title) ?></h2>
            <p class="news-meta">
                Pubblicata da <?= Html::encode($model->author->username) ?>
                il <?= Yii::$app->formatter->asDatetime(strtotime($model->published_at), 'php:d/m/Y H:i') ?>
            </p>
        </header>
        <div class="news-card-body">
            <div class="news-content">
                <?= nl2br(Html::encode($model->content)) ?>
            </div>
        </div>
        <footer class="news-card-footer">
            Stato: <span class="<?= $model->status == 1 ? 'status-pubblicato' : 'status-bozza' ?>">
                <?= $model->status == 1 ? 'Pubblicata' : 'Bozza' ?>
            </span>
        </footer>
    </article>
</section>