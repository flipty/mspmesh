<?php
/**
 * The template for displaying a single blog contributor
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package edcblog
 */

get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php $author = get_the_ID();?>

<div class="main-content">
  <div class="search-results">
    <div class="container">
      <div class="row">
        <div class="col-md-8 search-content">

          <div class="search-form">
            <?php get_search_form();?>
          </div>

          <section class="post-byline">
  					<?php
              if ( has_post_thumbnail($author) ) {
  						$thumb = get_the_post_thumbnail_url($author, 'thumbnail');
  					  }
  					 	if (! has_post_thumbnail($author) ) {
  							$thumb = '/wp-content/themes/edcblog/images/logo_entrust_icon.svg';
  						}
  					?>
  					<div class="image">
  							<?php $rand = rand(1, 100000);?>
  							<svg width="100" height="100" viewbox="0 0 200 200" style="">
  								<defs>
  										<pattern id="image-bg-<?php echo $rand;?>" x="-10" y="0" height="100%" width="100%" patternUnits="userSpaceOnUse">
  												<image xlink:href="<?php echo $thumb;?>" width="100%" height="100%"></image>
  										</pattern>
  								</defs>
  								<path fill="url(#image-bg-<?php echo $rand;?>)" d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" stroke="#b5c4ee" stroke-width="2"></path>
  							</svg>
  					</div>
  					<div class="text">
  						<h4 class="name"><?php echo get_the_title($author); if (get_field('additional_credential', $author)){ echo ', '; the_field('additional_credential', $author); } ?></h4>
  						<h4 class="date"><?php the_field('title');?></h4>
  					</div>
  				</section>


<?php
// $author_args = array(
// 'post_type'        => 'post',
// 'order'            => 'ASC',
// 'orderby'          => 'meta_value',
// 'posts_per_page'   => -1,
// 'meta_query' => array(
//  array(
//   'key' => 'post_author',
//   'value' => $author,
//   'compare' => 'LIKE'
//   // 'type' => 'NUMERIC'
//  )
// )
// );

$author_args = array(
'post_type'        => 'post',
'order'            => 'DESC',
'posts_per_page'   => -1,
'meta_query'       => array(
        'relation' => 'OR',
        array(
            //for new author arrays...
            array(
              'key' => 'post_author',
              'value' => '"'.$author.'"',
              'compare' => 'LIKE'
            )
        ),
        array(
            //for old author non-arrays...
            array(
              'key' => 'post_author',
              'value' => $author,
              'compare' => '=',
              'type' => 'NUMERIC'
            )
        )
    )
);

$author_query  = new WP_Query( $author_args );
$postCount = $author_query->found_posts;
if ( $author_query->have_posts() ): ?>
<div class="search-results">
<?php
while ( $author_query->have_posts() ) {
$author_query->the_post();
?>
<?php get_template_part('template-parts/content-search'); ?>

<?php } ?>

<?php else: ?>
No Recent Posts

<?php endif; ?>
</div>
<?php endwhile; ?>

<?php // Navigation
// the_posts_navigation();
wp_pagenavi();
?>
<?php else : ?>

<?php // No Posts Found ?>
<h2>Hey, no author bio found?</h2>

<?php endif; ?>
        </div>
        <div class="col-md-4 search-nav">
          <?php get_template_part( 'template-parts/search-filter', 'none' ); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer();
