<?php

// Basic Theme capabilities
add_theme_support('post-thumbnails');

// ACF Options
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

add_action('init', 'mspmesh_create_post_types');

function mspmesh_create_post_types() {

  // Set up Projects
  $nodeLabels = array(
    'name' => 'Nodes',
    'singular_name' => 'Node',
    'add_new' => 'Add New Node',
    'add_new_item' => 'Add New Node',
    'edit_item' => 'Edit Node',
    'new_item' => 'New Node',
    'all_items' => 'All Nodes',
    'view_item' => 'View Node',
    'search_items' => 'Search Nodes',
    'not_found' =>  'No Nodes Found',
    'not_found_in_trash' => 'No Nodes found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Nodes'
  );

  register_post_type('project', array(
    'labels' => $nodeLabels,
    'has_archive' => true,
    'public' => true,
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes'),
    'exclude_from_search' => false,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-cloud-saved',
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'node')
    )
  );

}

?>
