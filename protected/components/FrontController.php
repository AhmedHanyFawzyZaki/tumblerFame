<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function init() {
        $parameters = Settings::model()->findByPk(1);


        Yii::app()->params['google'] = $parameters['google'];
        Yii::app()->params['twitter'] = $parameters['twitter'];
        Yii::app()->params['pinterest'] = $parameters['pinterest'];
        Yii::app()->params['support_email'] = $parameters['support_email'];
        Yii::app()->params['email'] = $parameters['email'];
        Yii::app()->params['facebook'] = $parameters['facebook'];
        Yii::app()->params['facebook'] = $parameters['facebook'];
        Yii::app()->params['paypal_email'] = $parameters['paypal_email'];

        Yii::app()->params['plug_points'] = $parameters['plug_points'];
        Yii::app()->params['follow_points'] = $parameters['follow_points'];
        Yii::app()->params['featured_follow_points'] = $parameters['featured_follow_points'];
        Yii::app()->params['referral_points'] = $parameters['referral_points'];

        Yii::app()->params['replug_period'] = $parameters['replug_period'];
        Yii::app()->params['logo'] = $parameters['image'];
    }

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
            'yiichat' => array('class' => 'YiiChatAction'), // <- ADD THIS LINE
        );
    }

}