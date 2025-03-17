<?php
use yii\helpers\Html;

date_default_timezone_set('Europe/Rome');
?>
<article class="card news-card shadow-sm">
    <div class="card-header">
        <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
        <div class="card-meta">
            <small>
                Pubblicata da <?= Html::encode($model->author->username) ?>
                il <?= Yii::$app->formatter->asDatetime(strtotime($model->published_at), 'php:d/m/Y H:i') ?>
            </small>
        </div>
    </div>
    <div class="card-body">
        <p class="card-text">
            <?= nl2br(Html::encode(substr($model->content, 0, 200))) ?>...
        </p>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <span class="news-status <?= $model->status == 1 ? 'status-pubblicato' : 'status-bozza' ?>">
            <?= $model->status == 1 ? 'Pubblicata' : 'Bozza' ?>
        </span>
        <?= Html::a(
            'Leggi',
            ['news/read', 'id' => $model->id],
            ['class' => 'btn btn-primary btn-sm']
        ) ?>
    </div>
</article>