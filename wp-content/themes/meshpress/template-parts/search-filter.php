
<?php echo do_shortcode('[searchandfilter id="899"]'); //dev?>
<?php echo do_shortcode('[searchandfilter id="1060"]'); //prod?>

<section class="all-topics">
  <h4>More Blog Topics</h4>
  <div class="row">
    <div class="col-md-12">
      <ul>
      <?php
      $categories = get_categories( array(
        'hide_empty' => false,
        'exclude' => 12
      ) );
      foreach($categories as $category) {
        echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
      }
      ?>
      </ul>
    </div>
  </div>
</section>
