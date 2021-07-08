<header id="apus-header" class="apus-header header-default visible-lg" role="banner">
    <div class="<?php echo (intoria_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (intoria_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="container p-relative">
                <div class="row flex-middle">
                    <div class="col-lg-3 col-md-3">
                        <div class="logo-in-theme">
                            <?php get_template_part( 'template-parts/logo/logo' ); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 p-static flex-middle">
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="pull-left">
                                <div class="main-menu">
                                    <nav data-duration="400" class="apus-megamenu slide animate navbar p-static" role="navigation">
                                    <?php
                                        $args = array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse no-padding',
                                            'menu_class' => 'nav navbar-nav megamenu effect1',
                                            'fallback_cb' => '',
                                            'menu_id' => 'primary-menu',
                                            'walker' => new Intoria_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                    </nav>
                                </div>
                            </div>
                        <?php endif; ?>                        
                    </div>
					
                    <div class="col-lg-3 col-md-3">
						<div class="widget-social  ">
							<ul class="social">
								<li>
									<a href="https://www.facebook.com/oma.arquitectos.design/services/" target="_blank">
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
</header>