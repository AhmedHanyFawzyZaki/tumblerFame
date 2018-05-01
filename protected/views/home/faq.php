<?php  // set the page title


$this->pageTitle=Yii::app()->name . ' - FAQ';
?>

<div class="row wrapper content topMargin20">
	<div class="row topMargin10 wrapper">
		<div class="wrapper width653 mrgauto">
            <h2 class="text-center">Frequently Asked Questions</h2>
        </div>
        <div class="padd30">
            
            <?php
            foreach ($faqs as $faq ){
        
                echo "<div class='paddc'><label class='alert alert-info' data-toggle='collapse' data-target='#$faq[id]'>$faq[question] </label>
                        <div class='collapse faq-cont' id='$faq[id]'>
        
                        $faq[answer]
                        </div>	</div>";
        
            }
        
            ?>
        </div>
	</div>
</div>