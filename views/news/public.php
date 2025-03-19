<?php
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'News';

$this->registerCssFile('@web/css/news-public.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);

// Imposta la dependency sulla tabella news
$dependency = [
    'class' => 'yii\caching\DbDependency',
    'sql' => 'SELECT MAX(updated_at) FROM news',
];
?>
<section class="news-public container mt-4">
    <header class="news-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?php if (
        $this->beginCache('news-public-cache', [
            'duration' => 3600, // cache per 1 ora
            'dependency' => $dependency,
        ])
    ): ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'news-item mb-4'],
            'itemView' => '_news_item',
            'layout' => "{items}\n<div class='d-flex justify-content-center'>{pager}</div>",
        ]) ?>
        <?php $this->endCache(); endif; ?>
</section>