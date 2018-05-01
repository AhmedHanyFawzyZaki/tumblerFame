<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';


	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function init(){
		// set the default theme for any other controller that inherit the admin controller
		Yii::app()->theme = 'bootstrap';
	}




	protected  function beforeAction($action)
	{
		//if the user is not admin redirect to the home page of the normal user



		if( Yii::app()->user->isGuest)
		{
			$this->redirect('dashboard');
		}
		return parent::beforeAction($action);


	}
}