<div class="apus-search-form-wrapper apus-search-form">		
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="container">      
		<div class="col-md-12 col-sm-12">
			<div class="p-relative">
				<div class="main-search">
		            <input type="text" placeholder="<?php esc_attr_e( 'Type To Search', 'intoria' ); ?>" name="s" class="apus-search form-control" autocomplete="off"/>
		        </div>
		        <input type="hidden" name="post_type" value="post">        
		        <button type="submit" class="btn btn-search"><i class="fas fa-search"></i></button>				
			</div>
		</div>
		<span class="close"></span>
    </form>
</div>