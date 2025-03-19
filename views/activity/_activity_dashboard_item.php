<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $model app\models\Activity */
?>
<div class="card activity-dashboard-card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="card-title"><?= Html::encode($model->name) ?></h5>
        <p class="card-meta">
            <strong>Categoria:</strong>
            <?= $model->activityType ? Html::encode($model->activityType->name) : '(Nessuna)' ?>
        </p>
        <p class="card-meta">
            <strong>Default Players:</strong> <?= Html::encode($model->default_players) ?>
        </p>
        <p class="card-text">
            <?= nl2br(Html::encode(substr($model->description, 0, 150))) ?>...
        </p>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <div class="activity-actions">
            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->id], [
                'class' => 'btn btn-sm btn-outline-warning',
                'title' => 'Update'
            ]) ?>
            <?= Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-sm btn-outline-danger',
                'title' => 'Delete',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>