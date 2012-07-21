<?php
/*
Plugin Name: Follow Category Feeds
Plugin URI: http://www.prasannasp.net/follow-wordpress-category-feeds-plugin/
Description: This plugin adds link to RSS feed for the current post categories after post content. RSS feed link for categories are usually /category/categoryname/feed. Make sure you are not redirecting your category feeds to feedburner before activating this plugin.
Version: 1.1
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

function fwcf_follow_title() {
return 'Follow these topics:';
}

function fwcf_add_to_post_footer($content) {
	 if (is_single() )
 {
		$content .= '<p class="fcfeeds">'.fwcf_follow_title().' '.fwcf_get_cat_feed_links().'</p>'; 
			}
	return $content;
}

function fwcf_get_cat_feed_links() {
$cats = get_the_category();
foreach ($cats as $cat) {
$catlinks[] = '<a href="'
.get_category_feed_link(false,$cat->cat_ID,$cat->category_nicename)
.'">'.$cat->cat_name.'</a>';
}
return implode(', ', $catlinks);
}

add_filter('the_content', 'fwcf_add_to_post_footer');
?>
