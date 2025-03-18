<?php
use yii\helpers\ArrayHelper;
use app\models\ActivityType;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="activity-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php
    // Recupera tutte le categorie da ActivityType
    $items = ArrayHelper::map(ActivityType::find()->all(), 'id', 'name');
    ?>
    <?= $form->field($model, 'activity_type_id')->dropDownList($items, [
        'prompt' => 'Select Category'
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'default_players')->textInput() ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>