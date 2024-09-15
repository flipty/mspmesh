<?php

/* Template Name: Manifest */

get_header(); ?>

<?php
if(have_posts()):
	while(have_posts()): the_post();

	the_content();

	endwhile;
endif;
?>
<?php
	$postArgs = array(
	 'post_type' => 'post',
	 'posts_per_page' => -1
	);

	$authorArgs = array(
	 'post_type' => 'contributor',
	 'posts_per_page' => -1
	);
	$manifest_posts = new WP_Query($postArgs);
	$manifest_authors = new WP_Query($authorArgs);
	$imageCount = 0;
	$postCount = $manifest_posts->found_posts;
	$authorCount = $manifest_authors->found_posts;
?>

<h1>Manifest - <?php echo $postCount; ?> posts, <?php echo $authorCount; ?> Authors</h1>

	<div class="manifest-row">
		<?php
		if($manifest_posts->have_posts()) :
	 		while($manifest_posts->have_posts()) :
	 			 $manifest_posts->the_post();

	 ?>
	 <div class="item">
		 <h2><?php the_title() ?></h2>
		 <h3>ID: <?php echo get_the_ID();?></h3>
		 <h4>BY:
			<?php if (get_field('post_author')) {
			 $author = get_field('post_author');
			 foreach($author as $auth):
			 	echo get_the_title($auth); echo ' ';
			endforeach;

			if ( ! is_array($author) ) {
				echo '<span style="color: red;">';
				echo get_the_title($author); echo ' (NON-ARR)';
				echo '</span>';
			}

			} ?>

		 </h4>
		 <h4>DATE: <?php echo get_the_date('M Y');?></h4>
		 <h4 class="permalink"><?php echo str_replace(home_url(), '', get_permalink());?></h4>
		 <a href="/wp-admin/post.php?post=<?php echo get_the_ID();?>&action=edit">EDIT</a> |
		 <a href="<?php echo get_the_permalink();?>">VIEW</a>
		 <?php if ( has_post_thumbnail() ) { echo '<p class="featuredimage">HAS IMAGE ('; $imageCount ++; echo $imageCount; echo ')</p>'; } ?>
		 <?php if ( has_category() ) { the_category(); }?>
	 </div>
	 <?php
	 		endwhile;
	  else:
	 ?>

	 		Oops, there are no posts.

	 <?php
	  endif;
	 ?>

	</div>

<?php
get_footer();
