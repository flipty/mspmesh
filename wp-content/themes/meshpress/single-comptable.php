<?php

/* Template Name: Table Test */

get_header(); ?>

<?php
if(have_posts()):
	while(have_posts()): the_post();

//	the_content();

	endwhile;
endif;
?>

<div class="container">

<?php
/*
responsive comparison table optional classes:

table--Xitems (Up to 7)
table--checklist (for yes/no-based feature grids, centers all text)
table--no-legend (does not have the left-side legend)

table-cell optional classes:

column-legend
column-head
featured
row-legend
extra-legend (an empty row with a legend bold on the leftmost side and coordinating cells)
table-data
table-cell-button

internal content classes:

span.price
span.this-page

<img src="/-/media/335b442fb77645c38799bbd3fa2db6d6.ashx" alt="yes" class="yes">
<img src="/-/media/3cbbdeffb23948bba72caf9487ee7f84.ashx" alt="no" class="no">

*/
$items = get_field('comparison_items');
$tableType = get_field('table_type');
$alignment = get_field('content_alignment');
$legend = false;
if (get_field('legend')){ $legend = true; }
$legendWidth = get_field('legend_width');
?>
<style> img.no {visibility: visible !important; opacity: 0.25;} /* TEMPORARY */</style>

<h1><?php echo get_the_title();?> (<?php if (get_field('legend')) { echo 'has legend';} ?>)</h1>
<?php if ($legend) {
	echo $legendWidth;
} ?>
<div class="comparison-table table--collapse table--<?php echo $items;?>items table--columns <?php if ($tableType == 'checklist'){ echo 'table--checklist'; }?> <?php if ($alignment == 'Left'){ echo 'content-left headers-left'; }?> <?php if (! $legend) { echo ' table--no-legend';}?>">

	<?php if ( have_rows('table_rows') ):
		$rowCount = count(get_field('table_rows'));
		while ( have_rows('table_rows') ) : the_row();

			$row_type = get_sub_field('row_type');
			$row_title = get_sub_field('row_title');
			$row_content = get_sub_field('row_content');
			$rowIndex = get_row_index();//this isn't the index I fully want... I want the index of the content pieces inside the rows too.
			$featured = false;

			if ( get_sub_field('featured')){ $featured = true; }

			?>

			<?php if ($row_type == "Headline"){ ?>
			<div style="order:<?php echo $rowIndex; ?>;" class="table-cell table-data
				<?php if ($rowIndex === 0) {echo 'table-cell--first column-head row-legend';}?>
				<?php if ($featured){ echo ' featured';}?>">
				<pre><?php print_r($row_content);?></pre>
			</div>
			<?php }?>

			<?php if ($row_type === "Subhead"){ ?>
			<div style="order:<?php echo $rowIndex; ?>;" class="table-cell table-data <?php if ($featured){ echo ' featured';}?>"><label><?php echo $row_title; ?></label><pre><?php print_r($row_content);?></pre></div>
			<?php }?>

			<?php if ($row_type === "Content"){ ?>
			<div style="order:<?php echo $rowIndex; ?>;" class="table-cell table-data
				<?php if ($rowIndex === 0) {echo 'table-cell--first';}?>
				<?php if($rowIndex === $rowCount ) {} echo ' table-cell--last';?>
				<?php if ($featured){ echo ' featured';}?>">
				<label><?php echo $row_title; ?></label><pre><?php print_r($row_content);?></pre></div>
			<?php }?>

			<?php if ($row_type === "Button"){ ?>
			<div style="order:<?php echo $rowIndex; ?>;" class="table-cell table-data table-cell-button
				<?php if ($rowIndex === 0) {echo 'table-cell--first';}?>
				<?php if($rowIndex === $rowCount ) {} echo ' table-cell--last';?>
				<?php if ($featured){ echo ' featured';}?>">
				<a href="#" class="btn btn-default">BUY</a>
			</div>
			<?php }?>


		<?php endwhile; ?>
	<?php endif; ?>


</div>










<?php
get_footer();
