<?php get_header() ?>
	<div id="content">
		<div class="padder">
		<?php if($bp_existed == 'true') : ?>
			<?php do_action( 'bp_before_blog_home' ) ?>
		<?php endif ?>
		<div class="page" id="blog-latest">
					<?php locate_template( array( '/library/components/header.php' ), true ); ?>
						<?php if ( have_posts() ) : ?>
								<?php if( $bp_existed == 'true' ) { //check if bp existed ?>
									<?php do_action( 'bp_before_blog_post' ) ?>			
									<?php bp_wpmu_excerptloop(); ?>
											<?php do_action( 'bp_after_blog_post' ) ?>
								<?php } else { // if not bp detected..let go normal ?>
										<?php wpmu_excerptloop(); ?>
								<?php } ?>
							<?php locate_template( array( '/library/components/pagination.php' ), true ); ?>
				<?php else: ?>
						<?php locate_template( array( '/library/components/messages.php' ), true ); ?>
				<?php endif; ?>
		</div>
		<?php if($bp_existed == 'true') : ?>
			<?php do_action( 'bp_after_blog_home' ) ?>
		<?php endif; ?>
		</div><!-- .padder -->
	</div><!-- #content -->
				<?php if( $bp_existed == 'true' ) { //check if bp existed ?>
						<?php locate_template( array( '/library/sidebars/bp-sidebar-blog.php' ), true ); ?>	
				<?php } else { // if not bp detected..let go normal ?>
						<?php locate_template( array( '/library/sidebars/sidebar-blog.php' ), true ); ?>
				<?php } ?>
<?php get_footer() ?>
