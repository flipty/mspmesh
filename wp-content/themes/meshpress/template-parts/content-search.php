<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edcblog
 */

?>
<?php
$author = get_field('post_author');
$imgAlign = get_field('image_focal_point');
$date = get_the_date('F Y');
$categories = get_the_category();
$topic = $categories[0]->cat_ID;
$thisTopicImage = get_field('category_image', 'category_' . $topic . '' );

$thetitle = get_the_title(); /* or you can use get_the_title() */
$getlength = strlen($thetitle);
$thelength = 70;

?>
<div <?php post_class('search-result'); ?>>
	<div class="content<?php if ( ! has_post_thumbnail() ) { echo ' no-featured-image'; }?>">
		<div class="text">
			<h2><a href="<?php echo get_the_permalink();?>">
				<?php if ( ! is_front_page() ) {
					echo substr($thetitle, 0, $thelength); if ($getlength > $thelength) echo "...";
				}
				if ( is_front_page() ) {
					echo get_the_title();
				}
				?></a></h2>
			<h3 <?php if ( is_array($author) ) {echo 'class="multiple-authors"';} ?>><?php echo $date; ?><?php if ( $author ) { ?> by
				<?php if ( is_array($author) ) :
				foreach($author as $auth): ?>
					<a href="<?php echo get_the_permalink($auth);?>"><?php echo get_the_title($auth);?></a>
					<?php if (count($author) > 1) { ?><span>&amp;</span><?php } ?>
				<?php endforeach;?>
				<?php else : //if single author ?>
				<a href="<?php echo get_the_permalink($author);?>"><?php echo get_the_title($author);?></a>
				<?php endif;?>
			<?php } //if post has author?>
			</h3>
				<?php if ( ! is_front_page() ) {
					the_excerpt();
				}
				if ( is_front_page() ) { ?>
				<p>
				<?php echo wpex_get_excerpt(); ?>
				</p>
				<?php } ?>
		</div>
		<div class="action">
			<div class="meta">
					<a href="<?php echo get_category_link($topic);?>">
							<?php	echo get_cat_name($topic);?>
				 	</a>
			</div>
		</div>
	</div>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="image image-align-<?php echo $imgAlign; ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
		<a href="<?php echo get_the_permalink();?>"></a>
	</div>
	<?php } ?>
	<?php if ( ! has_post_thumbnail() ) { ?>
	<div class="image image-align-<?php echo $imgAlign; ?>" style="background-image: url('<?php echo wp_get_attachment_image_url($thisTopicImage, 'large') ?>');">
		<a href="<?php echo get_the_permalink();?>"></a>
	</div>
	<?php } ?>

</div>
