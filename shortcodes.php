<?php

// shortcode to get all posts of the specific post type
function get_my_posts() {
	// selects all posts
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => -1 // -1 displays all posts retrieved by query in the page
        // 'post_status' => 'draft' // gets all posts with the specified post_status
	);

	// runs the query to retrieve all posts with your arguments as $args
	$query = new WP_Query($args);

	// loops over all the queries
	if($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$movies .= '<h2>' . get_the_title() . '</h2>' . get_the_post_thumbnail() . '<p>' . get_the_excerpt() . '</p>' . '<p><strong>' . get_the_date() . '</strong></p><br>';
		}
	}
	else {
		// no posts found
	}

	return $movies;
}
add_shortcode( 'display-posts', 'get_my_posts' );


// shortcode to get all posts but has parameters passed via $atts
function get_my_posts_with_param($atts) {
	
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $atts['num'] // displays a number of posts based on the value of 'num'
	);
	
    // use ob_start(); to return a clean HTML template with PHP code
    // rather than PHP code with HTML
    ob_start();
	$query = new WP_Query($args);

	// loops over all the queries
	if($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			//$my_movies .= '<h2>' . get_the_title() . '</h2>' . get_the_post_thumbnail() . '<p>' . get_the_excerpt() . '</p>' . '<p><strong>' . get_the_date() . '</strong></p><br>';
            ?>

            <div><h2><?php echo get_the_title(); ?></h2></div>
            <div><?php echo get_the_post_thumbnail(); ?></div> <br>
            <div><?php echo get_the_excerpt(); ?></div>
            <div><strong><?php echo get_the_date(); ?></strong></div> <br>

            <?php
		}
	}
	else {
		// no posts found
	}
	
	return ob_get_clean();
}

add_shortcode( 'display-post-wparam', 'get_my_posts_with_param' );