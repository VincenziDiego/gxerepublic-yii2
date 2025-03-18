<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ActivityType;

/** @var yii\web\View $this */
/** @var app\models\ActivitySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <!-- Usa dropDownList per category_name in modo che l'utente selezioni la categoria per nome -->
    <?= $form->field($model, 'category_name')->textInput(['placeholder' => 'Search by Category']) ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'default_players') ?>

    <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>