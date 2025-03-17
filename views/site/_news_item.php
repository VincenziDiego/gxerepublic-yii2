<?php
use yii\helpers\Html;
date_default_timezone_set('Europe/Rome');
?>
<div class="card news-dashboard-card shadow-sm mb-4 scroll-reveal">
    <div class="card-header">
        <div class="header-content">
            <h5 class="card-title">
                <?= Html::encode($model->title) ?>
            </h5>
            <small class="card-meta">
                Pubblicata da <?= Html::encode($model->author->username) ?> &bull;
                <?= Yii::$app->formatter->asDatetime(strtotime($model->published_at), 'php:d/m/Y H:i') ?>
            </small>
        </div>
    </div>
    <div class="card-body">
        <p class="card-text">
            <?= nl2br(Html::encode(substr($model->content, 0, 200))) ?>...
        </p>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <span class="news-status badge <?= $model->status == 1 ? 'badge-success' : 'badge-secondary' ?>">
            <?= $model->status == 1 ? 'Pubblicata' : 'Bozza' ?>
        </span>
        <?= Html::a(
            'Leggi',
            ['news/read', 'id' => $model->id],
            ['class' => 'btn btn-primary btn-sm']
        ) ?>
    </div>
</div>