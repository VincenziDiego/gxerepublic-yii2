<?php
use yii\widgets\ListView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NewsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'News Dashboard';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/index-news.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_END,
]);
?>
<div class="news-dashboard container mt-4">
    <header class="dashboard-header mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="dashboard-actions">
            <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success create-news-btn']) ?>
        </div>
    </header>
    <?php // Se vuoi includere il form di ricerca, decommenta la riga seguente
    // echo $this->render('_search', ['model' => $searchModel]);
    ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'news-dashboard-item col-md-4 col-sm-6'],
        'itemView' => '_news_dashboard_item',
        'layout' => "<div class='row'>{items}</div>\n<div class='d-flex justify-content-center'>{pager}</div>",
    ]) ?>
</div>