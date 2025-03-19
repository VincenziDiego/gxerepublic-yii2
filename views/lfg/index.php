<?php
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'Lista LFG';
$this->registerCssFile('@web/css/lfg-index.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);

// Definisci una dependency per invalidare la cache se un LFG viene aggiornato
$dependency = [
    'class' => 'yii\caching\DbDependency',
    'sql' => 'SELECT MAX(updated_at) FROM lfg', // Assicurati che il nome della tabella sia corretto
];
?>
<section class="lfg-index container mt-4">
    <header class="lfg-index-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Crea LFG', ['create'], ['class' => 'btn btn-success btn-create']) ?>
    </header>

    <?php if ($this->beginCache('lfg-index-cache', ['duration' => 3600, 'dependency' => $dependency])): ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'lfg-item mb-4'],
            'itemView' => '_lfg_item',
            'layout' => "{items}\n<div class='d-flex justify-content-center'>{pager}</div>",
        ]) ?>
        <?php $this->endCache(); endif; ?>
</section>