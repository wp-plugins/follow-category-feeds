<?php
/*
Plugin Name: Follow Category Feeds
Plugin URI: http://www.prasannasp.net/follow-wordpress-category-feeds-plugin/
Description: This plugin adds link to RSS feed for the current post categories after post content. RSS feed link for categories are usually /category/categoryname/feed. Make sure you are not redirecting your category feeds to feedburner before activating this plugin.
Version: 1.0
Author: Prasanna SP
Author URI: http://www.prasannasp.net/
*/

function fwcf_follow_title() {
return 'Follow these topics:';
}

function fwcf_add_to_post_footer($content) {
	 if (is_single() )
 {
		$content .= '<p>'.fwcf_follow_title().' '.fwcf_get_cat_feed_links().'</p>'; 
			}
	return $content;
}

function fwcf_get_cat_feed_links() {
$cats = get_the_category();
foreach ($cats as $cat) {
$catlinks[] = '<a href="'
.get_category_rss_link(false,$cat->cat_ID,$cat->category_nicename)
.'">'.$cat->cat_name.'</a>';
}
return implode(', ', $catlinks);
}

add_filter('the_content', 'fwcf_add_to_post_footer');
?>
