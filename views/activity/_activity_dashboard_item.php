<?php
use yii\helpers\Html;
use yii\helpers\Url;

date_default_timezone_set('Europe/Rome');
$currentUser = Yii::$app->user->identity;
?>
<div class="card news-dashboard-card shadow-sm">
    <div class="card-body">
        <h5 class="card-title"><?= Html::encode($model->title) ?></h5>

        <div class="news-meta">
            <span class="news-author">
                <?php
                if ($model->user) {
                    $iconUrl = Yii::getAlias('@web') . '/' . $model->user->icon_url;
                    $username = $model->user->username;
                } else {
                    $iconUrl = Yii::getAlias('@web') . '/uploads/default.jpg';
                    $username = $model->author_username;
                }
                ?>
                <?= Html::img($iconUrl, ['class' => 'user-icon', 'alt' => $username, 'loading' => 'lazy']) ?>
                <span class="author-name"><?= Html::encode($username) ?></span>
            </span>
            <span class="news-date">
                <i class="far fa-clock"></i>
                <?= Yii::$app->formatter->asDatetime(strtotime($model->created_at), 'php:d/m/Y H:i') ?>
            </span>
        </div>

        <p class="card-text">
            <?= nl2br(Html::encode(substr($model->content, 0, 150))) ?>...
        </p>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <span class="news-status badge <?= $model->status == 1 ? 'badge-success' : 'badge-secondary' ?>">
            <i class="fas fa-<?= $model->status == 1 ? 'check-circle' : 'clock' ?>"></i>
            <?= $model->status == 1 ? 'Pubblicato' : 'Bozza' ?>
        </span>

        <div class="news-actions">
            <?php
            if ($currentUser) {
                // Always show view button
                echo Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-outline-info',
                    'title' => 'Visualizza',
                    'aria-label' => 'Visualizza',
                ]);

                // Admin or author can edit/delete
                if (Yii::$app->user->can('admin') || ($model->user && $model->user->id === $currentUser->id)) {
                    echo Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-outline-warning',
                        'title' => 'Modifica',
                        'aria-label' => 'Modifica',
                    ]);
                    echo Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'title' => 'Elimina',
                        'aria-label' => 'Elimina',
                        'data' => [
                            'confirm' => 'Sei sicuro di voler eliminare questa news?',
                            'method' => 'post',
                        ],
                    ]);
                }
            }
            ?>
        </div>
    </div>
</div>