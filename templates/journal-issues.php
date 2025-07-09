<?php
/*
Template Name: Single Journal Issue Template
*/

get_header()
?>
<div id="primary">
	<div id="content" role="main">
	<?php
	$mypost = array(
		'post_type'=>'issue',
		'p'=> get_the_ID() );
	$loop = new WP_Query($mypost);
	
	while ($loop->have_posts()) {
		$loop->the_post;
	?>
		<issue id="journal-issue-<?php the_ID(); ?>">
			<header class="journal-issue-header">
			
				<!-- Display any featured image -->
				<div class="journal_issue_featured_image">
					<?php the_post_thumbnail(array(200,200)); ?>
				</div>
			
				<!-- display issue identity information -->
				<div class="journal-issue-date">
					<?php echo(esc_html(get_post_meta(get_the_ID(), 'journal_issue_date',true)) . " " . esc_html(get_post_meta(get_the_ID(), 'journal_issue_year', true))); ?>
				</div>
				<div class="journal-issue-volume">
					Volume 
					<?php echo (esc_html(get_post_meta(get_the_ID(), 'journal_issue_volume', true))); ?>
				</div>
				<div class="journal-issue-number">
					Number
					<?php echo (esc_html(get_post_meta(get_the_ID(), 'journal_issue_number', true))); ?>
				</div>			
			</header>
			
			<!-- display articles in issue -->
			<div class="journal-issue-contents">
				<?php
					$article_query_args = array(
						'post_type' => 'article',
						'meta_query' => array('journal_article_in_issue' => get_the_ID())
						);
					$article_query = new WP_Query($article_query_args);
					if($article_query->have_posts()) {
						while($article_query->have_posts()) {
							$article_query->the_post();
							echo '<div>' . get_the_title() . '</div>';
						}
					}
					wp_reset_postdata();
				?>
			</div>
		</issue>
	<?php } ?>
	</div>
</div>
<?php 
	wp_reset_query();
	get_footer();
?>		