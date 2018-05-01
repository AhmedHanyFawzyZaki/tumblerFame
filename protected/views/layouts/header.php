<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title><?php echo CHtml::encode($this->pageTitle); ?> </title>


        <?php Yii::app()->bootstrap->register(); ?>

        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-50797970-1', 'auto');
            ga('send', 'pageview');

        </script>

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" type="image/png" href="<?= Yii::app()->request->baseUrl ?>/img/favicon.png"/>
        <!-- Le styles -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet"/>
        <!-- custom styles -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/OMG.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome-ie7.min.css" rel="stylesheet"/>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
        <![endif]-->
        <?php
        if (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'getFeatured') {
            $str = 'getFeatured';
        } elseif (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'faq') {
            $str = 'faq';
        } elseif (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'contact') {
            $str = 'contact';
        } elseif (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'page') {
            $str = $_REQUEST['slug'];
        } else {
            if (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'topUsers') {
                $str = Yii::app()->controller->action->id;
            } elseif (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'hallOfFame') {
                $str = Yii::app()->controller->action->id;
            } else {
                $str = 'home';
            }
            ?>
            <script>
                //sticky profile
                $(document).ready(function() {
                    var s = $("#sticker");
                    var pos = s.position();
                    $(window).scroll(function() {
                        var windowpos = $(window).scrollTop();

                        if (windowpos >= pos.top) {
                            s.addClass("stick");
                            s.css('top', windowpos);
                        } else {
                            s.removeClass("stick");
                        }
                    });
    <?
    if (Yii::app()->user->hasFlash('wrong')) {
        echo "$('#wrong_label').click();";
    }
    ?>
                });
            </script>
            <script>
                function Follow(id, blog)
                {
                    $.ajax({
                        url: "<?= Yii::app()->request->baseUrl ?>/home/Follow",
                        data: 'id=' + id + '&blog=' + blog,
                        type: "POST",
                        async: false,
                        success: function(data) {
                            var response = jQuery.parseJSON(data);
                            if (response['msg'] == 'done')
                            {
                                $('#stick_points').html('Points: ' + response['points']);
                                $('#stick_follows').html('Follows: ' + response['follows']);
                                $('#done_img_' + id).css("display", "block");
                                window.open("http://tumblr.com/follow/" + blog.replace('.tumblr.com', ''), "<?= Yii::app()->name ?>", "scrollbars=yes,width=650,height=500");
                            }
                            else if (response['msg'] == 'wrong')
                            {
                                $('#wrong_label').click();
                                $('#blog_link').html('<a href="http://' + blog + '" target="_blank">(Click here)</a>');
                            }
                            else
                            {
                                alert(response['msg']);
                            }
                            $('#today_overall_follows').html(response['today_over_al_follows']);
                            $('#total_overall_follows').html(response['over_all_follows']);
                        }
                    })
                }
            </script>
            <?
        }
        ?>
    </head>
    <body data-spy="scroll" data-target=".bs-docs-sidebar">
        <!-- ////////////////////////////////////////////////////////////////////////////////////////////////end row -->             
        <div class="row h_bg">	
            <div class="wrapper topMargin10 d-tbl">
                <div class="span3 logo bottomMargin20 leftMargin20">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>">
                        <?php
                        if (Yii::app()->params['logo']) {
                            echo '<img src="' . Yii::app()->request->baseUrl . '/media/' . Yii::app()->params['logo'] . '" style="max-height:110px;">';
                        } else {
                            echo "Tumblr Fame";
                        }
                        ?>
                    </a>
                </div>
                <?php
                if ((Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'contact') || (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'faq') || (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id == 'page' && $_REQUEST['slug'] != 'getPoints')) {
                    //change header
                } else {
                    if (!Yii::app()->user->id) {
                        $this->redirect(Yii::app()->request->baseUrl . '/home/logout');
                    }
                }
                if (Yii::app()->user->id) {
                    ?>
                    <div class="span3 pull-right log-out">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/logout" class="pull-right leftMargin20">LOG OUT <i class="icon-signout"></i></a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="pull-right">HELP <i class="icon-exclamation"></i></a>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"><span class="black">Help!</span></h4>
                                    </div>
                                    <div class="modal-body">
                                        <span class="black"><?= Pages::model()->findByPk(5)->details ?></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal -->
                    </div>
                    <div class="span6 menu footer row" style="width:480px;line-height:125px;">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/home" class="<?= $str == 'home' ? 'active' : '' ?>">Home</a>&nbsp;&nbsp;-&nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/topUsers" class="<?= $str == 'topUsers' ? 'active' : '' ?>">Top Users</a>&nbsp;&nbsp;-&nbsp;
                        <a href="<?= Yii::app()->request->baseUrl ?>/home/page/getPoints" class="<?= $str == 'getPoints' ? 'active' : '' ?>">Get Points</a>&nbsp;&nbsp;-&nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/getFeatured" class="<?= $str == 'getFeatured' ? 'active' : '' ?>">Get Featured</a>&nbsp;&nbsp;-&nbsp;
                        <a href="<?= Yii::app()->request->baseUrl ?>/home/hallOfFame" class="<?= $str == 'hallOfFame' ? 'active' : '' ?>">Hall Of Fame</a>
                    </div>
                    <?
                }
                ?>	
            </div>	
        </div>

        <a href="javascript:void(0)" data-toggle="modal" id="wrong_label" style="display:none;" data-target="#wrong" class="pull-right">Wrong <i class="icon-exclamation"></i></a>
        <div class="modal fade" id="wrong" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="wrongLabel"><span class="black">Wrong Action!</span></h4>
                    </div>
                    <div class="modal-body">
                        <span class="black" id="modal_cont">
                            <?php
                            if (Yii::app()->user->hasFlash('wrong')) {
                                echo Yii::app()->user->getFlash('wrong');
                            } else {
                                echo 'You can\'t follow a blog which you are already following!<br><br>
				If you want to visit this blog <span id="blog_link">click here</span>';
                            }
                            ?>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

