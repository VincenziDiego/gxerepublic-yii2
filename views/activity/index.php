<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\ActivitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Activities';
$this->registerCssFile('@web/css/activity-index.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_END,
]);
?>
<div class="activity-dashboard container mt-4">
    <header class="dashboard-header mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="dashboard-actions">
            <?= Html::a('Create Activity', ['create'], ['class' => 'btn btn-success create-activity-btn']) ?>
        </div>
    </header>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        // Ogni elemento viene visualizzato come una card in una griglia
        'itemOptions' => ['class' => 'activity-dashboard-item col-md-4 col-sm-6'],
        'itemView' => '_activity_dashboard_item',
        'layout' => "<div class='row'>{items}</div>\n<div class='d-flex justify-content-center'>{pager}</div>",
    ]) ?>
</div>