<footer>
  <?php echo get_field('address', 'options');?> 
  <a href="tel:<?php echo get_field('phone', 'options');?>"><?php echo get_field('phone', 'options');?></a> 
  <a href="mailto:<?php echo get_field('email', 'options');?>"><?php echo get_field('email', 'options');?></a> 
</footer>

<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-3.7.1.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/owl.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lmt.js"></script>
<?php wp_footer(); ?>
</body>
</html>
