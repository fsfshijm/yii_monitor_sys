<?php

class CheckerController extends Controller
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

	public function actionIndex($obj_id)
	{

		$obj_model=Objects::model()->findByPk($obj_id);

		Yii::log('obj_model:'.CVarDumper::dumpAsString($obj_model),'info');

		$this->render('index', array(
			'obj_id' => $obj_id,
			'group_id'=>$obj_model->group_id,
			'model' => $this->loadCheckerModel($obj_id),
		));
	}

	public function loadCheckerModel($obj_id)
	{	
		$model = Checker::model()->findall("obj_id=:id", array(":id"=>$obj_id));
		if ($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

        public function actionUpdate($id, $obj_id)
        {
                $model=$this->loadModel($id);
                if(isset($_POST['Checker']))
                {
                        $model->attributes=$_POST['Checker'];
			if ($model->is_running == 0){$model->status = 'Stoped';}
                        if($model->save())
                                $this->redirect(array('index', 'obj_id'=>$obj_id));
                }
                $this->render('update',array(
                        'model'=>$model,
                        'obj_id'=>$obj_id,
                ));
        }

        public function actionCreate($obj_id)
        {
                $model=new Checker;
                if(isset($_POST['Checker']))
                {
                        $model->attributes=$_POST['Checker'];
			$model->obj_id = $obj_id;
			if ($model->is_running == 0){$model->status = 'Stoped';}
                        if($model->save())
                                $this->redirect(array('index', 'obj_id'=>$obj_id));
                }
                $this->render('create',array(
                        'model'=>$model,
			'obj_id'=>$obj_id,
                ));
        }

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}


        public function loadModel($id)
        {
                $model = Checker::model()->findByPk($id);
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
