<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\User;
use yii\web\UploadedFile;
use mdm\admin\components\AccessControl;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            // Solo gli utenti autenticati possono accedere alle azioni di questo controller
            'access' => [
                'class' => AccessControl::className(),
            ],
        ];
    }

    /**
     * Mostra e aggiorna il profilo dell'utente loggato.
     */
    public function actionUpdate()
    {
        $model = User::findOne(Yii::$app->user->id);
        if (!$model) {
            throw new NotFoundHttpException("Utente non trovato.");
        }

        if ($model->load(Yii::$app->request->post())) {
            // Ottieni il file caricato per l'icona
            $iconFile = \yii\web\UploadedFile::getInstance($model, 'iconFile');
            if ($iconFile !== null) {
                // Verifica che il file temporaneo esista
                if (!file_exists($iconFile->tempName)) {
                    Yii::error("Il file temporaneo non esiste: " . $iconFile->tempName);
                } else {
                    $uploadPath = 'uploads/icons/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                    // Genera un nome univoco per il nuovo file
                    $newFilePath = $uploadPath . uniqid() . '.' . $iconFile->extension;
                    if ($iconFile->saveAs($newFilePath)) {
                        // Se l'utente ha già un'icona e non è quella di default, la cancella
                        if (!empty($model->icon_url) && stripos(basename($model->icon_url), 'default') === false && file_exists($model->icon_url)) {
                            @unlink($model->icon_url);
                        }
                        $model->icon_url = $newFilePath;
                        Yii::info("Nuovo file salvato correttamente in: " . $newFilePath);
                    } else {
                        Yii::error("Errore durante il salvataggio del file: " . $newFilePath);
                    }
                }
            } else {
                Yii::info("Nessun file caricato per iconFile.");
            }

            if ($model->save()) {
                $model->refresh();
                Yii::$app->user->setIdentity($model);
                Yii::$app->session->setFlash('success', 'Profilo aggiornato correttamente.');
                return $this->redirect(['update']);
            } else {
                Yii::error("Errore nel salvataggio del modello: " . json_encode($model->errors));
                var_dump($model->errors);
                exit;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
