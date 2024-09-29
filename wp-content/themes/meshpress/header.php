<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon-196x196.png" sizes="196x196" />
  <link href="<?php echo get_template_directory_uri(); ?>/css/meshpress.css" rel="stylesheet" type="text/css">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
$header_background = get_field('header_background', 'options');
$navigation_background = get_field('navigation_background', 'options');
$navigation_text = get_field('navigation_text_color', 'options');
?>
<style>
<?php if ($header_background) { ?> 
  header { background: <?php echo $header_background;?>}
<?php }?>
<?php if ($navigation_background) { ?> 
  header .navigation { background: <?php echo $navigation_background;?>}
<?php }?>
<?php if ($navigation_text) { ?> 
  header .navigation a { color: <?php echo $navigation_text;?>}
  header .socials > *:before {color: <?php echo $navigation_text;?>}
<?php }?>
</style>
<header>
  <nav class="intro">
    <div class="container">
      <div class="branding">
        <a href="<?php echo get_site_url();?>"><?php $logo = get_field('site_logo', 'options'); echo wp_get_attachment_image($logo);?></a>
      </div>
    </div>
  </nav>
  <nav class="navigation">
    <div class="container">
      <div class="nav-container">
      <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>        
      <?php if (have_rows('social_links', 'options')) { ?>
      <div class="socials">
      <?php
        while (have_rows('social_links', 'options')) {
          the_row();
          $site = get_sub_field('social_media_site');
          $url = get_sub_field('url');
          $icon = get_sub_field('icon');
           if ( 'dashicons' === $icon['type'] ) { ?>
              <div class="<?php echo esc_attr( $icon['value'] ); ?>"></div>
              <?php
           }
           // If the type selected was a Media Library image, use the attachment ID to get and render the image.
           if ( 'media_library' === $icon['type'] ) {
               $attachment_id = $icon['value'];
               $size = 'full'; // (thumbnail, medium, large, full, or custom size)

               $image_html = wp_get_attachment_image( $attachment_id, $size );
               echo wp_kses_post( $image_html );
           }
           // If the type selected was a URL, render an image tag with the URL.
           if ( 'url' === $icon['type'] ) {
               $url = $icon['value'];
               ?><img src="<?php echo esc_url( $url ); ?>" alt=""><?php
           }
        } //while ?>
      </div>
      <?php } //if ?>

      </div>
      
    </div>
  </nav>
</header>
