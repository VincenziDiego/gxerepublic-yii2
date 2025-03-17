<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lfg $model */

$this->title = 'Crea nuovo LFG';

// Registra il CSS dedicato alla creazione degli LFG
$this->registerCssFile('@web/css/lfg-create.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<div class="lfg-create-page">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <div class="lfg-form-container">
        <div class="lfg-form-card">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>