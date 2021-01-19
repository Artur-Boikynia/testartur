<?php

namespace app\controllers;

use app\components\App;
use app\components\EditPhoto;
use app\components\getCurrentUserTrait;
use app\exceptions\NotFoundException;
use app\models\entities\ExperienceEntities;
use app\models\forms\AddPhotos;
use app\models\forms\RegistrationForm;
use Yii;
use app\models\entities\Yiiusers;
use app\models\search\UserSearch;
use app\components\web\SecuredController;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use app\models\forms\AddSkill;
use app\components\EditSkill;

/**
 * UsersController implements the CRUD actions for Yiiusers model.
 */
class UsersController extends Controller
{
    use getCurrentUserTrait;

    static ?Yiiusers $model = null;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
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
    public function actionView(int $id)
    {

        self::$model = $this->findModel($id);
        $this->setCurrentUser($id);

        if (self::$model->id !== Yii::$app->user->identity->id) {
            $this->layout = 'main2';
        }

        $photosModel = new AddPhotos();
        $photosModel->user_id = self::$model->id;

        if($this->request->isPost){
            $photosModel->imageFiles = UploadedFile::getInstances($photosModel,'imageFiles');
            $photosModel->upload();
        }

        return $this->render('view', [
            'model' => self::$model,
            'photosModel' => $photosModel,
        ]);

    }

    public function actionGallery(int $id){

        self::$model = $this->findModel($id);
        $this->setCurrentUser($id);

        if (self::$model->id !== Yii::$app->user->identity->id) {
            $this->layout = 'main2';
        }

        $photosModel = new AddPhotos();
        $photosModel->user_id = self::$model->id;

        if($this->request->isPost){
            $photosModel->imageFiles = UploadedFile::getInstances($photosModel,'imageFiles');
            $photosModel->upload();
        }

        return $this->render('gallery', [
            'model' => self::$model,
            'photosModel' => $photosModel,
        ]);

    }

    public function actionDeletePhoto(int $id, bool $delete = false, ?string $path = null)
    {
//        self::$model = $this->findModel($id);

        if($delete && $path !== null){
            $photo = new EditPhoto($id);
            $photo->delete($path);
        }

        return $this->redirect("gallery?id={$id}");
    }

    public function actionMainPhoto(int $id, bool $set = false, ?string $path = null)
    {

        if($set && $path !== null){
            $photo = new EditPhoto($id);
            $photo->setMain($path);
        }

        return $this->redirect("gallery?id={$id}");
    }

    public function actionRemoveMain (int $id, bool $remove = false, ?string $path = null){

        if($remove && $path !== null){
            $photo = new EditPhoto($id);
            $photo->removeMain($path);
        }

        return $this->redirect("gallery?id={$id}");

    }

    public function actionDeleteSkill (int $id, bool $delete = false, ?string $skill_id = null){

        if($delete && $skill_id !== null){
            $skill = new EditSkill($id);
            $skill->remove($skill_id);
        }

        return $this->redirect("skills?id={$id}");

    }

    public function actionUpdateExperience (int $id, bool $update = false, ?int $experienceId = null){

        self::$model = $this->findModel($id);

        if (self::$model->id !== Yii::$app->user->identity->id) {
            $this->layout = 'main2';
        }

        if(!$update && $experienceId === null){
            throw new NotFoundException(Yii::t('app', 'Parameters was not passed'));
        }

        $modelExperience  = $this->findExperienceModel($experienceId, false) ;

        if ($modelExperience->load(Yii::$app->request->post()) && $modelExperience->save()) {
            return $this->redirect(['experience', 'id' => $id]);
        }

        return $this->render('updateExperience', [
            'model' => $modelExperience,
        ]);

    }

    public function actionDeleteExperience (int $id, bool $delete = false, ?int $experienceId = null){

        self::$model = $this->findModel($id);

        if (self::$model->id !== Yii::$app->user->identity->id) {
            $this->layout = 'main2';
        }

        if(!$delete && $experienceId === null){
            throw new NotFoundException(Yii::t('app', 'Parameters was not passed'));
        }

        $modelExperience  = $this->findExperienceModel($experienceId, false)->delete() ;


            return $this->redirect(['experience', 'id' => $id]);




//        $this->findModel($id)->delete();

//        return $this->redirect(['index']);


        /*return $this->render('updateExperience', [
            'model' => $modelExperience,
        ]);*/
    }

    /**
     * Creates a new Yiiusers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

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
        $this->layout = 'main';

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionImage (string $url)
    {
        $this->response->format = Response::FORMAT_RAW;
        $this->response->stream = fopen($url, 'rb');

        if(!is_resource($this->response->stream)){
            throw new NotFoundException(Yii::t('app', 'File {url} was not opened', ['url' => basename($url)]));
        }

        $this->response->send();

    }

    public function actionSkills(int $id){

        self::$model = $this->findModel($id);
        $this->setCurrentUser($id);

        if (self::$model->id !== Yii::$app->user->identity->id) {
            $this->layout = 'main2';
        }

        $skill = new AddSkill();
        $skill->user_id = self::$model->id;

        if($this->request->isPost){
            $post = $this->request->post();
            $skill->setSkill($post['AddSkill']['addYourSkill']);
        }


        return $this->render('skills', [
            'model' => self::$model,
            'skillsModel' => $skill,
        ]);

    }

    public function actionExperience(int $id){

        self::$model = $this->findModel($id);
        $this->setCurrentUser($id);
        $query = $this->findExperienceModel($id);

        if (self::$model->id !== Yii::$app->user->identity->id) {
            $this->layout = 'main2';
        }

        $experience = new ExperienceEntities();
        $experience->user_id = self::$model->id;

        if($this->request->isPost){
            $lol = Yii::$app->request->post();
            $experience->load($lol);
            $experience->save();
        }

//        $skill = new AddSkill();
        /*if($this->request->isPost){
            $post = $this->request->post();
            $post = $this->request->post();
            $skill->setSkill($post['AddSkill']['addYourSkill']);
        }*/


        return $this->render('experience', [
            'model' => self::$model,
            'experience' => $experience,
            'query' => $query
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

        throw new NotFoundHttpException(Yii::t('app', 'The model does not exist.'));
    }

    /**
     * @param $id
     * @param bool $quantity       if $quantity = true, will be use functionExperienceEntities::findAll()
     *                             if $quantity = false, will be use functionExperienceEntities::findOne()
     * @return ExperienceEntities|ExperienceEntities[]|null
     * @throws NotFoundHttpException
     */
    protected function findExperienceModel($id, bool $quantity =  true)
    {
        if($quantity){
            if (($model = ExperienceEntities::findAll(['user_id' => $id])) !== null) {
                return $model;
            }
        }

        if (($model = ExperienceEntities::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The model does not exist.'));
    }
}
