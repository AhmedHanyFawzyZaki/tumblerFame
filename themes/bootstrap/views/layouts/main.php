<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>


     <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
     <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" />

    <?php  if( Yii::app()->controller->id =='dashboard' and Yii::app()->controller->action->id=='index')
    {
    ?>
        <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script src="http://code.highcharts.com/highcharts-more.js"></script>
    <script type="text/javascript">
		$(function () {
        $('.chart-div').highcharts({
            title: {
                text: 'Monthly Average Temperature',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: WorldClimate.com',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '°C'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'New York',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Berlin',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
        });
    })

	$(function () {

	/**
	 * Get the current time
	 */
	function getNow () {
	    var now = new Date();

	    return {
	        hours: now.getHours() + now.getMinutes() / 60,
	        minutes: now.getMinutes() * 12 / 60 + now.getSeconds() * 12 / 3600,
	        seconds: now.getSeconds() * 12 / 60
	    };
	};

	/**
	 * Pad numbers
	 */
	function pad(number, length) {
		// Create an array of the remaining length +1 and join it with 0's
		return new Array((length || 2) + 1 - String(number).length).join(0) + number;
	}

	var now = getNow();

	// Create the chart
	$('.clock-chart-div').highcharts({

	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false,
	        height: 200
	    },

	    credits: {
	        enabled: false
	    },

	    title: {
	    	text: ''
	    },

	    pane: {
	    	background: [{
	    		// default background
	    	}, {
	    		// reflex for supported browsers
	    		backgroundColor: Highcharts.svg ? {
		    		radialGradient: {
		    			cx: 0.5,
		    			cy: -0.4,
		    			r: 1.9
		    		},
		    		stops: [
		    			[0.5, 'rgba(255, 255, 255, 0.2)'],
		    			[0.5, 'rgba(200, 200, 200, 0.2)']
		    		]
		    	} : null
	    	}]
	    },

	    yAxis: {
	        labels: {
	            distance: -20
	        },
	        min: 0,
	        max: 12,
	        lineWidth: 0,
	        showFirstLabel: false,

	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 5,
	        minorTickPosition: 'inside',
	        minorGridLineWidth: 0,
	        minorTickColor: '#666',

	        tickInterval: 1,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        title: {
	            text: '',
	            style: {
	                color: '#BBB',
	                fontWeight: 'normal',
	                fontSize: '8px',
	                lineHeight: '10px'
	            },
	            y: 10
	        }
	    },

	    tooltip: {
	    	formatter: function () {
	    		return this.series.chart.tooltipText;
	    	}
	    },

	    series: [{
	        data: [{
	            id: 'hour',
	            y: now.hours,
	            dial: {
	                radius: '60%',
	                baseWidth: 4,
	                baseLength: '95%',
	                rearLength: 0
	            }
	        }, {
	            id: 'minute',
	            y: now.minutes,
	            dial: {
	                baseLength: '95%',
	                rearLength: 0
	            }
	        }, {
	            id: 'second',
	            y: now.seconds,
	            dial: {
	                radius: '100%',
	                baseWidth: 1,
	                rearLength: '20%'
	            }
	        }],
	        animation: false,
	        dataLabels: {
	            enabled: false
	        }
	    }]
	},

	// Move
	function (chart) {
	    setInterval(function () {
	        var hour = chart.get('hour'),
	            minute = chart.get('minute'),
	            second = chart.get('second'),
	            now = getNow(),
	            // run animation unless we're wrapping around from 59 to 0
	            animation = now.seconds == 0 ?
	                false :
	                {
	                    easing: 'easeOutElastic'
	                };

	        // Cache the tooltip text
	        chart.tooltipText =
				pad(Math.floor(now.hours), 2) + ':' +
	    		pad(Math.floor(now.minutes * 5), 2) + ':' +
	    		pad(now.seconds * 5, 2);

	        hour.update(now.hours, true, animation);
	        minute.update(now.minutes, true, animation);
	        second.update(now.seconds, true, animation);

	    }, 1000);

	});
});

// Extend jQuery with some easing (copied from jQuery UI)
$.extend($.easing, {
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	}
})

</script>


<? } ?>

</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',

            'items'=>array(
            	array('label'=>'Main Site', 'url'=>array('/home/index'),'itemOptions'=>array('class' => 'main-site-link')),
                array('label'=>'Home', 'url'=>array('/dashboard/index'),'itemOptions'=>array('class' => 'main-site-link1')),

                	array('label'=>'Content', 'url'=>'#','items'=>array(
                   	array('label'=>'Pages', 'url'=>array('/pages')),
					array('label'=>'FAQ', 'url'=>array('/faq')),
                 /*	array('label'=>'Banner', 'url'=>array('/banner')),*/
                 	), 'itemOptions'=>array('class' => 'main-site-link2'), 'visible'=>User::CheckAdmin() ),

					array('label'=>'Users', 'url'=>'#','items'=>array(
						array('label'=>'Users', 'url'=>array('/User')),
						array('label'=>'Plugs', 'url'=>array('/Plug')),
					), 'itemOptions'=>array('class' => 'main-site-link3'), 'visible'=>User::CheckAdmin() ),
					
					array('label'=>'Financial', 'url'=>'#','items'=>array(
						array('label'=>'Packages', 'url'=>array('/package')),
						array('label'=>'Orders', 'url'=>array('/order')),
					), 'itemOptions'=>array('class' => 'main-site-link16'), 'visible'=>User::CheckAdmin() ),


 array('label'=>'Settings', 'url'=>array('/settings'),'itemOptions'=>array('class' => 'main-site-link33'), 'visible'=>User::CheckAdmin()),


                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/dashboard/logout')
					,'itemOptions'=>array('class' => 'main-site-link4'),
					 'visible'=>User::CheckAdmin()),





            ),

        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>



</div><!-- page -->

<?php


if( Yii::app()->controller->id =='dashboard' and Yii::app()->controller->action->id=='index')
{
	?>
	<div id="footer" class="navbar-inner footer1">
	<?

}else{
	?>
	<div id="footer" class="navbar-inner footer">
	<?

	}

?>

	</div><!-- footer -->

</body>
</html>
