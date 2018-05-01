<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2013
 */
class Helper {

    public static function ago($start = '') {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = strtotime('now');
        $time = $start;
        $tense = "ago";
        $difference = $now - $time;


        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] $tense ";
        /* $seconds = strtotime("2011-09-23 19:10:18") - time();

          $days = floor($seconds / 86400);
          $seconds %= 86400;

          $hours = floor($seconds / 3600);
          $seconds %= 3600;

          $minutes = floor($seconds / 60);
          $seconds %= 60;


          echo "$days days and $hours hours and $minutes minutes and $seconds seconds"; */
    }

    public static function TodayFollowers() {
        $users = User::model()->findAll();
        $total = 0;
        foreach ($users as $user) {
            $total+=$user->today_follows;
        }
        return $total;
    }

    public static function TotalFollowers() {
        $users = User::model()->findAll();
        $total = 0;
        foreach ($users as $user) {
            $total+=$user->total_follows;
        }
        return $total;
    }

    public static function calculateRemaining($u_time) {
        if (!isset($u_time)) {
            $u_time = date('d-m-Y');
        }
        $u_time = strtotime($u_time); //change if removed afterfind from user model
        $today = strtotime(date('d-m-Y'));
        $remaining = ($u_time - $today) / (24 * 60 * 60);
        return $remaining == 0 ? 1 : $remaining + 1; //the remaining + today
    }

    public static function isFollower($follower_id, $blog_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'follower_id=' . $follower_id;
        $criteria->addCondition('blog_id=' . $blog_id);
        $model = UserFollower::model()->find($criteria);
        if ($model) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function isFeatured($id) {
        $u_time = User::model()->findByPk($id)->featured_time;
        if ($u_time) {
            $u_time = strtotime($u_time); //change if removed afterfind from user model
            $today = strtotime(date('d-m-Y'));
            $remaining = ($u_time - $today) / (24 * 60 * 60);
            if ($remaining >= 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public static function PlayVideo($model) {

        $player = Yii::app()->controller->widget('ext.Yiitube', array('v' => $model->video, 'size' => 'small'));


        return '<div class="VideoPlay">' . $player->play() . '</div>';
    }

    public static function PlaySound($model) {

        $player = Yii::app()->controller->widget('ext.Yiitube', array('v' => $model->sound, 'size' => 'small'));


        return '<div class="VideoPlay">' . $player->play() . '</div>';
    }

    public static function yiiparam($name, $default = null) {
        if (isset(Yii::app()->params[$name]))
            return Yii::app()->params[$name];
        else
            return $default;
    }

    public static function DrawPageLink($page_id) {
        $page = Pages::model()->findByPk($page_id);
        if ($page === null) {
            return 'Not-Found';
        }

        return 'home/page/view/' . $page->url;
    }

}

?>
