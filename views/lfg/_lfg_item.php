<?php
use yii\helpers\Html;

/* @var $model app\models\Lfg */
$currentPlayers = $model->current_players ? array_map('trim', explode(',', $model->current_players)) : [];
$reservePlayers = $model->reserve_players ? array_map('trim', explode(',', $model->reserve_players)) : [];
$userBungieId = Yii::$app->user->identity->bungieid;
?>
<article id="lfg-<?= $model->id ?>" class="card lfg-card">
    <div class="card-body">
        <h3 class="card-title"><?= Html::encode($model->activity_type) ?></h3>
        <p class="card-text"><?= Html::encode($model->description) ?></p>
        <p class="card-info">
            <strong>Leader:</strong> <?= isset($model->leader) ? Html::encode($model->leader->bungieid) : 'N/D' ?>
        </p>
        <p class="card-info">
            <strong>Giocatori:</strong> <?= count($currentPlayers) ?> / <?= $model->max_players ?>
        </p>
        <p class="card-info">
            <strong>Lista:</strong> <?= Html::encode(implode(', ', $currentPlayers)) ?>
        </p>
        <p class="card-info">
            <strong>Riserve:</strong> <?= Html::encode(implode(', ', $reservePlayers)) ?>
        </p>
        <p class="card-info">
            <strong>Stato:</strong> <?= $model->status == 1 ? 'Aperto' : 'Chiuso' ?>
        </p>
        <p class="card-info">
            <strong>Inizio:</strong>
            <?= $model->start_time ? Yii::$app->formatter->asDatetime(strtotime($model->start_time), 'php:d/m/Y H:i') : 'Non definito' ?>
        </p>
    </div>
    <div class="card-footer">
        <?php if (empty($userBungieId)): ?>
            <?= Html::a('Completa il profilo', ['profile/update'], ['class' => 'btn btn-warning btn-profile']) ?>
        <?php elseif ($model->status == 1 && !in_array($userBungieId, $currentPlayers) && !in_array($userBungieId, $reservePlayers)): ?>
            <?= Html::a('Unisciti', ['join', 'id' => $model->id], ['class' => 'btn btn-success btn-join']) ?>
            <?= Html::a('Riserve', ['join-reserve', 'id' => $model->id], ['class' => 'btn btn-info btn-reserve']) ?>
        <?php elseif (in_array($userBungieId, $currentPlayers) || in_array($userBungieId, $reservePlayers)): ?>
            <?= Html::a('Esci', ['leave', 'id' => $model->id], ['class' => 'btn btn-warning btn-leave']) ?>
        <?php endif; ?>

        <?php if ($model->canEdit(Yii::$app->user->id)): ?>
            <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-edit']) ?>
            <?= Html::a('Elimina', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-delete',
                'data' => [
                    'confirm' => 'Sei sicuro di voler cancellare questo LFG?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </div>
</article>