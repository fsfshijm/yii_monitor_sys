<?php

Yii::import('application.models.stats.*');

class AlarmStatController extends Controller
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

	public function actionIndex($type=0)
	{
		#$dataProvider=new CActiveDataProvider('AlarmStat');	
		#$this->render('index', array('dataProvider'=>$dataProvider, 'model'=>AlarmStat::model()));
		$model=new AlarmStat('search');
		$model->unsetAttributes();
		if(isset($_GET['AlarmStat']))
			$model->attributes=$_GET['AlarmStat'];
		if($type == 0){
			$model->type = 0;
		}else if ($type == 3){
			$model->type = 3;
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
		#var_dump($_POST)
		if(isset($_POST['AlarmStat']))
		{
			$model->attributes=$_POST['AlarmStat'];
			$ids = array($model->obj_id);
			if($model->save())
				$update = new ObjStatusUpdate($ids);
				$update->execute();
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionModify($ids){
		$this->render('modify', array('ids' => $ids));
	}

        public function actionBatch() 
	{
		$ids = explode(',', $_POST['ids']);
                $criteria = new CDbCriteria;
                $criteria->addInCondition('id', $ids);
		if(isset($_POST['alarm_type']))
		{
			$attributes = array('type'=>$_POST['alarm_type'], 'reason'=>$_POST['alarm_reason'],'event_id'=>$_POST['alarm_event_id']);
                	if (AlarmStat::model()->updateAll($attributes, $criteria)){
				$model = $this->loadModel($ids[0]);
				$obj_ids = array($model->obj_id);
				$update = new ObjStatusUpdate($obj_ids);
				$update->execute();
				$this->redirect(array('index'));
			} else {
				throw new CHttpException(500,'update failed.');
			}
		}else {
			throw new CHttpException(500,'no data, update failed.');
		}
		
        }


	public function loadModel($id)
	{
		$model = AlarmStat::model()->findByPk($id);
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
			'accessControl',
			'postOnly + delete',
			#'inlineFilterName',
			#array(
			#	'class'=>'path.to.FilterClass',
			#	'propertyName'=>'propertyValue',
			#),
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'), 
			)
		);
	}
*/
	/*
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
