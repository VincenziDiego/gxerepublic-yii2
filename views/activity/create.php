<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Activity $model */

$this->title = 'Create Activity';
// Registrazione del CSS per il form
$this->registerCssFile('@web/css/activity-form.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<div class="activity-form-page">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
    <div class="activity-form-container">
        <div class="activity-form-card">
            <?= $this->render('_form', ['model' => $model]) ?>
        </div>
    </div>
</div>