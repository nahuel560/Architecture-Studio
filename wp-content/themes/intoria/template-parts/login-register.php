<div class="hidden" id="apus_login_register_form_wrapper">
	<div class="apus_login_register_form" data-effect="fadeIn">
		<div class="form-login-register-inner">
			<!-- Social -->
			<ul class="nav nav-tabs">
			  	<li class="active"><a id="apus_login_forgot_tab" class="text-theme" data-toggle="tab" href="#apus_login_forgot_form"><?php esc_html_e( 'Login', 'intoria' ); ?></a></li>
			  	<li><a id="apus_register_tab" class="text-theme" data-toggle="tab" href="#apus_register_form"><?php esc_html_e( 'Register', 'intoria' ); ?></a></li>
			</ul>
			
			<div class="tab-content">
				<div id="apus_login_forgot_form" class="tab-pane fade active in">
					<?php get_template_part( 'template-parts/login-form' ); ?>
			  	</div>
			  	<div id="apus_register_form" class="tab-pane fade in">
					<?php get_template_part( 'template-parts/register-form' ); ?>
			  	</div>
			</div>
			
		</div>
	</div>
</div>