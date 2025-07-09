<?php
/**
 * The template for displaying article information for tabls of content
 *
 * NEEDS $issue_id to be the ID of the current issue
 *
 * @package SSA
 */
 ?>
 

			
					<div class="issue-contents-article">
				
				<?php
				insert_journal_article_pdf_link($post->ID);
				?>
				
				</div>
				
					<div class="journal-article-title">
						<a href="<?php echo get_permalink();  ?>">
						<?php the_title(); ?>
						</a>
					</div>
					<div class="journal-article-author">
						<a href="">
						<?php echo (get_post_meta(get_the_ID(),'journal_article_author', true)); ?>
						</a>
						
					</div>
				</div>