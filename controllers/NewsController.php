<?php

namespace app\controllers;

use app\models\News;
use app\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mdm\admin\components\AccessControl;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritDoc
     */
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

    /**
     * Lists all News models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new News();

        if ($this->request->isPost) {
            // Assegna l'autore corrente prima del caricamento dei dati
            $model->author_id = \Yii::$app->user->id;
            $model->author_username = \Yii::$app->user->identity->username;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Verifica: l'autore della notizia deve essere l'utente loggato,
        // oppure l'utente deve avere il permesso/ruolo "admin"
        if ($model->author_id !== \Yii::$app->user->id && !\Yii::$app->user->can('admin')) {
            throw new \yii\web\ForbiddenHttpException("Non hai i permessi per modificare questa notizia.");
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // Controllo dei permessi per la cancellazione
        if ($model->author_id !== \Yii::$app->user->id && !\Yii::$app->user->can('admin')) {
            throw new \yii\web\ForbiddenHttpException("Non hai i permessi per eliminare questa notizia.");
        }

        $model->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPublic()
    {
        // Recupera solo le news pubblicate (status = 1)
        $query = News::find()->where(['status' => 1])->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, // modifica in base alle tue esigenze
            ],
        ]);

        return $this->render('public', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRead($id)
    {
        $model = $this->findModel($id);

        // Assicurati che la news sia pubblicata, altrimenti puoi mostrare un errore o redirigere
        if ($model->status != 1) {
            throw new NotFoundHttpException('La notizia non esiste o non è pubblicata.');
        }

        return $this->render('read', [
            'model' => $model,
        ]);
    }
}
