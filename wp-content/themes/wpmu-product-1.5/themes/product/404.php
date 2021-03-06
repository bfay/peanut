<?php get_header(); ?>
	<div id="content">
		<div class="padder">
		<?php if($bp_existed == 'true') : ?>
			<?php do_action( 'bp_before_404' ) ?>
		<?php endif ?>
		<div class="page 404">
			<div id="message" class="info">
					<?php locate_template( array( '/library/components/messages.php' ), true ); ?>
			</div>
			<?php if($bp_existed == 'true') : ?>
				<?php do_action( 'bp_404' ) ?>
			<?php endif ?>
		</div>
		<?php if($bp_existed == 'true') : ?>
			<?php do_action( 'bp_after_404' ) ?>
		<?php endif ?>
		</div><!-- .padder -->
	</div><!-- #content -->
		<?php if( $bp_existed == 'true' ) { //check if bp existed ?>
			<?php locate_template( array( '/library/sidebars/bp-sidebar-page.php' ), true ); ?>		
		<?php } else { // if not bp detected..let go normal ?>
				<?php locate_template( array( '/library/sidebars/sidebar-page.php' ), true ); ?>
		<?php } ?>
<?php get_footer(); ?>