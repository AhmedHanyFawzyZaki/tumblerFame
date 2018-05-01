<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div class="row wrapper content topMargin20">
    <div class="row topMargin10 wrapper">
        <?php
        $this->renderPartial('sticker');
        ?>

        <div class="span8 width653">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Welcome to <strong><?= Yii::app()->name ?></strong>! Earn points by following other blogs or by sharing our site.
                <br><strong>Plug</strong>= <?= Yii::app()->params['plug_points'] ?> Point, <strong>Follow</strong>= <?= Yii::app()->params['follow_points'] ?> Points, <strong>Featured Follow</strong>= <?= Yii::app()->params['featured_follow_points'] ?> Points,<strong>Referral</strong>= <?= Yii::app()->params['referral_points'] ?> Points.
                The users with the most points receives the most followers! Plug your blog at the bottom. <a href="<?= Yii::app()->request->baseUrl ?>/home/page/getPoints" class="alert-link"><strong>Learn more..</strong></a>
            </div>
            <div class="featured-blogs">
                <h2>Featured Users (<?= Yii::app()->params['featured_follow_points'] ?> points per follow)</h2>
                <div>
                    <?php
                    if ($featured_users) {
                        foreach ($featured_users as $f_u) {
                            ?>
                            <div class="blogs">
                                <?php
                                if (Helper::isFollower(Yii::app()->user->id, $f_u->id)) {
                                    $style = '';
                                } else {
                                    $style = 'style="display:none;"';
                                }
                                ?>
                                <img src="<?= Yii::app()->request->baseUrl ?>/images/done.png" class="followed" id="done_img_<?= $f_u->id ?>" <?= $style ?> />
                                <a href="javascript:void(0);" onclick="Follow(<?= $f_u->id ?>, '<?= $f_u->username ?>')">
                                    <img src="<?= $f_u['image'] ?>" width="64" height="64" />
                                </a>
                                <span>Days Left: <?= Helper::calculateRemaining($f_u['featured_time']) ?></span>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<h2 class="red">NO FEATURED BLOGS AVAILABE</h2><strong style="font-size:13px;">To Become The First Featured User <a href="' . Yii::app()->request->baseUrl . '/home/getFeatured">Click Here</a> And Choose One Of Our Available Packages!</strong>';
                    }
                    ?>
                </div>
            </div>
            <div class="featured-blogs">
                <h2>Top 10 Users Today (Point Reset Daily at 12:00 a.m GMT)</h2>
                <div>
                    <?php
                    if ($top_ten_users) {
                        foreach ($top_ten_users as $t_t_u) {
                            ?>
                            <div class="blogs">   	
                                <?
                                if (Helper::isFollower(Yii::app()->user->id, $t_t_u->id)) {
                                    $style = '';
                                } else {
                                    $style = 'style="display:none;"';
                                }
                                ?>
                                <img src="<?= Yii::app()->request->baseUrl ?>/images/done.png" class="followed" id="done_img_<?= $t_t_u->id ?>" <?= $style ?> />
                                <a href="javascript:void(0);" onclick="Follow(<?= $t_t_u->id ?>, '<?= $t_t_u->username ?>')">
                                    <img src="<?= $t_t_u['image'] ?>" width="64" height="64" />
                                </a>
                                <i title="Points Earned Today (<?= $t_t_u['today_points'] ?>)">P.E.T (<?= $t_t_u['today_points'] ?>)</i>
                            </div>
                            <?
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="featured-blogs">
                <h2>Active Followers (<?= Yii::app()->params['follow_points'] ?> points per follow)</h2>
                <div>
                    <?php
                    if ($active_users) {
                        foreach ($active_users as $ac_u) {
                            ?>
                            <div class="blogs">   	
                                <?php
                                if (Helper::isFollower(Yii::app()->user->id, $ac_u->id)) {
                                    $style = '';
                                } else {
                                    $style = 'style="display:none;"';
                                }
                                ?>
                                <img src="<?= Yii::app()->request->baseUrl ?>/images/done.png" class="followed" id="done_img_<?= $ac_u->id ?>" <?= $style ?> />
                                <a href="javascript:void(0);" onclick="Follow(<?= $ac_u->id ?>, '<?= $ac_u->username ?>')">
                                    <img src="<?= $ac_u['image'] ?>" width="64" height="64" />
                                </a>
                                <i title="Points Earned Today (<?= $ac_u['today_points'] ?>)">P.E.T (<?= $ac_u['today_points'] ?>)</i>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<h2 class="red">No Current Active Followers</h2>';
                    }
                    ?>
                </div>
            </div>
            <div class="featured-blogs width653-2">
                <h2>Plugs (<?= Yii::app()->params['follow_points'] ?> points per follow) Add your blog below</h2>
                <div id="plugs_cont">
                    <?
                    echo Plug::ListPlugs();
                    ?>
                </div>
                <div class="post add-post">
                    <h2>Plug Your Tumblr Blog (<?= Yii::app()->params['plug_points'] ?> Point Per Plug)</h2>
                    <textarea placeholder="Enter your description here..."  maxlength="170" id="plug_content"></textarea>
                    <!--<input type="submit" class="btn btn-success padd" value="Plug!" />-->
                    <input type="button" class="pay-btn padd" onclick="addPlug()"  value="Plug!">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
                            function addPlug()
                            {
                                var content = $('#plug_content').val();
                                if (content != '')
                                {
                                    $.ajax({
                                        url: "<?= Yii::app()->request->baseUrl ?>/home/addPlug",
                                        type: "POST",
                                        data: "content=" + content,
                                        success: function(response) {
                                            var data = jQuery.parseJSON(response);
                                            if (data['msg'] == 'done') {
                                                $('#stick_plugs').html("Plugs: " + data['plugs']);
                                                $('#stick_points').html('Points: ' + data['total_points']);
                                                updatePlugs();
                                            }
                                            else
                                            {
                                                $('#modal_cont').html(data['msg']);
                                                $('#wrong_label').click();
                                            }
                                            $('#plug_content').val('');
                                        }
                                    });
                                }
                            }
                            function updatePlugs() {
                                $.ajax({
                                    url: "<?= Yii::app()->request->baseUrl ?>/home/updatePlugs",
                                    success: function(data) {
                                        $('#plugs_cont').html(data);
                                    }
                                });
                            }

                            $(document).ready(function() {
                                setInterval(function() {
                                    updatePlugs();
                                }, 5000);
                            });
</script>