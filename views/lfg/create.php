<?php
use yii\helpers\Html;

$this->title = 'Crea nuovo LFG';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/lfg-create.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<div class="lfg-create container mt-4">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="lfg-form">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>