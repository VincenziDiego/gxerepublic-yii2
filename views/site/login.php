<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->registerCssFile('@web/css/login.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<section class="login-page">
    <div class="login-card">
        <header class="login-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Accedi e preparati a difendere il cosmo.</p>
        </header>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="form-group">
            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
                'placeholder' => 'Nome del Guardiano'
            ])->label(false) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput([
                'placeholder' => 'Password segreta'
            ])->label(false) ?>
        </div>
        <div class="form-group remember-me-group">
            <?= $form->field($model, 'rememberMe', [
                'template' => "<div class=\"rememberMe-container\">{input} {label}</div>\n{error}",
                'labelOptions' => ['class' => 'rememberMe-label'],
            ])->checkbox([], false) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn login-btn', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        <div class="login-links">
            <p>
                <a href="<?= \yii\helpers\Url::to(['site/request-password-reset']) ?>">Password dimenticata?</a>
            </p>
            <p>
                Non hai un account? <?= Html::a('Registrati', ['site/signup']) ?>
            </p>
        </div>
    </div>
</section>