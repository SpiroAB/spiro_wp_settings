<?php
/*
Plugin Name: Spiro WP Settings
Plugin URI:  https://spiro.se
Description: Set some default settings to make a good base
Version:     1.0
Author:      Jens Hellqvist
Author URI:  http://superautomatic.com
*/

/**
 * Executed on register_activation
 * @hook register_activation_hook
 */
function set_superautomatic_defaults()
{
	global $wpdb;

	$o = [
		'avatar_default' => 'mystery',
		'avatar_rating' => 'G',
		'category_base' => '',
		'comment_max_links' => 2,
		'comment_moderation' => 0, // An administrator must always approve the comment
		'comment_whitelist' => 0, // Comment author must have a previously approved comment
		'comments_notify' => 0,
		'comments_per_page' => 0,
		'date_format' => 'j F Y',
		'default_comment_status_page' => 'closed',
		'default_ping_status' => 'open',
		'default_pingback_flag' => 0, // Attempt to notify any blogs linked to from the article.
		'default_post_edit_rows' => 30,
		'embed_size_h' => 1000,
		'embed_size_w' => 460,
		'links_updated_date_format' => 'j F Y, H:i',
		'permalink_structure' => '/%category%/%postname%/',
		'rss_language' => 'sv',
		'start_of_week' => 1,
		'thread_comments' => 0,
		'time_format' => 'H:i',
		'timezone_string' => 'Europe/Stockholm',
		'uploads_use_yearmonth_folders' => 0, // Organize my uploads into month- and year-based folders
		'use_smilies' => 0,
	];

	foreach ( $o as $k => $v )
	{
	  update_option($k, $v);
	}

	// Delete dummy post and comment.
	wp_delete_post(1, TRUE);
	wp_delete_comment(1);

	// empty blogroll
	$wpdb->query("TRUNCATE {$wpdb->links}");
}
register_activation_hook(__FILE__, 'set_superautomatic_defaults');
