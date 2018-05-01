
 <?php
  $this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'.thumbnail',
    'config'=>array(
              'openEffect' => 'none',
		'closeEffect'	=>'none'
		
    ),
));
  
?>
                                                  

  <div class="row">	
        <div class="wrapper">
<!-- start wraper-->
                    <ul class="thumbnails topMargin10">
                       <?php
            
			foreach ($gallery as $gal)
			{
			?>
                             
            
                <li class="span2">
                
             <a class="thumbnail" rel="gallery1"  href="<?php echo Yii::app()->request->baseUrl; ?>/media/<?= $gal['image']?>">
                
                <img src="<?php echo Yii::app()->request->baseUrl.'/media/'.$gal['image'] ;?>" alt="" /></a>                            
            </a>    </li>
                
                
                
                
                <li>

                                
                
            <? }?>
                      
                       
                                                
                    </ul>
<!--///////////////////////////// lightbox divs ////////////////////////////////////////////-->
              <!--      <div id="Lightbox1" class="lightbox hide fade glry" aria-hidden="true" role="dialog" tabindex="-1">
                        <div class="lightbox-content" style="width: 972px; height: 645px;">
                     <?      
					//	foreach ($gallery as $gal)
					//	{
						?>
                         <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/<?= $gal['image']?>"/>
                       <? //}?>   
                        </div>
                    </div>
                  -->  
                   <!--///////////////////////////// end lightbox divs ////////////////////////////////////////////-->                                                                           
<!--end wraper -->	
        </div>
    </div> 