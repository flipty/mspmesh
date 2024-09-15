<?php get_header();?>

	<?php	if(have_posts()): while(have_posts()): the_post();?>

	<div class="container content-container">
		<div class="content-inner">
			<div class="row">
				<div class="col-md-9 post-content">
					<div <?php post_class();?>>
						<h1><?php the_title();?></h1>
						<?php the_content();?>
					</div>
				</div>
				<div class="col-md-3 post-listing">
					<h4>More from the kitchen</h4>
					<?php
					$args = array(
							'posts_per_page' => -1
					);
					$latest_posts = new WP_Query( $args );
					if ( $latest_posts->have_posts() ) {
							while ( $latest_posts->have_posts() ) {
									$latest_posts->the_post();
									// Post data goes here.
									?>
							<div class="post">
								<div class="content">
									<h3><a href="<?php echo get_the_permalink();?>"><?php echo get_the_title();?></a></h3>
								</div>
							</div>
									<?php
							}
					}
					wp_reset_postdata();
					?>

				</div>
			</div>
		</div>
	</div>

	<?php	endwhile; endif;?>

<?php get_footer();
