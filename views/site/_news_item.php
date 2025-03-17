<?php
use yii\helpers\Html;
use yii\helpers\Url;
date_default_timezone_set('Europe/Rome');
?>
<!-- Card con effetto gradiente e hover 3D -->
<div class="card news-gradient-card scroll-reveal"
    onclick="window.location.href='<?= Url::to(['news/read', 'id' => $model->id]) ?>'" style="cursor: pointer;">
    <div class="card-content">
        <!-- Titolo della news -->
        <p class="card-title">
            <?= Html::encode($model->title) ?>
        </p>

        <!-- Autore, data e anteprima del contenuto -->
        <p class="card-para">
            Pubblicata da <?= Html::encode($model->author->username) ?> &bull;
            <?= Yii::$app->formatter->asDatetime(strtotime($model->published_at), 'php:d/m/Y H:i') ?>
            <br>
            <?= nl2br(Html::encode(substr($model->content, 0, 100))) ?>...
        </p>
    </div>
</div>