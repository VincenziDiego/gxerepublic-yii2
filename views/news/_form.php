<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\News $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="news-form-container">
    <div class="news-form-card">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Titolo') ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6])->label('Contenuto') ?>

        <?= $form->field($model, 'status')->radioList([
            0 => 'Bozza',
            1 => 'Pubblicata'
        ], [
            'class' => 'status-radio', // classe personalizzata
        ])->label('Stato') ?>

        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>