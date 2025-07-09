<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SSA
 */

get_header();
?>

<div class="content-area">

<?php

	$current_issue_args = array(
							'category' => 222,
							'post_type' => 'issue'
							);
	$current_issues = get_posts($current_issue_args);
	
	foreach ( $current_issues as $post ) :
  		setup_postdata( $post ); 
  		$issue_id = get_the_ID();
		include('display_issue.php');
	endforeach; 
?>

</div>

<?php

	wp_reset_query();
	get_sidebar();
	get_footer();
?>		