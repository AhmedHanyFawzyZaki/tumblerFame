<?php

$this->pageTitle=Yii::app()->name . ' - Contact Us';

?>

<div class="row wrapper content topMargin20">
	<div class="row topMargin10 wrapper">
		<div class="wrapper width653 mrgauto">
            <h2 class="text-center">Contact Us</h2>
        </div>
        <div class="padd-contact leftMargin50">
            <form method="post" action="<?=Yii::app()->request->baseUrl?>/home/send" id="contact_us">
				<?
                    if(Yii::app()->user->hasFlash('contact'))
                    {
                ?>
                        <div class="contact_us" id="done">
                            <label class="alert alert-success"><?=Yii::app()->user->getFlash('contact')?></label>
                        </div>
                <?
                    }
                ?>
                <div class="contact_us">
                    <span class="contact-label">Name: </span><br><input type="text" name="name" class="input_new" id="name" required autocomplete="off">
                </div>

                <div class="contact_us">
                    <span class="contact-label">E-mail: </span><br><input type="email" name="email" class="input_new" id="email" required autocomplete="off">
                </div>

                <div class="contact_us">
                    <span class="contact-label">Phone: </span><br><input type="text" name="phone" class="input_new" id="phone" required autocomplete="off">
                </div>

                <div class="contact_us">
                    <span class="contact-label">Subject: </span><br><textarea name="message" class="input_new" id="message" required autocomplete="off"></textarea>
                </div>

                <div class="contact_us">
                    <button type="submit" name="button" class="pull-right btn-large btn-success" id="button" value="Submit">Submit</button>
                </div>
            </form>
        </div>
	</div>
</div>