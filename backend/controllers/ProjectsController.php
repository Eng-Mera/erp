<?php

namespace backend\controllers;

use app\models\Products;
use Yii;
use app\models\Projects;
use backend\models\search\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProducts($project_id)
    {
        if (!empty($project_id))
        {
            echo $project_id;
            die();
            $products = Products::find()->where(['=','project_id',$project_id])->all();
        }
        $this->redirect('/products');
    }

    /**
     * Displays a single Projects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->logo = UploadedFile::getInstance($model, 'logo');
            if (!empty($model->logo))
            {
                $model->logo->name = $model->logo->baseName . '.' .strtolower(substr(strrchr($model->logo->name,'.'),1));
            }
            $model->logo_mockup = UploadedFile::getInstance($model, 'logo_mockup');
            if (!empty($model->logo_mockup))
            {
                $model->logo_mockup->name = $model->logo_mockup->baseName . '.' .strtolower(substr(strrchr($model->logo_mockup->name,'.'),1));
            }
            if ($model->save())
            {
                if ($model->upload())
                {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->scenario = 'update-image';
        $image = $model->logo;
        $mockup = $model->logo_mockup;
        if ($model->load(Yii::$app->request->post()))
        {
            $instaImg = UploadedFile::getInstance($model, 'logo');
            if (!empty($instaImg))
            {
                $instaImg->name = $instaImg->baseName . '.' .strtolower(substr(strrchr($instaImg->name,'.'),1));
            }
            $instaMockup = UploadedFile::getInstance($model, 'logo_mockup');
            if (!empty($instaMockup))
            {
                $instaMockup->name = $instaMockup->baseName . '.' .strtolower(substr(strrchr($instaMockup->name,'.'),1));
            }

            if (empty($instaImg) and empty($instaMockup))
            {
                $model->logo = $image;
                $model->logo_mockup = $mockup;
                if ($model->save())
                {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            elseif (empty($instaImg) and !empty($instaMockup))
            {
                $model->logo = $image;
                $model->logo_mockup = $instaMockup;
                if ($model->save())
                {
                    $model->upload();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            elseif (!empty($instaImg) and empty($instaMockup))
            {
                $model->logo = $instaImg;
                $model->logo_mockup = $mockup;
                if ($model->save())
                {
                    $model->upload();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else
            {
                $model->logo = $instaImg;
                $model->logo_mockup = $instaMockup;
                if ($model->save())
                {
                    $model->upload();
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
