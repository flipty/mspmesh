<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package edcblog
 */

get_header(); ?>


	<div class="main-content">
		<div class="search-results">
			<div class="container">
				<div class="row">

					<div class="col-sm-8 search-content">

						<div class="search-form">
							<?php get_search_form();?>
						</div>
						<?php //show the search/filter form again, but styled differently
						get_template_part( 'template-parts/search-filter', 'none' );
						?>
						<div id="search-target">

		<?php
		if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			// the_posts_navigation();
			wp_pagenavi();

		?>

		<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

					</div><!--#search-target-->

				</div>
				<div class="col-sm-4 search-nav">
					<?php get_template_part( 'template-parts/search-filter', 'none' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<h3 class="filterby">Filter by</h3>
<?php
get_footer();
