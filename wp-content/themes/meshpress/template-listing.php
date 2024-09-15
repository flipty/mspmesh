<?php

/* Template Name: All Post Listing */

get_header(); ?>

<div class="container">

	<div class="row search">
			<?php get_search_form();?>
	</div>

	<div class="row">
	<?php
		if(have_posts()): while(have_posts()): the_post();

		$date = get_the_date('F Y');
		$author = get_field('post_author');
		?>

		<div class="col-md-4">
			<p>
			<a href="<?php echo get_the_permalink();?>">
				<?php the_title();?>
			</a>
			<?php if ($author) {
				echo '<br>';
				echo get_the_title($author);
				echo '<br>';
				echo $date;
				} ?>
			</p>
		</div>

	<?php
		endwhile; endif;
	?>
	</div>
	<div class="row pagination">
		<div class="col-md-12">
			<?php numeric_posts_nav(); ?>
		</div>
	</div>
</div>

<?php get_footer();
