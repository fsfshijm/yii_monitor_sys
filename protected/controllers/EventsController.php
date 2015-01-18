<?php

class EventsController extends Controller
{

	public $layout='//layouts/main';

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
	    return array(
	            array('allow',  // allow all users to perform 'index' and 'view' actions
	                'users'=>array('@'),
	                 ),
	            array('deny',  // deny all users
	                'users'=>array('*'),
	                 ),
	            );
	}

	public function actionIndex()
	{
		#$dataProvider=new CActiveDataProvider('Events');
		#$this->render('index', array('dataProvider'=>$dataProvider));
		$model=new Events('search');
		$model->unsetAttributes();
		if(isset($_GET['Events']))
		{
			$model->attributes=$_GET['Events'];
		}
		else if (isset($_GET['obj_id'])){
			$model->obj_id=$_GET['obj_id'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionView($id)
	{
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Events']))
		{
			$model->attributes=$_POST['Events'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->event_id));
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionCreate()
	{
		$model=new Events;

		if(isset($_GET['obj_id'])){
			$obj_model = Objects::model()->findByPk($_GET['obj_id']); 
			$model->obj_id = $obj_model->obj_id;
			$model->group_id = $obj_model->group_id;
		}

		if(isset($_POST['Events']))
		{
			$model->attributes=$_POST['Events'];
			if($model->save())
			{
				if (isset($_GET['obj_id'])){
						$this->redirect(array('events/index','obj_id'=>$_GET['obj_id']));
					}

				else {
						$this->redirect(array('view','id'=>$model->event_id));
					}
				
				}
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model = Events::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
