<?php
/*
Plugin Name: Follow Category Feeds
Plugin URI: http://www.prasannasp.net/follow-wordpress-category-feeds-plugin/
Description: This plugin adds link to RSS feed for the current post categories after post content. RSS feed link for categories are usually /category/categoryname/feed. Make sure you are not redirecting your category feeds to feedburner before activating this plugin.
Version: 2.1.1
Author: Prasanna SP
Author URI: http://www.prasannasp.net/
*/

/*  This file is part of Follow Category Feeds plugin, a Wordpress plugin written in PHP. 
    Copyright 2012 Prasanna SP (email: prasanna@prasannasp.net)

    Follow Category Feeds is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Follow Category Feeds is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Follow Category Feeds.  If not, see <http://www.gnu.org/licenses/>.
*/

function fwcf_get_cat_feed_links() {
$cats = get_the_category();
foreach ($cats as $cat) {
$catfeedlinks[] = '<a href="'
.get_category_feed_link($cat->cat_ID,'')
.'">'.$cat->cat_name.'</a>';
}
return implode(', ', $catfeedlinks);
}

function fwcf_add_to_post_footer($content) {
	$options = get_option('fwcf_options');
	$followcatstext = $options['follow_cats_txt'];

 if (isset($options['on_other_pages']) && !(is_page() || is_attachment()) || is_single() )
 {
		$content .= '<p class="follow-cat-feed"> '.$followcatstext.' '.fwcf_get_cat_feed_links().'</p>'; 
			}
	return $content;

}

add_filter('the_content', 'fwcf_add_to_post_footer');

// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, 'fwcf_add_defaults');
add_action('admin_init', 'fwcf_init' );
add_action('admin_menu', 'fwcf_add_options_page');
add_filter('plugin_action_links', 'fwcf_plugin_action_links', 10, 2 );

function fwcf_add_defaults() {
	$tmp = get_option('fwcf_options');
		$arr = array(	"follow_cats_txt" => "Follow these topics:"

		);
		update_option('fwcf_options', $arr);
	}

function fwcf_init(){
	register_setting( 'fwcf_plugin_options', 'fwcf_options', 'fwcf_validate_options' );
}

function fwcf_add_options_page() {
	add_options_page('Follow Category Feeds Options Page', 'Follow Category Feeds', 'manage_options', __FILE__, 'fwcf_options_page_form');
}

function fwcf_options_page_form() {
	?>
	<div class="wrap">

		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Follow Category Feeds Options</h2>
		<p>Set your options for Follow Category Feeds plugin.</p>

		<form method="post" action="options.php">
			<?php settings_fields('fwcf_plugin_options'); ?>
			<?php $options = get_option('fwcf_options'); ?>

			<table class="form-table">

				<tr>
					<th scope="row">Title for Follow Category Feeds:</th>
					<td>
						<input type="text" size="50" name="fwcf_options[follow_cats_txt]" value="<?php echo $options['follow_cats_txt']; ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Show on other pages as well?</th>
					<td>
						<label><input name="fwcf_options[on_other_pages]" type="checkbox" value="1" <?php if (isset($options['on_other_pages'])) { checked('1', $options['on_other_pages']); } ?> /> <br />
						<span class="description">By default the plugin shows category feed link on single post only. Selecting this will add category feed links to posts on other pages, such as blog page and archives where full content is shown.</span> </label><br />
					</td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
<hr />
<p style="margin-top:15px;font-size:12px;">If you have found this plugin is useful, please consider making a <a href="http://prasannasp.net/donate/" target="_blank">donation</a> to support the further development of this plugin. Thank you!</p>
	</div>
	<?php	
}

// Sanitize and validate input
function fwcf_validate_options($input) {
	 // strip html from textboxes
	$input['follow_cats_txt'] =  wp_filter_nohtml_kses($input['follow_cats_txt']); // strip html tags, and escape characters
	return $input;
}

// Display a Settings link on the main Plugins page
function fwcf_plugin_action_links( $links, $file ) {

	if ( $file == plugin_basename( __FILE__ ) ) {
		$fwcf_links = '<a href="'.get_admin_url().'options-general.php?page=follow-category-feeds/follow-category-feeds.php">'.__('Settings').'</a>';
		// make the 'Settings' link appear first
		array_unshift( $links, $fwcf_links );
	}

	return $links;
}
?>
