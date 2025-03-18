<?php
use yii\helpers\Html;

$this->title = 'Aggiorna LFG: ' . $model->activity_type;
$this->registerCssFile('@web/css/lfg-update.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<div class="lfg-update container mt-4">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="lfg-form">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>