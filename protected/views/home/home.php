<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
if (Yii::app()->user->id) {
    $append = '';
    if (isset($_GET['ref']) && $_GET['ref'] != '') {
        $append = '?ref=' . $_GET['ref'];
    }
    $this->redirect(Yii::app()->request->baseUrl . '/home/index' . $append);
}
?>
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
        <!--<link rel="shortcut icon" href="img/favicon.png"/>-->
        <!-- Le styles -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet"/>
        <!-- custom styles -->
        <!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet"/>-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/OMG.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome-ie7.min.css" rel="stylesheet"/>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/flexslider.css" type="text/css" media="screen" />
        <script>
            function getAvatar()
            {
                var blog_name = $('#tumb_blog').val();
                var img_url="http://api.tumblr.com/v2/blog/" + blog_name + "/avatar/96";
                if (blog_name != "username.tumblr.com")
                {
                    $.ajax({
                        url: "https://api.tumblr.com/v2/blog/"+blog_name+"/info?api_key=<?=Yii::app()->params['apiConsumerKey']?>",
                        //"https://api.tumblr.com/v2/blog/" + blog_name + "/avatar/96",
                        type: "GET",
                        dataType: "JSONP",
                        success: function(data) {
                            //if (data.meta.status == "301" && data.meta.msg == "Found")//success
                            if (data.meta.status == "200" && data.meta.msg == "OK")//success
                            {
                                var ref = '';
                                <?
                                if (isset($_GET['ref'])) {
                                    ?>
                                    ref = "<?= $_GET['ref'] ?>";
                                    <?
                                }
                                ?>
                                //$('#tumb_blog').append('<form id="ss" action="<?= Yii::app()->request->baseUrl ?>/home/login?ref=' + ref + '" method="post" style="display:none;"><input type="hidden" name="username" value="' + blog_name + '" /><input type="hidden" name="avatar" value="' + data.response.avatar_url + '" /></form>');
                                $('#tumb_blog').append('<form id="ss" action="<?= Yii::app()->request->baseUrl ?>/home/login?ref=' + ref + '" method="post" style="display:none;"><input type="hidden" name="username" value="' + blog_name + '" /><input type="hidden" name="avatar" value="' + img_url + '" /></form>');

                                document.forms['ss'].submit();
                                //alert(data.response.avatar_url);
                                //$(document).redirect('<?= Yii::app()->request->baseUrl ?>/home/login', {'username': blog_name, 'avatar': data.response.avatar_url});
                            }
                            else
                            {
                                alert("Please enter a valid tumblr to get started!");
                            }
                            console.log(data);
                        }
                    });
                }
                else
                {
                    alert("Please enter your tumblr to get started!");
                }
            }
        </script>

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

            ga('create', 'UA-50797970-1', 'tumblrfame.com');
            ga('send', 'pageview');

        </script>


    </head>
    <body data-spy="scroll" data-target=".bs-docs-sidebar">
        <div class="outer-div">
            <div class="land-div">
                <span class="land-logo"><i><strong><?
                            if (Yii::app()->params['logo']) {
                                echo '<img src="' . Yii::app()->request->baseUrl . '/media/' . Yii::app()->params['logo'] . '" style="max-height:55px;">';
                            } else {
                                echo Yii::app()->name;
                            }
                            ?></strong></i></span><br>
                <span class="land-slogan">â€œPromote your tumblr & Get More Followersâ€?</span>
                <div class="land-input">
                    <span class="land-slogan2">Add your tumblr to get started, or <a href="http://tumblr.com" target="_blank">Signup</a>?<br></span>
                    <input type="text" value="username.tumblr.com" class="topMargin10" id="tumb_blog"><br>
                    <input type="button" class="btn btn-success padd" value="Login" onClick="getAvatar()">
                </div>
                <div class="land-followers">
                    <span class="day-followers">
                        <?= Helper::TodayFollowers(); ?><br>
                        Follows Today
                    </span>
                    <span class="day-followers pull-right">
                        <?= Helper::TotalFollowers() ?><br>
                        Since Launch
                    </span>
                </div>
            </div>
        </div>
        <?php $this->renderFile(Yii::app()->getBasePath('webroot') . '/views/layouts/footer.php') ?>
