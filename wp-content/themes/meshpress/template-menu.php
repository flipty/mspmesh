<?php

/* Template Name: Menu Page */

get_header();
include('includes/hours.php');
if(have_posts()):
	while(have_posts()): the_post();
	$order_page = 31;
?>

<div class="container content-container">
	<div class="content-inner">

	<div class="row">
		<div class="col-md-8 intro">
			<?php the_content(); ?>
		</div>
		<div class="col-md-4 meats">
			<?php echo get_field('meat_options');?>
		</div>
	</div>

	<?php
	if( have_rows('menu_section', $order_page) ):
	while( have_rows('menu_section', $order_page) ): the_row();
		$title = get_sub_field('section_title');
		$items = get_sub_field('menu_items');
	?>
	<div class="section">
		<h2>
			<?php echo $title; ?>
		</h2>
		<div class="menu-items">
			<?php foreach ($items as $item) { ?>
				<?php $content = get_post_field('post_content', $item);?>
				<?php $extra_fields = get_field('extra_fields', $item); ?>
				<div class="menu-item <?php if ($extra_fields) {echo 'meat-picker';}	?>">
					<div class="content">
						<h3><?php echo get_the_title($item);?><span class="price"></span></h3>
						<div class="image">
							<?php echo get_the_post_thumbnail($item, 'large'); ?>
						</div>
						<div class="copy">
							<?php echo $content;?>
						</div>
					</div>
					<?php
						// building 3-item menu items that need more than the 3 allowed fields from merchantOne -
						// one text field for all three meat choices, and one for notes.
						if ($extra_fields) {
							$meats = get_field('meats', $item);
						?>
						<!--
						<div class="meat-selects">
							<h5>Available with:</h5>
							<ul>
							<?php foreach ($meats as $meat){
								echo '<li>';
								echo $meat;
								echo '</li>';
							}?>
						</ul>
						</div>
					-->
						<?php } ?>

						<div class="merchantOne hidden">
							<?php echo get_field('html', $item);?>
						</div>


				</div>
			<?php }?>
		</div>
	</div>
	<?php endwhile;	endif; ?>


	</div>
</div>

<?php
	endwhile;
endif;

get_footer();
?>
