=== Follow WordPress Category Feeds ===
Contributors: prasannasp 
Donate link: http://www.prasannasp.net/donate
License: GPLv3
License URI: http://www.gnu.org/copyleft/gpl.html
Tags: categories, RSS, feed, follow, subscribe
Requires at least: 3.1
Tested up to: 3.4.1
Stable tag: 2.0

This plugin adds category feed links after post content on single posts.

== Description ==
Just like the normal Wordpress site feed, wordpress categories and tags also has feeds. The category feed is located at `site.url/category/categoryname/feed`. This plugin automatically adds the RSS feed link to the current post categories after the post content. You can change it's title in WP-Admin --> Settings --> Follow Category Feeds.

<strong>Other plugins from the developer</strong>
<ul>
<li><a href="http://wordpress.org/extend/plugins/custom-recent-posts-widget/">Custom Recent Posts Widget</a></li>
<li><a href="http://wordpress.org/extend/plugins/kannada-comment/">Kannada Comment</a></li>
</ul>

Visit <a href="http://www.prasannasp.net/blog/">my blog</a> for more information on WordPress and plugins.

== Installation ==

1. Extract the contents of the .zip archive

2. Upload the `follow-category-feeds` folder to your `wp-content/plugins` directory.
     
3. Activate the plugin through the 'Plugins' menu in WordPress.

== Screenshots ==

1. Plugin showing link to RSS feed for Linux, Open Source and Ubuntu categories in post foooter
2. Plugin Options Page

== Changelog ==

= 2.0 =

* Fixed the bug in using `get_category_feed_link` function, which was causing category feed links to strip off `/feed` in URL. 

* Added option to change the category feed link title. You can change this in WP-Admin --> Settings --> Follow Category Feeds.

= 1.1 =
* Since `get_category_rss_link` function is deprecated, we are using `get_category_feed_link` function to get category feed link.

* Added `fcfeeds` class to the output. So, you can style it now using `.fcfeeds` class.

= 1.0 =

* Initial public release

== Upgrade Notice ==

* Version 1.0 has a deprecated function and there is a bug in version 1.1. So, please update to the latest version (2.0 or later)
