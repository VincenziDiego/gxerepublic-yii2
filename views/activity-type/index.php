<?php

use app\models\ActivityType;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ActivityTypeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Activity Types';

// Registra il file CSS (assicurati di creare activity-type-index.css o di usare un file CSS già esistente)
$this->registerCssFile('@web/css/activity-type-index.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<div class="activity-type-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Activity Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!-- Contenitore con la classe .table-container per applicare box-shadow o altri effetti -->
    <div class="table-container">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'name',
                'description:ntext',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, ActivityType $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                ],
            ],
        ]); ?>
    </div>
</div>