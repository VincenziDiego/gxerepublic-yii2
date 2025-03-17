<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\News $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// Registra il file CSS dedicato (assicurati che il percorso sia corretto)
$this->registerCssFile('@web/css/view-news.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<div class="news-view modern-news-view">
    <div class="news-card">
        <div class="news-card-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <p class="news-meta">
                Creata da <?= Html::encode($model->author_username) ?> il
                <?= Yii::$app->formatter->asDatetime(strtotime($model->created_at), 'php:d/m/Y H:i') ?>
            </p>
        </div>
        <div class="news-card-body">
            <p><?= nl2br(Html::encode($model->content)) ?></p>
        </div>
        <div class="news-card-footer">
            <?= Html::a('Aggiorna', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Sei sicuro di voler cancellare questa News?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>