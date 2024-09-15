<?php get_header(); ?>

	<div class="row search-results">
		<div class="container">
			<div class="col-sm-8 search-content" id="search-target">

				<div class="search-form">
					<?php get_search_form();?>
				</div>
				<?php //show the search/filter form again, but styled differently
				get_template_part( 'template-parts/search-filter', 'none' );
				?>
	<?php
	if ( have_posts() ) : ?>

			<!-- <h1 class="page-title"><?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search: %s', 'edcblog' ), '<span>"' . get_search_query() . '"</span>' );
			?></h1> -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );

		endwhile;

		// the_posts_navigation();
		wp_pagenavi();

	?>

	<?php

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

			</div>
			<div class="col-sm-4 search-nav">
				<?php get_template_part( 'template-parts/search-filter', 'none' ); ?>
			</div>
		</div>
	</div>



<?php get_footer();
