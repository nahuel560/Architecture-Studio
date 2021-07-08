<div id="apus-mobile-menu" class="apus-offcanvas hidden-lg"> 
    <div class="apus-offcanvas-body">
        <div class="offcanvas-head bg-primary">
            <a class="btn-toggle-canvas" data-toggle="offcanvas">
                <i class="fas fa-times"></i>
            </a>
        </div>

        <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
            <?php
                $args = array(
                    'theme_location' => 'primary',
                    'container_class' => 'navbar-collapse navbar-offcanvas-collapse',
                    'menu_class' => 'nav navbar-nav main-mobile-menu',
                    'fallback_cb' => '',
                    'menu_id' => '',
                    'walker' => new Intoria_Mobile_Menu()
                );
                wp_nav_menu($args);
            ?>
        </nav>
		
		<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix">
				<div class="widget widget_custom_text">
					<h4 class="widget-title">¡Te Esperamos!</h4>
					<div class="elementor-widget-container">
						<div class="widget-social  ">
							<ul class="social">
								<li>
									<a href="https://www.facebook.com/oma.arquitectos.design/" target="_blank">
										<div class="social-inner">
											<i class="fa fa-facebook-f"></i>
										</div>
									</a>
								</li>
								

								<li>
									<a href="https://www.instagram.com/oma.arquitectos.design/" target="_blank">
										<div class="social-inner">
											<i class="fa fa-instagram"></i>
										</div>
									</a>
								</li>
								
								<li>
									<a href="https://api.whatsapp.com/send?phone=5491125487998&amp;text=Quiero%20hacer%20la%20siguiente%20consulta..." target="_blank">
										<div class="social-inner">
											<i class="fa fa-whatsapp"></i>
										</div>
									</a>
								</li>																					
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>		
        
    </div>
</div>
<div class="over-dark"></div>