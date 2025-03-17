<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\ActivityType;
use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;

// Registra jQuery esplicitamente (se non già incluso dal layout)
JqueryAsset::register($this);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="lfg-form">
    <?php $form = ActiveForm::begin(); ?>

    <!-- Dropdown per la categoria -->
    <?= $form->field($model, 'activity_type_id')->dropDownList(
        ArrayHelper::map(ActivityType::find()->all(), 'id', 'name'),
        ['prompt' => 'Seleziona la categoria']
    )->label('Categoria') ?>

    <!-- Dropdown per l'attività, inizialmente vuoto -->
    <?= $form->field($model, 'activity_id')->dropDownList(
        [],
        ['prompt' => 'Seleziona l\'attività']
    )->label('Attività') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <!-- Campo max_players ora è un input testuale, l'utente può modificarlo -->
    <?= $form->field($model, 'max_players')->textInput() ?>

    <?= $form->field($model, 'start_time')->input('datetime-local', [
        'value' => $model->start_time ? date('Y-m-d\TH:i', strtotime($model->start_time)) : '',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crea' : 'Aggiorna', ['class' => $model->isNewRecord ? 'btn btn-success btn-submit' : 'btn btn-primary btn-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    jQuery(document).ready(function () {
        // Quando cambia la categoria, popola il dropdown delle attività
        jQuery('#<?= Html::getInputId($model, 'activity_type_id') ?>').on('change', function () {
            var categoryId = jQuery(this).val();
            var activityDropdown = jQuery('#<?= Html::getInputId($model, 'activity_id') ?>');
            activityDropdown.empty().append(jQuery('<option>').text('Caricamento in corso...').attr('value', ''));
            if (categoryId) {
                jQuery.ajax({
                    url: '<?= Url::to(['lfg/get-activities']) ?>',
                    data: { category_id: categoryId },
                    type: 'GET',
                    success: function (data) {
                        console.log('JSON ricevuto:', data);
                        activityDropdown.empty().append(jQuery('<option>').text('Seleziona l\'attività').attr('value', ''));
                        if (jQuery.isEmptyObject(data)) {
                            activityDropdown.append(jQuery('<option>').text('Nessuna attività disponibile').attr('value', ''));
                        } else {
                            jQuery.each(data, function (key, value) {
                                activityDropdown.append(jQuery('<option>').attr('value', key).text(value));
                            });
                        }
                    },
                    error: function () {
                        activityDropdown.empty().append(jQuery('<option>').text('Errore nel caricamento').attr('value', ''));
                    }
                });
            } else {
                activityDropdown.empty().append(jQuery('<option>').text('Seleziona l\'attività').attr('value', ''));
            }
        });

        // Quando viene selezionata un'attività, imposta automaticamente max_players
        jQuery('#<?= Html::getInputId($model, 'activity_id') ?>').on('change', function () {
            var activityId = jQuery(this).val();
            if (activityId) {
                jQuery.ajax({
                    url: '<?= Url::to(['lfg/get-activity-details']) ?>',
                    data: { activity_id: activityId },
                    type: 'GET',
                    success: function (data) {
                        console.log('Dettagli attività ricevuti:', data);
                        if (data && data.default_players) {
                            jQuery('#<?= Html::getInputId($model, 'max_players') ?>').val(data.default_players);
                        }
                    },
                    error: function () {
                        console.error('Errore nel caricamento dei dettagli dell\'attività');
                    }
                });
            }
        });
    });
</script>