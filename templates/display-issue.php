<?php
/**
 * The template for displaying article information for tabls of content
 *
 * NEEDS $issue_id to be the ID of the current issue
 *
 * @package SSA
 */
 ?>
 
<issue class="single-issue" id="journal-issue-<?php echo $issue_id; ?>">

	<div class="journal_issue_featured_image">
		<?php the_post_thumbnail('medium'); ?>
	</div>		

	<div class="single-journal-issue-content clearfix">
		<div class="journal-issue-header">
			<div class="TNPlogoTextSmall">
				<img src="http://amosglenn.com/ssa/wp-content/uploads/2013/09/TNPlogoTextSmall.png" />
			</div>
			<div class="journal-issue-date">
				<?php echo(esc_html(get_post_meta($issue_id, 'journal_issue_date',true)) . " " . esc_html(get_post_meta($issue_id, 'journal_issue_year', true))); ?>
			</div>
			<div class="journal-issue-volume">
				<a href="<?php the_permalink($issue_id); ?>">
					Volume 
					<?php echo (esc_html(get_post_meta($issue_id, 'journal_issue_volume', true))); ?>, 
					Number
					<?php echo (esc_html(get_post_meta($issue_id, 'journal_issue_number', true))); ?>
				</a>
			</div>		
		</div>			
		<div class="journal-issue-contents">
			<?php
				$article_query_args = array(
					'post_type' => 'article',
					'meta_query' => array(
										array(
											'key' => 'journal_article_in_issue',
											'value' => $issue_id,
											'compare' => "="
										) 
									),
					'meta_key' => 'journal_article_order_in_issue',
					'orderby' => 'meta_value_num',
					'order' => 'ASC'
					);
				$article_query = new WP_Query($article_query_args);				
				if($article_query->have_posts()) {
					while($article_query->have_posts()) {
						$article_query->the_post();							
						include('table-of-contents-article.php');
					}
				}
			?>
		
		</div>
	</div>
</issue>
