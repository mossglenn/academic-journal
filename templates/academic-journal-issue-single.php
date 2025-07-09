<?php
/*
Template Name: Single Journal Issue Template
*/

get_header()

?>

<?php
$issue_id=get_the_ID();
$post=get_post($issue_id);
?>

<div class="content-area">

<?php
	
	include('display_issue.php');
?>
</div>

<?php 
	wp_reset_query();
	get_sidebar();
	get_footer();
?>		