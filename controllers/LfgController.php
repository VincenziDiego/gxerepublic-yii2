<?php

namespace app\controllers;

use Yii;
use app\models\Lfg;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use mdm\admin\components\AccessControl;

class LfgController extends Controller
{
    public function behaviors()
    {
        return [
            // Puoi implementare i filtri di accesso per autenticare gli utenti
            'access' => [
                'class' => AccessControl::className(),
            ],
        ];
    }

    public function actionIndex()
    {
        // Recupera tutti gli LFG e chiudi quelli il cui start_time è passato
        $lfgs = Lfg::find()->orderBy(['start_time' => SORT_ASC])->all();
        foreach ($lfgs as $lfg) {
            $lfg->autoClose();
        }

        $query = Lfg::find()->orderBy(['start_time' => SORT_ASC]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate()
    {
        $model = new Lfg();
        if ($model->load(Yii::$app->request->post())) {
            // Imposta il leader come l'utente corrente
            $model->leader_id = Yii::$app->user->id;
            // Imposta il leader come primo giocatore in current_players, se desiderato
            $model->current_players = Yii::$app->user->identity->bungieid;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Lfg::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("LFG non trovato.");
        }
        // Controlla che l'utente possa modificare
        if (!$model->canEdit(Yii::$app->user->id)) {
            throw new \yii\web\ForbiddenHttpException("Non hai il permesso di modificare questo LFG.");
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        return $this->redirect(['index']);
    }

    /**
     * Azione per unirsi a un LFG
     */
    public function actionJoin($id)
    {
        $model = Lfg::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("LFG non trovato.");
        }
        if ($model->status == 0) {
            Yii::$app->session->setFlash('error', 'Questo LFG è chiuso.');
            return $this->redirect(['index', '#' => 'lfg-' . $id]);
        }

        $user = Yii::$app->user->identity;
        if (empty($user->bungieid)) {
            Yii::$app->session->setFlash('error', 'Devi impostare il tuo BungieID per partecipare. Aggiorna il tuo profilo.');
            return $this->redirect(['profile/update']);
        }
        $bungieId = $user->bungieid;

        if ($model->join($bungieId, false)) {
            Yii::$app->session->setFlash('success', 'Ti sei unito al gruppo.');
        } else {
            Yii::$app->session->setFlash('error', 'Impossibile unirti al gruppo.');
        }
        // Redirect all'index con l'anchor alla card specifica
        return $this->redirect(['index', '#' => 'lfg-' . $model->id]);
    }

    /**
     * Azione per unirsi direttamente alle riserve
     */
    public function actionJoinReserve($id)
    {
        $model = Lfg::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("LFG non trovato.");
        }
        if ($model->status == 0) {
            Yii::$app->session->setFlash('error', 'Questo LFG è chiuso.');
            return $this->redirect(['index', '#' => 'lfg-' . $id]);
        }

        $user = Yii::$app->user->identity;
        if (empty($user->bungieid)) {
            Yii::$app->session->setFlash('error', 'Devi impostare il tuo BungieID per partecipare. Aggiorna il tuo profilo.');
            return $this->redirect(['profile/update']);
        }
        $bungieId = $user->bungieid;

        if ($model->join($bungieId, true)) {
            Yii::$app->session->setFlash('success', 'Ti sei unito alle riserve.');
        } else {
            Yii::$app->session->setFlash('error', 'Impossibile unirti alle riserve.');
        }
        return $this->redirect(['index', '#' => 'lfg-' . $model->id]);
    }

    /**
     * Azione per uscire da un LFG
     */
    public function actionLeave($id)
    {
        $model = Lfg::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("LFG non trovato.");
        }

        $user = Yii::$app->user->identity;
        if (empty($user->bungieid)) {
            Yii::$app->session->setFlash('error', 'Devi impostare il tuo BungieID per partecipare. Aggiorna il tuo profilo.');
            return $this->redirect(['profile/update']);
        }
        $bungieId = $user->bungieid;

        if ($model->removePlayer($bungieId)) {
            Yii::$app->session->setFlash('success', 'Sei uscito dal gruppo.');
        } else {
            Yii::$app->session->setFlash('error', 'Impossibile uscire dal gruppo.');
        }
        return $this->redirect(['index', '#' => 'lfg-' . $model->id]);
    }

    /**
     * Azione per spostarsi in riserva
     */
    public function actionReserve($id)
    {
        $model = Lfg::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("LFG non trovato.");
        }
        $bungieId = Yii::$app->user->identity->bungieid;

        // Se l'utente è già unito, passare a riserva; altrimenti, unirsi direttamente in riserva
        if ($model->join($bungieId, true)) {
            Yii::$app->session->setFlash('success', 'Sei stato spostato in riserva.');
        } else {
            Yii::$app->session->setFlash('error', 'Impossibile spostarti in riserva.');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionDelete($id)
    {
        $model = Lfg::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("LFG non trovato.");
        }
        // Controlla i permessi: solo il leader o un admin può eliminare
        if (!$model->canEdit(Yii::$app->user->id)) {
            throw new \yii\web\ForbiddenHttpException("Non hai i permessi per eliminare questo LFG.");
        }
        if ($model->delete() !== false) {
            Yii::$app->session->setFlash('success', 'LFG eliminato correttamente.');
        } else {
            Yii::$app->session->setFlash('error', 'Errore durante l\'eliminazione del LFG.');
        }
        return $this->redirect(['index']);
    }
}
