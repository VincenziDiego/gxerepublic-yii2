<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Aggiorna Profilo';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/profile-update.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<section class="profile-update">
    <header class="profile-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Modifica le tue informazioni personali per prepararti alla prossima missione.</p>
    </header>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <article class="profile-form">
        <!-- Campo per l'upload dell'icona -->
        <div class="upload-container">
            <label for="icon-upload" class="upload-label">Carica icona</label>
            <?= Html::activeFileInput($model, 'iconFile', ['id' => 'icon-upload']) ?>
            <div class="upload-preview-container">
                <p>Anteprima icona:</p>
                <img id="icon-preview"
                    src="<?= !empty($model->icon_url) ? Yii::getAlias('@web/' . $model->icon_url) : '' ?>"
                    alt="Icona Profilo" class="upload-preview">
            </div>
        </div>

        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Nome del Guardiano']) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email']) ?>
        <?= $form->field($model, 'bungieid')->textInput(['placeholder' => 'Bungie ID'])->label('Bungie ID') ?>
        <?= $form->field($model, 'clan')->textInput(['placeholder' => 'Nome del Clan']) ?>

        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>
    </article>
    <?php ActiveForm::end(); ?>
</section>

<!-- Script per l'anteprima in tempo reale -->
<script>
    document.getElementById('icon-upload').addEventListener('change', function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('icon-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>