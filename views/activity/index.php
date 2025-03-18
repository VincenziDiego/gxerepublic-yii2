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
?>
<div class="news-dashboard container mt-4">
    <header class="dashboard-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="dashboard-actions">
            <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success create-news-btn']) ?>
        </div>
    </header>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="news-dashboard-content">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'news-dashboard-item'],
            'itemView' => '_news_dashboard_item',
            'layout' => "<div class='row'>{items}</div>\n<div class='pagination-container'>{pager}</div>",
            'pager' => [
                'options' => ['class' => 'pagination justify-content-center'],
                'linkContainerOptions' => ['class' => 'page-item'],
                'linkOptions' => ['class' => 'page-link'],
                'activePageCssClass' => 'active',
                'disabledPageCssClass' => 'disabled',
                'prevPageLabel' => '<i class="fas fa-chevron-left"></i>',
                'nextPageLabel' => '<i class="fas fa-chevron-right"></i>',
            ],
        ]) ?>
    </div>
</div>