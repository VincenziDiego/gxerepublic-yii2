<?php

namespace app\controllers;

use Yii;
use app\models\Lfg;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;

class LfgController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                ],
            ]
        );
    }

    public function actionIndex()
    {
        // Recupera tutti gli LFG e applica autoClose ad ognuno
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

            // Se è stata selezionata un'attività, recupera il record e imposta il titolo (activity_type) come il nome dell'attività
            if ($model->activity_id) {
                $activity = \app\models\Activity::findOne($model->activity_id);
                if ($activity) {
                    $model->activity_type = $activity->name;
                    // Se max_players non è stato modificato manualmente, imposta il valore predefinito dall'attività
                    if (empty($model->max_players)) {
                        $model->max_players = $activity->default_players;
                    }
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::error("Errore nel salvataggio del modello: " . json_encode($model->errors), __METHOD__);
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

    public function actionGetActivities($category_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $activities = \app\models\Activity::find()->where(['activity_type_id' => $category_id])->all();
        return \yii\helpers\ArrayHelper::map($activities, 'id', 'name');
    }

    public function actionGetActivityDetails($activity_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $activity = \app\models\Activity::findOne($activity_id);
        if ($activity) {
            return [
                'default_players' => $activity->default_players,
                'name' => $activity->name,
            ];
        }
        return [];
    }
}


