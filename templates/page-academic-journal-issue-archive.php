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

<h2>Archives of The New Philosophy</h2>

<?php
	$archived_issue_args = array(
							'post_type' => 'issue',
							'orderby' => 'meta_value_num',
							'order' => 'DESC',
							'meta_key' => 'journal_issue_sorting',
							
							);
	$archived_issues = get_posts($archived_issue_args);
	
	foreach ( $archived_issues as $post ) :
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