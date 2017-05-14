<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
	
	
    public function actionIndex()
    {
    	$this->view->title = 'Admin - Dashboard';
    	$this->layout = 'admin';
    	return $this->render('dashboard');
    }
    public function actionDashboard()
    {
    	$this->view->title = 'Admin - Dashboard';
    	$this->layout = 'admin';
    	return $this->render('dashboard');
    }
}
