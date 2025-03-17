<?php
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/public-news.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<section class="news-public container mt-4">
    <header class="news-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'news-item mb-4'],
        // Il file parziale _news_item.php riceverà automaticamente il modello in $model
        'itemView' => '_news_item',
        'layout' => "{items}\n<div class='d-flex justify-content-center'>{pager}</div>",
    ]) ?>
</section>