<?php 
$footer_background = get_field('footer_background', 'options');
$footer_text_color = get_field('footer_text_color', 'options');
?>
<style>
<?php if ($footer_background) { ?> 
  footer { background: <?php echo $footer_background;?>}
<?php }?>
<?php if ($footer_text_color) { ?> 
  footer * { color: <?php echo $footer_text_color;?>}
<?php }?>
</style>

<footer>
  <div class="container">    
    <div class="footer-nav">
      <nav class="footer-nav">
        <?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>        
      </nav>
    </div>
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
</footer>

<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-3.7.1.min.js"></script>
<?php wp_footer(); ?>
</body>
</html>
