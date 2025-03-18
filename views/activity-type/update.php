<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ActivityType $model */

$this->title = 'Update Activity Type: ' . $model->name;
?>
<div class="activity-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>