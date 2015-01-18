<?php

class GroupsController extends Controller
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
				//这样能够获得所有group信息
                $model=new Groups('search');
                $model->unsetAttributes();
				//TODO:这里是什么意思?
                if(isset($_GET['Groups']))
                        $model->attributes=$_GET['Groups'];
                $this->render('index',array(
                        'model'=>$model,
                ));
	}

        public function actionView($id)
        {
                $model = $this->loadModel($id);
				//$objects_model = Objects::model()->findall("group_id=:id", array(":id"=>$id));
				$objects_model = new Objects('search');
                $objects_model->unsetAttributes();
				$objects_model->group_id=$id;
                if(isset($_GET['Objects']))
                        $objects_model->attributes=$_GET['Objects'];

				if ($objects_model === null)
					throw new CHttpException(404,'The requested page does not exist.');
                $this->render('view', array(
                        'model'=>$model,
                        'objects_model'=>$objects_model,
                ));
        }

        public function actionUpdate($id)
        {
                $model=$this->loadModel($id);
                if(isset($_POST['Groups']))
                {
                        $model->attributes=$_POST['Groups'];
                        if($model->save())
                                $this->redirect(array('index'));
                }
                $this->render('update',array(
                        'model'=>$model,
                ));
        }

        public function actionCreate()
        {
                $model=new Groups;
                if(isset($_POST['Groups']))
                {
                        $model->attributes=$_POST['Groups'];
                        if($model->save())
                                $this->redirect(array('index'));
                }
                $this->render('create',array(
                        'model'=>$model,
                ));
        }

        public function actionDelete($id)
        {
                $this->loadModel($id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

        public function loadModel($id)
        {
                $model = Groups::model()->findByPk($id);
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
