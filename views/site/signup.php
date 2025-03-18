<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Registrazione';
$this->registerCssFile('@web/css/signup.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<section class="signup-page">
    <div class="signup-card">
        <header class="signup-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Entra nell'universo dei Guardiani e inizia la tua avventura interstellare.</p>
        </header>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Nome del Guardiano'])->label(false) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password segreta'])->label(false) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Ripeti la Password'])->label(false) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Registrati', ['class' => 'btn signup-btn', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        <div class="signup-login-link">
            <p>Hai già un'astronave? <?= Html::a('Accedi', ['site/login']) ?></p>
        </div>
    </div>
</section>