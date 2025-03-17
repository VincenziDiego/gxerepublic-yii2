<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ActivityType $model */

$this->title = 'Update Activity Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Activity Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activity-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
