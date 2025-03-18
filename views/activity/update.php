<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Activity $model */

$this->title = 'Update Activity: ' . $model->name;

?>
<div class="activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>