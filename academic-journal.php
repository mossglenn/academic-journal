<?php
/*
Plugin Name: Academic Journal
Plugin URI: http://amosglenn.com/academic-journal
Description: Easily publish academic journals, organizing articles and papers into issues.
Version: 0.3
Author: Amos Glenn
Author Email: amos@amosglenn.com
License:

  Copyright 2015 Amos Glenn (amos@amosglenn.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

/*================= TO DO ========================


*/



/* ==========================================================================
======================== ADD CUSTOM TAXONOMIES ==============================
============================================================================= */

/* -------------------- Custom Taxonomy: Article Type -------------------------- */

if ( ! function_exists( 'academic_journal_article_type_taxonomy' ) ) {

	// Register Custom Taxonomy
	function academic_journal_article_type_taxonomy() {

		$labels = array(
			'name'                       => 'Article Types',
			'singular_name'              => 'Article Type',
			'menu_name'                  => 'Article Types',
			'all_items'                  => 'All Types',
			'parent_item'                => 'Parent Type',
			'parent_item_colon'          => 'Parent Type:',
			'new_item_name'              => 'New Type Name',
			'add_new_item'               => 'Add New Type',
			'edit_item'                  => 'Edit Type',
			'update_item'                => 'Update Type',
			'view_item'                  => 'View Type',
			'separate_items_with_commas' => 'Separate Types with commas',
			'add_or_remove_items'        => 'Add or remove Types',
			'choose_from_most_used'      => 'Choose from the most used',
			'popular_items'              => 'Popular Types',
			'search_items'               => 'Search Types',
			'not_found'                  => 'Not Found',
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'journal_article_type_taxonomy', array( 'post', ' attachment', 'academic_journal_article' ), $args );
	}
	
	add_action( 'init', 'academic_journal_article_type_taxonomy', 0 );

}


/* ===============================================================
======================= ADD CUSTOM POST TYPES ====================
================================================================== */


/* ----------------- Custom Post Type: Issue -----------------------*/



// Register Issue Custom Post Type
function academic_journal_issue_post_type() {

	$labels = array(
		'name'                => 'Issues',
		'singular_name'       => 'Issue',
		'menu_name'           => 'Issues',
		'name_admin_bar'      => 'Issue',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Issues',
		'add_new_item'        => 'Add New Issue',
		'add_new'             => 'Add New',
		'new_item'            => 'New Issue',
		'edit_item'           => 'Edit Issue',
		'update_item'         => 'Update Issue',
		'view_item'           => 'View Issue',
		'search_items'        => 'Search Issue',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => 'issue',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'Issue',
		'description'         => 'An issue is a collection of articles with a common citation and published as a unit',
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,		
		'rewrite'             => $rewrite,
	);
	register_post_type( 'academic_journal_issue', $args );

}

add_action( 'init', 'academic_journal_issue_post_type', 0 );



/* -------------------- Custom Post Type: Article -------------------------- */

if ( ! function_exists('academic_journal_article_post_type') ) {

	// Register Article Custom Post Type
	function academic_journal_article_post_type() {

		$labels = array(
			'name'                => 'Articles',
			'singular_name'       => 'Article',
			'menu_name'           => 'Articles',
			'name_admin_bar'      => 'Post Type',
			'parent_item_colon'   => 'Parent Item:',
			'all_items'           => 'All Articles',
			'add_new_item'        => 'Add New Article',
			'add_new'             => 'Add New',
			'new_item'            => 'New Article',
			'edit_item'           => 'Edit Article',
			'update_item'         => 'Update Article',
			'view_item'           => 'View Article',
			'search_items'        => 'Search Article',
			'not_found'           => 'Not found',
			'not_found_in_trash'  => 'Not found in Trash',
		);
		$rewrite = array(
			'slug'                => 'article',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => 'Article',
			'description'         => 'Articles',
			'labels'              => $labels,
			'supports'            => array( 'title', 'excerpt', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			'taxonomies'          => array( 'category', 'post_tag', 'article_type' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( 'academic_journal_article', $args );

	}
	add_action( 'init', 'academic_journal_article_post_type', 0 );

}



/* =======================================================
====================== ADD META BOXES ====================
=========================================================== */

/* ----------------- ARTICLE META BOX ------------------- */
function academic_journal_add_article_meta_boxes() {
    add_meta_box( 
    	'academic_journal_article_meta_box',
        'Journal Article Information',
        'display_journal_article_meta_box',
        'academic_journal_article', 'normal', 'high'
    );
}
function display_journal_article_meta_box ($journal_article) {
	$journal_article_author = esc_html(get_post_meta($journal_article->ID, 'journal_article_author', true));
	$journal_article_page_number = esc_html(get_post_meta($journal_article->ID, 'journal_article_page_number', true));
	$the_article_issue_id = esc_html(get_post_meta($journal_article->ID, 'journal_article_in_issue', true));

	echo( "
		<table>
			<tr>
				<td>
					<label for='journal_article_author'>Author(s) full name(s)</label>
					<input type='text' size='80' name='journal_article_author' value='".$journal_article_author."' />
				</td>
			</tr>
			<tr>
				<td>
					<label for='journal_article_in_issue'>This article belongs in issue </label>
					<select name='journal_article_in_issue'>
						<option value='unassigned'>Unassigned</option>
		");
					//list issue citations as options with issue id values
					$the_new_query_args = array(
						'post_type' => 'academic_journal_issue',
						'nopaging' => true,
						'orderby' => 'meta_value',
						'meta_key' => 'journal_issue_publication_date');
					$the_new_query = new WP_Query($the_new_query_args);
					if($the_new_query->have_posts()) {
						while ($the_new_query->have_posts()) {
							$the_new_query->the_post();
							$issue_id = get_the_ID();
							$issue_title = get_the_title();
							echo("<option value='".$issue_id."'");
							//echo SELECTED if this is the issue previously chosen
							if($the_article_issue_id == $issue_id) {echo("SELECTED");}
							echo(">".$issue_title."</option>");				
						}
					}
	echo( "
					</select>
				</td>
				
				<td>
					<label for='journal_article_page_number'>Starting on page </label>
					<input type='text' size='20' name='journal_article_page_number' value='".$journal_article_page_number."' />

				</td>
				
			</tr>
		</table>
		<!-- END author info box -->
		");
}

function save_academic_journal_article_meta ($journal_article_id, $journal_article) {
	if ($journal_article->post_type == 'article') {
		//store article meta
		update_post_meta($journal_article_id, 'journal_article_author', $_POST['journal_article_author'] );
		update_post_meta($journal_article_id, 'journal_article_in_issue', $_POST['journal_article_in_issue'] );
		update_post_meta($journal_article_id, 'journal_article_page_number', $_POST['journal_article_page_number'] );
	}
}
add_action( 'save_post', 'save_academic_journal_article_meta', 10, 2 );


/* ----------------------  ISSUE META BOX ---------------------------- */

function academic_journal_add_issue_meta_boxes() {  
    //issue year
    add_meta_box( 'journal_issue_meta_box',
        'Journal Issue Citation Information',
        'display_journal_issue_meta_box',
        'academic_journal_issue', 'normal', 'high'
    );
}

function display_journal_issue_meta_box($journal_issue) {
	$journal_issue_year = esc_html(get_post_meta($journal_issue->ID, 'journal_issue_year', true));
	$journal_issue_volume = esc_html(get_post_meta($journal_issue->ID, 'journal_issue_volume', true));
	$journal_issue_number = esc_html(get_post_meta($journal_issue->ID, 'journal_issue_number', true));
	$journal_issue_month = esc_html(get_post_meta($journal_issue->ID, 'journal_issue_month', true));
	$journal_issue_publication_date = esc_html(get_post_meta($journal_issue->ID, 'journal_issue_publication_date', true));

	?>
	<table>
		<tr>
			<td>
				<label for="journal_issue_year">Citation Year</label><input type="text" size="80" name="journal_issue_year" value="<?php echo $journal_issue_year; ?>" />
			</td>
			<td>
				<label for="journal_issue_month">Citation Month(s)</label>
				<select name="month" id="month" onchange="" size="1">
					<option value="13">January-June</option>
					<option value="14">July-December</option>
					<option value="15">January-March</option>
					<option value="16">April-June</option>
					<option value="17">July-September</option>
					<option value="18">October-December</option>
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</td>
			<td>
				<label for="journal_issue_volume">Citation Volume</label><input type="text" size="80" name="journal_issue_volume" value="<?php echo $journal_issue_volume; ?>" />
			</td>
			<td>
				<label for="journal_issue_number">Citation Number</label><input type="text" size="80" name="journal_issue_number" value="<?php echo $journal_issue_number; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				
				<label for="journal_issue_publication_date">Issue Publication Date (mm-dd-yyyy)</label><input type="date" size="80" name="journal_issue_publication_date" value="<?php echo $journal_issue_publication_date; ?>" />
			</td>
		</tr>
	</table>
	<?php
}



function save_academic_journal_issue_meta ($journal_issue_id, $journal_issue) {
	if ($journal_issue->post_type == 'issue') {
		//store issue meta
		update_post_meta($journal_issue_id, 'journal_issue_year', $_POST['journal_issue_year']);
		update_post_meta($journal_issue_id, 'journal_issue_month', $_POST['journal_issue_month']);
		update_post_meta($journal_issue_id, 'journal_issue_volume', $_POST['journal_issue_volume']);
		update_post_meta($journal_issue_id, 'journal_issue_number', $_POST['journal_issue_number']);
		update_post_meta($journal_issue_id, 'journal_issue_publication_date', $_POST['journal_issue_publication_date']);
	}
}

add_action('save_post', 'save_academic_journal_issue_meta', 10, 2);





/* ==================================================================
============================== ADD TEMPLATES ========================= 
====================================================================== */


add_filter( 'template_include', 'include_template_function', 1 );

function include_template_function ($template_path) {
	
	if(get_post_type() == 'academic_journal_article') {
		if ($theme_file = locate_template(array ('academic-journal-article-single'))) {
			$template_path = $theme_file;
		}
		else {
			$template_path = plugin_dir_path(__file__) . 'templates/academic-journal-article-single.php';
		}
	}
	elseif(get_post_type() == 'academic_journal_issue') {
		if($theme_file = locate_template(array('academic-journal-issue-single'))) {
			$template_path = $theme_file;
		}
		else {
			$template_path = plugin_dir_path(__file__) . 'templates/academic-journal-issue-single.php';
		}
	}
	elseif (is_page('Current Issue')) {
		if($theme_file = locate_template(array('page-academic-journal-current-issue'))) {
			$template_path = $theme_file;
		}
		else {
			$template_path = plugin_dir_path(__file__) . 'templates/page-academic-journal-current-issue.php';
		}
	}
	elseif (is_page('Archived Issues')) {
		if($theme_file = locate_template(array('page-academic-journal-issue-archive'))) {
			$template_path = $theme_file;
		}
		else {
			$template_path = plugin_dir_path(__file__) . 'templates/page-academic-journal-issue-archive.php';
		}
	}
	elseif (is_page('the-new-philosophy-journal')) {
		if($theme_file = locate_template(array('page-the-new-philosophy-journal'))) {
			$template_path = $theme_file;
		}
		else {
			$template_path = plugin_dir_path(__file__) . 'templates/page-the-new-philosophy-journal.php';
		}
	}
	
	return $template_path;
}

?>