<div id="apus-header-mobile" class="header-mobile hidden-lg clearfix">        
    <div class="flex-middle">
        <div class="logo-wrapper">
            <?php
                $logo = intoria_get_config('media-mobile-logo');
            ?>
            <?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                        <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                </div>
            <?php else: ?>
                <div class="logo logo-theme">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                        <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo.svg'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="ali-right">
            <?php if ( intoria_get_config('show_searchform') ): ?>
                <div class="apus-search-form box-search">                    
                    <a href="#" class="btn-search-icon">
                        <i class="fas fa-search"></i>
                    </a>
                    <?php get_template_part( 'template-parts/searchform' ); ?>                       
                </div>            
            <?php endif; ?>
            <a href="#navbar-offcanvas" class="btn btn-theme btn-showmenu"><i class="fas fa-bars"></i></a>
        </div>        
    </div>    
</div>