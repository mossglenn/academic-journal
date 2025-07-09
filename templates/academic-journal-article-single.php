<?php
/**
 * The Template for displaying single articles
 *
 * @package SSA
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<div class="article-pdf-link">
				<?php
				insert_journal_article_pdf_link($post->ID, "large");
				?>			
			</div>
		
		
<?php		$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ssa' );
?>
		<div class="entry-meta">
			<?php 
				
				$issue_id = get_post_meta(get_the_ID(),'journal_article_in_issue',true);
				$issue_title = get_the_title($issue_id);
				$issue_permalink = get_permalink($issue_id);
			?>
			<div class="article-author">
				<?php echo (get_post_meta(get_the_ID(), 'journal_article_author', true)); ?>
			</div>
			<div class="article-in-issue">
				Published in <a href="<?php echo home_url('/the-new-philosophy-journal/'); ?>"  style="font-family: 'ZapfChancery-Roman', cursive;text-decoration:none;">The New Philosophy</a> <a href="<?php echo($issue_permalink); ?>"><?php echo($issue_title); ?></a>
			</div>
			
			
			
			
			
			
			
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ssa' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'ssa' ) );
			if ( '' != $tag_list ) {
				$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ssa' );
			}
			else {
			//	$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ssa' );
			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

	</footer><!-- .entry-meta -->
</article><!-- #post-## -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>