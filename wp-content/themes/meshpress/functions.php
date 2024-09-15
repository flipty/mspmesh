<?php

// Basic Theme capabilities
add_theme_support('post-thumbnails');

// ACF Options
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

?>
