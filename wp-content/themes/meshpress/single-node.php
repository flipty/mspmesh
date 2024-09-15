<?php get_header();?>

	<?php
		if(have_posts()): while(have_posts()): the_post();

		$merchantOne = get_field('html');
		$extra_fields = get_field('extra_fields');
	?>
	<div class="container content-container">
		<div class="content-inner">
			<div class="food <?php if ($extra_fields) {echo ' meat-picker';}?>">
				<div class="content">
					<h1><?php the_title();?></h1>
					<h4 class="price"></h4>
					<?php the_content();?>
<!-- 
					<?php
						// building 3-item menu items that need more than the 3 allowed fields from merchantOne -
						// one text field for all three meat choices, and one for notes.
						if ($extra_fields) {
							$meats = get_field('meats');
						?>
						<select class="meat-select" id="item1">
							<option value=""># 1</option>
							<?php foreach ($meats as $meat){
								echo '<option> #1 ';
								echo $meat;
								echo '</option>';
							}?>
						</select>
						<select class="meat-select" id="item2">
							<option value=""># 2</option>
							<?php foreach ($meats as $meat){
								echo '<option> #2 ';
								echo $meat;
								echo '</option>';
							}?>
						</select>
						<select class="meat-select" id="item3">
							<option value=""># 3</option>
							<?php foreach ($meats as $meat){
								echo '<option> #3 ';
								echo $meat;
								echo '</option>';
							}?>
						</select>
						<?php } ?>
						<?php echo $merchantOne; ?>
						 -->
				</div>
				<div class="image">
					<?php echo get_the_post_thumbnail('','medium');?>
				</div>
			</div>
		</div>
	</div>


	<?php
		endwhile; endif; //general post loop
	?>


<?php get_footer();
