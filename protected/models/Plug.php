<?php

/**
 * This is the model class for table "plug".
 *
 * The followings are the available columns in table 'plug':
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property string $plug_time
 */
class Plug extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Plug the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{plug}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'numerical', 'integerOnly' => true),
            array('content, plug_time', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, content, plug_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'content' => 'Content',
            'plug_time' => 'Plug Time',
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
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('plug_time', $this->plug_time, true);
        $criteria->order = 'id desc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function ListPlugs() {
        $criteria = new CDbCriteria;
        $criteria->order = 'id desc';
        $plugs = Plug::model()->findAll($criteria);
        if ($plugs) {
            $list = '';
            foreach ($plugs as $plug) {
                $username = User::model()->findByPk($plug->user_id)->username;
                $blog_name = str_replace(".tumblr.com", "", $username);
                //$left_time=abs(round((strtotime($plug->plug_time)-strtotime(date("d-m-Y h:i:s")))/60));
                $left_time = Helper::ago(strtotime($plug->plug_time));
                $list.=
                        '<div class="post">
					<a href="javascript:void(0);" onclick="Follow(' . $plug->user_id . ',\'' . $username . '\')">' . $blog_name . '</a>:
					<span class="blog-text">' . $plug->content . '</span>
					<span class="blog-time">' . $left_time . '</span>
				</div>';
            }
            return $list;
        } else {
            return "<h2 class='red'>No Plugs Found, Be The First To Plug Your Tumblr Blog!</h2>";
        }
    }

}
