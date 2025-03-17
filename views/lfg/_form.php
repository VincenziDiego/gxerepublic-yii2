<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lfg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lfg-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'max_players')->textInput() ?>

    <?= $form->field($model, 'start_time')->input('datetime-local', [
        'value' => $model->start_time ? date('Y-m-d\TH:i', strtotime($model->start_time)) : '',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crea' : 'Aggiorna', ['class' => $model->isNewRecord ? 'btn btn-success btn-submit' : 'btn btn-primary btn-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>