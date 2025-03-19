<?php
use yii\widgets\ListView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NewsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'News Dashboard';
$this->registerCssFile('@web/css/news-index.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_END,
]);

// Impostiamo una dependency globale per il listing,
// per esempio, in base al massimo updated_at delle news
$dependency = [
    'class' => 'yii\caching\DbDependency',
    'sql' => 'SELECT MAX(updated_at) FROM news',
];
?>
<div class="news-dashboard container mt-4">
    <header class="dashboard-header mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="dashboard-actions">
            <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success create-news-btn']) ?>
        </div>
    </header>
    <?php if ($this->beginCache('news-dashboard-list', ['duration' => 3600, 'dependency' => $dependency])): ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'news-dashboard-item col-md-4 col-sm-6'],
            'itemView' => '_news_dashboard_item',
            'layout' => "<div class='row'>{items}</div>\n<div class='d-flex justify-content-center'>{pager}</div>",
        ]) ?>
        <?php $this->endCache(); endif; ?>
</div>