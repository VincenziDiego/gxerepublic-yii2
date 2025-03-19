<?php
use yii\helpers\Html;
use yii\helpers\Url;
date_default_timezone_set('Europe/Rome');

// Formatta la data in un formato più leggibile se preferisci
$formattedDate = Yii::$app->formatter->asDatetime(strtotime($model->published_at), 'php:d/m/Y H:i');
?>

<!-- Card con effetto gradiente e hover 3D -->
<div class="news-gradient-card scroll-reveal"
    onclick="window.location.href='<?= Url::to(['news/read', 'id' => $model->id]) ?>'" style="cursor: pointer;">

    <!-- Badge per la data -->
    <span class="card-badge"><?= Yii::$app->formatter->asDate(strtotime($model->published_at), 'php:d M') ?></span>

    <div class="card-content">
        <!-- Titolo della news -->
        <h3 class="card-title">
            <?= Html::encode($model->title) ?>
        </h3>

        <!-- Autore, data e anteprima del contenuto -->
        <p class="card-para">
            <span class="author-info">Pubblicata da <?= Html::encode($model->author->username) ?></span>
            <span class="date-info"><?= $formattedDate ?></span>
            <span class="news-preview"><?= nl2br(Html::encode(substr($model->content, 0, 100))) ?>...</span>
        </p>

        <!-- Indicatore visivo per suggerire l'azione di click -->
        <div class="card-action-hint">
            <span>Leggi l'articolo completo</span>
        </div>
    </div>
</div>