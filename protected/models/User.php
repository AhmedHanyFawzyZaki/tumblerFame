<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $fname
 * @property string $lname
 * @property string $image
 * @property string $details
 * @property integer $group
 * @property integer $active
 * @property integer $user_credit
 *
 * The followings are the available model relations:
 * @property UserDetails $userDetails
 */
class User extends CActiveRecord {

    public $password_repeat;
    public $verifyCode;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username', 'unique'),
            array('email', 'email'),
            array('username', 'length', 'max' => 255),
            array('email, fname, lname, image', 'length', 'max' => 255),
            array('password', 'length', 'max' => 90),
            array('details,groups_id,user_credit, today_points, total_points, featured_time', 'safe'),
            array('username', 'required', 'on' => 'create ,update'),
            array('details', 'safe', 'on' => 'create'),
            // The following rule is used by search().
            array(' username, email, password, fname, lname, image, details, groups_id, active', 'safe', 'on' => 'search'),
            //array('password, password_repeat', 'safe','on'=>'register'),
            //array('email,password,password_repeat,groups_id','required' ,'on'=>'register'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => 'register'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'register'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'usergroup' => array(self::BELONGS_TO, 'Groups', 'groups_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'fname' => 'First name',
            'lname' => 'Last name',
            'image' => 'Image',
            'details' => 'Details',
            'groups_id' => 'Account Type',
            'active' => 'User Status',
            'user_credit' => 'Total Payments',
            'password_repeat' => 'Repeat password',
            'verifyCode' => 'Verification Code',
            'total_points' => 'Total Earned Points',
            'today_points' => 'Points Earned Today',
            'featured_time' => 'Featured End Time',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('fname', $this->fname, true);
        $criteria->compare('lname', $this->lname, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('groups_id', $this->groups_id, true);

        $criteria->compare('active', $this->active);
        //	$criteria->compare('user_credit',$this->user_credit);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            $this->password = $this->hash($this->password);
            if ($this->featured_time) {
                $this->featured_time = strtotime($this->featured_time);
            }
            return true;
        }
        return false;
    }

    protected function afterFind() {
        if ($this->featured_time) {
            $this->featured_time = date('d-m-Y', $this->featured_time);
        }
        return true;
    }

    // Authentication methods
    public function hash($value) {
        return $this->simple_encrypt($value);
    }

    public static function simple_encrypt($text, $salt = "Ukprosol") {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    function simple_decrypt($text, $salt = "Ukprosol") {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

    public function check($value) {
        $new_hash = $this->simple_encrypt($value);
        if ($new_hash == $this->password) {
            return true;
        }
        return false;
    }

    public static function getProfileType() {
        if (Yii::app()->user->group == 1 or Yii::app()->user->group == 0) {
            return 'member';
        } else if (Yii::app()->user->group == 6) {
            return 'dashboard';
        } else {
            return '#';
        }
    }

    public static function CheckAdmin() {
        if (( Yii::app()->user->isGuest)) {
            return false;
        } else if (Yii::app()->user->group == 6) {
            return true;
        } else {
            return false;
        }
    }

// used for multiple users level
    public static function CheckPermission($type) {
        if (( Yii::app()->user->isGuest)) {
            return false;
        }

        switch ($type) {
            case 'member':
                if (Yii::app()->user->group == 1)
                    return true;
                break;

            default:
                return false;
        } // switch
    }

    public static function getFeatured() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'id !=' . Yii::app()->user->id;
        $criteria->addcondition('groups_id != 6');
        $criteria->addcondition('featured_time >= "' . strtotime(date('d-m-Y')) . '"');
        $users = User::model()->findAll($criteria);
        if ($users) {
            return $users;
        } else {
            /* $criteria=new CDbCriteria;
              $criteria->condition='id !='.Yii::app()->user->id;
              $criteria->addcondition('groups_id != 6');
              $criteria->order='id RAND()';
              $criteria->limit=10;
              $users=User::model()->findAll($criteria);
              return $users; */
            return 0;
        }
    }

    public static function getTop($limit) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'id !=' . Yii::app()->user->id;
        $criteria->addcondition('groups_id != 6');
        //$criteria->addcondition('featured_time < "'.strtotime(date('d-m-Y')).'" or featured_time="0"');
        $criteria->order = 'today_points desc';
        if ($limit) {
            $criteria->limit = $limit;
        }
        $users = User::model()->findAll($criteria);
        return $users;
    }

    public static function getActive($limit) {
        $followers = UserFollower::model()->findAll(array('select' => 't.follower_id', 'distinct' => true));
        if ($followers) {
            foreach ($followers as $follower) {
                $arr[] = $follower->follower_id;
            }
            $criteria = new CDbCriteria;
            $criteria->condition = 'id !=' . Yii::app()->user->id;
            $criteria->addcondition('groups_id != 6');
            $criteria->addcondition('id in (' . implode(',', $arr) . ')');
            //$criteria->addcondition('featured_time < "'.strtotime(date('d-m-Y')).'" or featured_time="0"');
            $criteria->order = 'rand()';
            if ($limit) {
                $criteria->limit = $limit;
            }
            $users = User::model()->findAll($criteria);
            return $users;
        } else {
            return 0;
        }
    }

    public static function getFame($limit) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'id !=' . Yii::app()->user->id;
        $criteria->addcondition('groups_id != 6');
        $criteria->order = 'total_points desc';
        if ($limit) {
            $criteria->limit = $limit;
        }
        $users = User::model()->findAll($criteria);
        return $users;
    }

    public static function Referral($user_id, $blog_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "ref_id=" . $user_id;
        $criteria->addCondition("blog_id=" . $blog_id);
        $ref = Referral::model()->find($criteria);
        if ($ref) {
            Yii::app()->user->setFlash('wrong', "Sry Can't Duplicate This Action! You Can Set(" . User::model()->findByPk($blog_id)->username . ") As a Referral One Time Only!");
            return 0;
        } else {
            $ref = new Referral;
            $ref->ref_id = $user_id;
            $ref->blog_id = $blog_id;
            if ($ref->save(false)) {
                $model = User::model()->findByPk($blog_id);
                $model->referrals+=1;
                $model->today_points+=Yii::app()->params['referral_points'];
                $model->total_points+=Yii::app()->params['referral_points'];
                $model->save(false);
                return 1;
            }
            return 0;
        }
    }

}