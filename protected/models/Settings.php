<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $website
 * @property string $google
 * @property string $twitter
 * @property string $pinterest
 * @property string $support_email
 * @property string $email
 * @property string $facebook
 * @property string $paypal_email
 */
class Settings extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Settings the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{settings}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('website, google, twitter, pinterest, support_email, email, facebook, paypal_email, video, image', 'length', 'max' => 255),
            array('referral_points, featured_follow_points, follow_points, plug_points', 'safe'),
            array('referral_points, featured_follow_points, follow_points, plug_points, replug_period', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, website, google, twitter, pinterest, support_email, email, facebook, paypal_email', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'website' => 'Website url',
            'google' => 'Google account',
            'twitter' => 'Twitter account',
            'pinterest' => 'Pinterest ',
            'support_email' => 'Support Email',
            'email' => 'Main Email',
            'facebook' => 'Facebook account',
            'paypal_email' => 'Paypal Email',
            'video' => 'Video',
            'referral_points' => 'Referral Points',
            'featured_follow_points' => 'Featured Follow Points',
            'follow_points' => 'Follow Points',
            'plug_points' => 'Plug Points',
            'replug_period' => 'Replug Period',
            'image' => 'Logo',
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
        $criteria->compare('website', $this->website, true);
        $criteria->compare('google', $this->google, true);
        $criteria->compare('twitter', $this->twitter, true);
        $criteria->compare('pinterest', $this->pinterest, true);
        $criteria->compare('support_email', $this->support_email, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('facebook', $this->facebook, true);
        $criteria->compare('paypal_email', $this->paypal_email, true);
        $criteria->compare('video', $this->video, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}