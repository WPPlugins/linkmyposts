<?php
function linkmypost_install()
{
   global $wpdb;

   $table_name = $wpdb->prefix . "lmp_links";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
		  ID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
		  Title TEXT NOT NULL
		)";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$wpdb->query($sql);
	}

   $table_name = $wpdb->prefix . "lmp_pages";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
		  ID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                  BookID INT NOT NULL,
		  PagePosition INT NOT NULL,
                  postID INT NOT NULL
		)";

	$wpdb->query($sql);
	}
}