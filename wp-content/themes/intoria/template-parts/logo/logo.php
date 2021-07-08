<?php
    $logo = intoria_get_config('media-logo');
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
            <img style="width: 140px !important;" src="https://oma-arquitectos.com.ar/wp-content/uploads/2021/01/logo-oma-arquitectos.png" alt="<?php bloginfo( 'name' ); ?>">
        </a>
    </div>
<?php endif; ?>