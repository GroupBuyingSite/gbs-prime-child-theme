<div id="checkout_login_register_wrap" class="border_bottom clearfix">
	
	<div class="clearfix">
		<h3 class="main_heading gb_ff"><span class="title_highlight"><?php gb_e('Sign-up, Sign-in or Guest Purchase'); ?></span></h3>
	</div>
	
	<div id="checkout_login_register_forms" class="clearfix">
		<div id="checkout_registration_form_wrap"  class="checkout_block left_form clearfix">
			<div class="paymentform_info">
				<h2 class="table_heading section_heading font_medium gb_ff"><?php _e('Register'); ?></h2>
			</div>
			<div id="checkout_registration_form" class="clearfix">
				<?php print $args['registration_form']; ?>
			</div><!-- #checkout_registration_form.-->
			
		</div>

		<div id="checkout_login_form_wrap"  class="checkout_block right_form clearfix">
			<div class="paymentform_info">
				<h2 class="table_heading section_heading font_medium gb_ff"><?php _e('Login'); ?></h2>
			</div>
			<div id="checkout_login_form" class="clearfix">
				<?php print $args['login_form']; ?>
			</div>
			
		</div>
		<input type="hidden" name="gb_account_action" value="gb_account_register" />
		<input type="hidden" name="gb_login_or_register" value="1" />
	</div><!--  .checkout_login_register_forms -->

</div>

