<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ActivityType $model */

$this->title = 'Create Activity Type';
$this->params['breadcrumbs'][] = ['label' => 'Activity Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
