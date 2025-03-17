<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NewsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- Se vuoi cercare per ID (commentato) -->
    <?php // echo $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <!-- Se non ti serve, puoi commentare -->
    <?= $form->field($model, 'author_username') ?>

    <?= $form->field($model, 'created_at') ?>
    <?= $form->field($model, 'updated_at') ?>

    <!-- Campo per status -->
    <?= $form->field($model, 'status')->dropDownList([
        '' => 'Tutti',
        1 => 'Pubblicato',
        0 => 'Bozza',
    ], [
        'prompt' => 'Seleziona stato', // Prima opzione "vuota"
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>