<?php

/* Template Name: Category Landing */

get_header(); ?>

<?php

if(have_posts()):
	while(have_posts()): the_post();

	the_content();

	endwhile;
endif;

get_footer();
