<?php
use yii\helpers\Html;
use yii\helpers\Url;

date_default_timezone_set('Europe/Rome');
$currentUser = Yii::$app->user->identity;
?>
<div class="card news-dashboard-card shadow-sm mb-4">
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
                <?= Html::img($iconUrl, ['class' => 'user-icon', 'alt' => $username]) ?>
                <?= Html::encode($username) ?>
            </span>
            <span class="news-date">
                <?= Yii::$app->formatter->asDatetime(strtotime($model->created_at), 'php:d/m/Y H:i') ?>
            </span>
        </div>
        <p class="card-text">
            <?= nl2br(Html::encode(substr($model->content, 0, 150))) ?>...
        </p>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <span class="news-status badge <?= $model->status == 1 ? 'badge-success' : 'badge-secondary' ?>">
            <?= $model->status == 1 ? 'Pubblicato' : 'Bozza' ?>
        </span>
        <div class="news-actions">
            <?php
            // Controllo dei permessi per mostrare i pulsanti Modifica ed Elimina
            if ($currentUser) {
                // Usa RBAC per verificare se l'utente ha il ruolo "admin"
                // oppure se l'utente è l'autore della news
                if (Yii::$app->user->can('admin') || ($model->user && $model->user->id === $currentUser->id)) {
                    echo Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-outline-info',
                        'title' => 'Visualizza'
                    ]);
                    echo Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-outline-warning',
                        'title' => 'Modifica'
                    ]);
                    echo Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'title' => 'Elimina',
                        'data' => [
                            'confirm' => 'Sei sicuro di voler eliminare questa news?',
                            'method' => 'post',
                        ],
                    ]);
                }

                if (!Yii::$app->user->can('admin') && !($model->user && $model->user->id === $currentUser->id)) {
                    echo Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-outline-info',
                        'title' => 'Visualizza'
                    ]);
                }
            }
            ?>
        </div>
    </div>
</div>