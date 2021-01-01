<?php

namespace app\controllers;

use app\components\App;
use app\models\forms\RegistrationForm;
use Yii;
use app\models\entities\Yiiusers;
use app\models\search\UserSearch;
use app\components\web\SecuredController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * UsersController implements the CRUD actions for Yiiusers model.
 */
class UsersController extends Controller
{
    static ?Yiiusers $model = null;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Yiiusers models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (!Yii::$app->user->isGuest) {
            $this->layout = 'main1';
        }
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Yiiusers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        self::$model = $this->findModel($id);

        if (!Yii::$app->user->isGuest && self::$model->id == Yii::$app->user->identity->id) {
            $this->layout = 'main1';
        }
        else{
            $this->layout = 'main2';
        }


        return $this->render('view', [
            'model' => self::$model,
        ]);

    }


    public function actionShow($id)
    {
        self::$model = $this->findModel($id);

        if (!Yii::$app->user->isGuest && self::$model->id == Yii::$app->user->identity->id) {
            $this->layout = 'main1';
        }
        else{
            $this->layout = 'main2';
        }


        return $this->render('view', [
            'model' => self::$model,
        ]);
    }

    /**
     * Creates a new Yiiusers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'main';

        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Yiiusers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'main1';

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Yiiusers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'main1';

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Yiiusers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Yiiusers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

        if (($model = Yiiusers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
