<?php

class HomeController extends FrontController {

    protected function beforeAction($action) {
        if (Yii::app()->user->isGuest && !in_array(strtolower($action->id), array('home', 'page', 'faq', 'contact', 'login'))) {
            $this->redirect('home/home');
        }
        return parent::beforeAction($action);
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewActionM',
            ),
        );
    }

    public function actionFollow() {
        $id = $_POST['id'];
        $username = $_POST['blog'];
        $user = User::model()->findByAttributes(array('id' => $id, 'username' => $username)); //user exists?
        if ($user) {
            $model = User::model()->findByPk(Yii::app()->user->id);
            if (Helper::isFollower($model->id, $user->id)) {
                $response['msg'] = "wrong";
                echo json_encode($response);
            } else {
                $isfeatured = Helper::isFeatured($user->id);
                if ($isfeatured) {
                    $model->today_points+=Yii::app()->params['featured_follow_points'];
                    $model->total_points+=Yii::app()->params['featured_follow_points'];
                } else {
                    $model->today_points+=Yii::app()->params['follow_points'];
                    $model->total_points+=Yii::app()->params['follow_points'];
                    if ($user->total_points > Yii::app()->params['follow_points']) {
                        $user->total_points-=Yii::app()->params['follow_points'];
                        $user->save(false);
                    }
                }
                $model->today_follows+=1;
                $model->total_follows+=1;
                $model->password = $model->simple_decrypt($model->password);
                if ($model->save(false)) {
                    $user_follower = new UserFollower;
                    $user_follower->blog_id = $user->id;
                    $user_follower->follower_id = $model->id;
                    if ($user_follower->save(false)) {
                        $response['msg'] = 'done';
                        $response['follows'] = $model->total_follows;
                        $response['points'] = $model->total_points;
                        $response['over_all_follows'] = Helper::TotalFollowers();
                        $response['today_over_al_follows'] = Helper::TodayFollowers();
                        echo json_encode($response);
                    }
                }
            }
        } else {
            $response['msg'] = "Anti (Hacking & Spamming) Alert, Please Dont't Try This Again!";
            echo json_encode($response);
        }
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionAddPlug() {
        $content = $_POST['content'];
        $user = User::model()->findByPk(Yii::app()->user->id);
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . $user->id;
        $criteria->order = "id desc";
        $plug = Plug::model()->find($criteria); //now-plugtime > settings period
        if ($plug) {
            $plug_time = $plug->plug_time;
            $replug_period = Yii::app()->params['replug_period'] * 60;
            $diff = strtotime(date("d-m-Y h:i:s")) - strtotime($plug_time);
            if ($replug_period <= $diff) {
                if ($user->total_points > 0) {
                    $plug = new Plug;
                    $plug->user_id = $user->id;
                    $plug->content = $content;
                    $plug->plug_time = date("d-m-Y h:i:s");
                    if ($plug->save(false)) {
                        $user->total_points-=Yii::app()->params['plug_points'];
                        $user->plugs+=1;
                        $user->password = $user->simple_decrypt($user->password);
                        if ($user->save(false)) {
                            $response['msg'] = 'done';
                            $response['total_points'] = $user->total_points;
                            $response['plugs'] = $user->plugs;
                        }
                    }
                } else {
                    $response['msg'] = "Sorry! You Don't Have Enough Points To Plug You Tumblr Blog.";
                }
            } else {
                $wait = round(($replug_period - ($diff)) / 60);
                $response['msg'] = "Sorry! You Have To Wait About (" . $wait . " min.) To Replug.";
            }
        } else {
            if ($user->total_points > 0) {
                $plug = new Plug;
                $plug->user_id = $user->id;
                $plug->content = $content;
                $plug->plug_time = date("d-m-Y h:i:s");
                if ($plug->save(false)) {
                    $user->total_points-=Yii::app()->params['plug_points'];
                    $user->plugs+=1;
                    $user->password = $user->simple_decrypt($user->password);
                    if ($user->save(false)) {
                        $response['msg'] = 'done';
                        $response['total_points'] = $user->total_points;
                        $response['plugs'] = $user->plugs;
                    }
                }
            } else {
                $response['msg'] = "Sorry! You Don't Have Enough Points To Plug.";
            }
        }
        echo json_encode($response);
    }

    public function actionUpdatePlugs() {
        echo Plug::ListPlugs();
    }

    public function actionIndex() {
        $meta = Seo::model()->findByPk(1);
        Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
        Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
        Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
        //loadPage();
        $featured_users = User::getFeatured();
        $top_ten_users = User::getTop(10); //limit=10
        $active = User::getActive(30); //limit=30
        if (isset($_GET['ref']) && $_GET['ref'] != '') {
            $ref = User::model()->find(array('condition' => 'username="' . $_GET['ref'] . '"'));
            if ($ref->id == Yii::app()->user->id) {
                Yii::app()->user->setFlash('wrong', "Users Can't Refer To Themselves, Users Can Only Refer Each Others");
            } else {
                User::Referral(Yii::app()->user->id, $ref->id);
            }
        }
        $this->render('index', array('featured_users' => $featured_users, 'top_ten_users' => $top_ten_users, 'active_users' => $active));
    }

    public function actionHome() {
        $meta = Seo::model()->findByPk(11);
        Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
        Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
        Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
        //loadPage();
        $this->layout = 'nolayout'; //no layout is render
        $this->render('home');
    }

    public function actionTopUsers() {
        //loadPage();
        $meta = Seo::model()->findByPk(2);
        Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
        Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
        Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
        $top_ten_users = User::getTop(50); //limit=50
        $this->render('top', array('top_ten_users' => $top_ten_users));
    }

    public function actionHallOfFame() {
        $meta = Seo::model()->findByPk(5);
        Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
        Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
        Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
        //loadPage();
        $top_ten_users = User::getFame(50); //limit=10
        $this->render('fame', array('top_ten_users' => $top_ten_users));
    }

    public function actionGetFeatured() {
        $meta = Seo::model()->findByPk(4);
        Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
        Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
        Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
        $packages = Package::model()->findAll();
        $this->render('featured', array('packages' => $packages));
    }

    public function actionPage() {
        //echo 'dd';die;
        $slug = $_REQUEST['slug'];
        $page = Pages::model()->find(array('condition' => 'url="' . $slug . '"'));
        switch ($page->id) {
            case 1:
                $meta = Seo::model()->findByPk(3);
                Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
                Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
                Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
                break;
            case 2:
                $meta = Seo::model()->findByPk(6);
                Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
                Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
                Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
                break;
            case 3:
                $meta = Seo::model()->findByPk(8);
                Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
                Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
                Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
                break;
            case 4:
                $meta = Seo::model()->findByPk(10);
                Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
                Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
                Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
                break;
            default :
                $meta = Seo::model()->findByPk(1);
                Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
                Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
                Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
                break;
        }
        $this->render('staticpage', array('pages' => $page));
    }

    public function actionSend() {
        $mail = new YiiMailer();
        //$mail->clearLayout();//if layout is already set in config
        $mail->setFrom($_POST['email'], $_POST['name']);
        //$mail->setTo(Yii::app()->params['adminEmail']);

        $mail->setTo(Yii::app()->params['adminEmail']);
        $mail->setSubject('Contact Me "Phone no.: (' . $_POST['phone'] . ')"');
        $mail->setBody($_POST['message']);

        if ($mail->send()) {
            Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
            $this->redirect(Yii::app()->request->baseUrl . '/home/contact#done');
        } else {
            Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
        }
        //send attachements
        /*
          $mail->setAttachment('something.pdf');
          $mail->setAttachment(array('something.pdf','something_else.pdf','another.doc'));
          $mail->setAttachment(array('something.pdf'=>'Some file','something_else.pdf'=>'Another file'));

         */
    }

    public function actionFaq() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $meta = Seo::model()->findByPk(9);
        Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
        Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
        Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
        $model = Faq::model()->findAll();
        $this->render('faq', array('faqs' => $model,));
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $meta = Seo::model()->findByPk(7);
        Yii::app()->clientScript->registerMetaTag($meta->meta_description, 'description');
        Yii::app()->clientScript->registerMetaTag($meta->meta_author, 'author');
        Yii::app()->clientScript->registerMetaTag($meta->meta_tags, 'keywords');
        $this->render('contact');
    }

    public function actionLogin() {
        $username = $_POST['username'];
        $avatar = $_POST['avatar'];
        if (isset($username) && isset($avatar)) {
            $model = User::model()->findByAttributes(array('username' => $username));
            if (!$model) {
                $model = new User;
                $model->username = $username;
                $model->groups_id = 1;
            }
            $model->image = $avatar;
            $model->save(false);
            Yii::app()->user->id = $model->id;
            Yii::app()->user->setState('group', 1);
            if (isset($_GET['ref'])) {
                $this->redirect(Yii::app()->request->baseUrl . '/home/index?ref=' . $_GET['ref']);
            } else {
                $this->redirect(Yii::app()->request->baseUrl . '/home/index');
            }
            //echo $model->id;
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /* ----  load dynamic pages ------- */

    public function loadPage($id) {
        $model = Pages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    ///////// paypal actions

    public function actionCheckout() {
        $pack_id = $_POST['id'];
        $user_id = Yii::app()->user->id;

        $package = Package::model()->findByPk($pack_id);
        $user = User::model()->findByPk($user_id);

        $model = new Order();
        if ($package && $user) {
            $paymentInfo['Order']['theTotal'] = $package->price;
            $paymentInfo['Order']['description'] = 'Tumblr Fame Payment';
            $paymentInfo['Order']['quantity'] = '1';
            // call paypal



            $result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
            //var_dump($result);die;
            if (!Yii::app()->Paypal->isCallSucceeded($result)) {
                if (Yii::app()->Paypal->apiLive === true) {
                    //Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                } else {
                    //Sandbox output the actual error message to dive in.
                    $error = $result['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            } else {
                // send user to paypal
                $token = urldecode($result["TOKEN"]);

                $model->token = $token;
                $model->package_id = $package->id;
                $model->user_id = $user->id;
                $model->price = $package->price;
                $model->order_time = date('Y-m-d H:i');
                $model->status_id = '1';
                $model->save(false);

                //$model->token= $token;
                //$model->d_date=date('Y-m-d H:i:s');
                //$model->email=$email;
                //	$model->save(false);//// saving the order
                $payPalURL = Yii::app()->Paypal->paypalUrl . $token . '&Order=' . $model->id;
            }
            $this->redirect($payPalURL);
        }
    }

    public function actionConfirm() {
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
        $criteria = new CDbCriteria;
        $criteria->condition = 'token=:Tokenw';
        $criteria->params = array(':Tokenw' => $token);
        $orders = Order::model()->find($criteria);
        $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;
        $result['ORDERTOTAL'] = $orders->price;
        if (!Yii::app()->Paypal->isCallSucceeded($result)) {
            if (Yii::app()->Paypal->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {
            $paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
            //Detect errors
            if (!Yii::app()->Paypal->isCallSucceeded($paymentResult)) {
                if (Yii::app()->Paypal->apiLive === true) {
                    //Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                } else {
                    //Sandbox output the actual error message to dive in.
                    $error = $paymentResult['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            } else {
                //payment was completed successfully
                if ($orders->status_id == '1') {
                    $orders->status_id = '2';
                    if ($orders->save(false)) {
                        $user = User::model()->findByPk($orders->user_id);
                        $package = Package::model()->findByPk($orders->package_id);

                        if ($user->featured_time == '0') {
                            $new_time = ($package->valid_for * 60 * 60 * 24) + strtotime(date('d-m-Y'));
                        } else {
                            $new_time = ($package->valid_for * 60 * 60 * 24) + strtotime($user->featured_time);
                        }
                        $user->featured_time = date('d-m-Y', $new_time);
                        $user->user_credit+=$orders->price;
                        $user->password = $user->simple_decrypt($user->password);
                        $user->save(false);
                    }
                }
                $this->render('confirm');
            }
        }
    }

    public function actionCancel() {
        //The token of the cancelled payment typically used to cancel the payment within your application
        $token = trim($_GET['token']);
        //	$payerId = trim($_GET['PayerID']);


        $criteria = new CDbCriteria;
        $criteria->condition = 'token=:Tokenw';
        $criteria->params = array(':Tokenw' => $token);

        $orders = Order::model()->find($criteria);
        if ($orders->status_id == '1') {
            $orders->status_id = '3';
            $orders->save(false);

            // need to clear cart
            //Yii::app()->shoppingCart->clear();
        }

        $this->render('cancel');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}