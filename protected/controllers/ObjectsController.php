<?php

Yii::import('application.models.stats.*');

class ObjectsController extends Controller
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
		$model=new Objects('search');
                $model->unsetAttributes();
                if(isset($_GET['Objects']))
                        $model->attributes=$_GET['Objects'];
                $this->render('index',array(
                        'model'=>$model,
                ));
		
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->render('view', array(
			'obj_model'=>$model,
			'reports_model'=>$this->loadReportsModel($model->obj_id),
		));
	}

	public function actionReports($id)
	{
		$model = $this->loadModel($id);
		$this->render('reports', array(
			'obj_model'=>$model,
			'reports_model'=>$this->loadReportsModel($model->obj_id),
		));
	}

	public function actionAlarms($id, $type=0)
	{
		$model = $this->loadModel($id);
		$this->render('alarms', array(
			'obj_model'=>$model,
			'alarms_model'=>$this->loadAlarmsModel($model->obj_id, $type),
		));
	}

        public function actionUpdate($id, $from='objects')
        {
                $model=$this->loadModel($id);
                if(isset($_POST['Objects']))
                {
                        $model->attributes=$_POST['Objects'];
                        if($model->save())
                            if ($from=='objects')
                            {    $this->redirect(array('view',"id"=>$id));
                            } else {
                                 $this->redirect(array('groups/view',"id" => $model->group_id));
                            }
                }
                $this->render('update',array(
                        'model'=>$model,
                ));
        }

        public function actionCreate()
        {
                $model=new Objects;
                if(isset($_POST['Objects']))
                {
                        $model->attributes=$_POST['Objects'];
                        if($model->save())
						{
							//用于在group view界面创建object时，自动返回到group view界面。
							if(isset($_GET['groupid'])){
								$this->redirect(array('groups/view','id'=>$_GET['groupid']));
								
								} 
							//其它场景直接返回object/index界面
							else {
								$this->redirect(array('index'));
							}
						
						}
                }
				//用于在group view界面创建object时，自动填写grp_id
				if(isset($_GET['groupid'])){
						Yii::log('Create obj, grp_id:'.$_GET['groupid'],'info');
						$model->group_id=$_GET['groupid'];
				}

                $this->render('create',array(
                        'model'=>$model,
                ));
        }

        public function actionChart($id, $span=12) {
                $model = new MonitorChart($id, $span);
                $this->renderJson($model->loadData());
        }


	public function loadModel($id)
	{
		$model = Objects::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404,'The requested page does not exist.');	
		return $model;
	}	

	public function loadReportsModel($id)
	{
		$model = new Reports('search');
		$model->unsetAttributes();
		$model->obj_id = $id;
		if(isset($_GET['Reports']))
		{
			$model->attributes=$_GET['Reports'];
		}
		#$model = Reports('search')::model()->findall("obj_id=:id",array(":id"=>$id));
		if ($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadAlarmsModel($id, $type=0)
	{
		if ($type == 4){
			$params = array(":id"=>$id);
			$model = AlarmStat::model()->findall("obj_id=:id", $params);
		} else {
			$params = array(":id"=>$id, ":type"=>$type);
			$model = AlarmStat::model()->findall("obj_id=:id and type=:type", $params);
		}
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
