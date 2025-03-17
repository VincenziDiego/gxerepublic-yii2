<?php
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'Lista LFG';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/lfg-index.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<section class="lfg-index container mt-4">
    <header class="lfg-index-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Crea LFG', ['create'], ['class' => 'btn btn-success btn-create']) ?>
    </header>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'lfg-item mb-4'],
        'itemView' => '_lfg_item',
        'layout' => "{items}\n<div class='d-flex justify-content-center'>{pager}</div>",
    ]) ?>
</section>