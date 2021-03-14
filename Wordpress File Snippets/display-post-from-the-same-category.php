<?php
// Display post in the same category
// https://www.isitwp.com/display-other-posts-from-the-same-category/
if ( is_single()) {
	$categories = get_the_category();
	if ($categories) {
		foreach ($categories as $category) {
			// echo "<pre>"; print_r($category); echo "</pre>";
			$cat = $category->cat_ID;
			$args=array(
				'cat' => $cat,	 
		'order' =>DESC,
				'post__not_in' => array($post->ID),
				'posts_per_page'=>55,
				'caller_get_posts'=>1
			);
			$my_query = null;
			$my_query = new WP_Query($args);
			if( $my_query->have_posts() ) {
				echo '<p>Check out our other '. $category->category_description . ' </p><br />';	 
				while ($my_query->have_posts()) : $my_query->the_post(); ?>
				 <p><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></p>
				 <?php
				endwhile;
			} //if ($my_query)
		} //foreach ($categories
	} //if ($categories)
	wp_reset_query();	// Restore global post data stomped by the_post().
} //if (is_single())
				?>					 
?>