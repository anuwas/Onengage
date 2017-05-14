<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Administrator;
use app\models\AdministratorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

/**
 * AdministratorController implements the CRUD actions for Administrator model.
 */
class AdministratorController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Administrator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdministratorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Administrator model.
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
     * Creates a new Administrator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Administrator();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->administratorid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Administrator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->administratorid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Administrator model.
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
     * Finds the Administrator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Administrator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Administrator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLogin()
    {
    	$this->view->title = 'Admin - Login';
    	$this->layout = 'adminLogin';
    	$model = new Administrator();
    	
    	if ($model->load(Yii::$app->request->post())) {
    		$admin=Administrator::findOne(['email' => $model->email,'password' => $model->password,'active'=>'1']);
    		if($admin){
    			$session = new Session();
    			$session->open();
    			$session['administrator']=$admin;
    			
    			return $this->redirect(['/admin']);
    		}else{
    			$msg='Invalid';
    			return $this->render('login', ['model' => $model,'msg'=>$msg]);
    		}
    		
    	} else {
    		return $this->render('login', ['model' => $model,]);
    	}
    			
    	    	
    }
    
    public function actionLogout(){
    	$session = new Session();
    	$session->open();
    	$session['administrator']='';
    	return $this->redirect(['/admin/administrator/login']);
    }
    
    public function actionEditprofile($id){
    	$msg='';
    	$this->view->title = 'Admin - Login';
    	$this->layout = 'admin';
    	$model = $this->findModel($id);
    	if ($model->load(Yii::$app->request->post()))
    	{
    		$data=Yii::$app->request->post();
    		
    		if($model->password!=$data['Administrator']['oldpassword']){
    			$msg='Password Incorrct';
    		}else if($data['Administrator']['newpassword']!=$data['Administrator']['confirmpassword'])
    		{
    			$msg='New Password and Confirm Password not same';
    		}else{
    			$model->password=$data['Administrator']['newpassword'];
    			$model->save();
    			echo $msg='Successfully Updated!';
    			
    		}
    		return $this->render('editProfile', ['model' => $model,'msg'=>$msg]);
    	}else{
    		return $this->render('editProfile', ['model' => $model,'msg'=>$msg]);
    	}
    	
    }
}
