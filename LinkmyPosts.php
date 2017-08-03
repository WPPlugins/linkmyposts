<?php
/*
Plugin Name: Link My Posts
Plugin URI: http://www.croutonsoflife.com
Description: Many users write stories over longer periods of time using multiple posts. Navigating to these related posts can sometimes be difficult for
users to understand. With Link my Posts, you can link all of your related posts into one book and display a friendly link list to your users
while they are reading a post. This link list will allow them to navigate to the next or previous page, as well as jump to the beginning or the end.
Version: 1.0
Author: Michael Gunnett
Author URI: http://www.croutonsoflife.com

2010  Michael Gunnett  (mike@croutonsoflife.com)

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

//Include files
include("lmp_database.php");
include("lmp_displayElements.php");
include("lmp_rules.php");
include("lmpPage_admin.php");
include("lmpAction_editLink.php");
include("lmpPage_addLink.php");
include("lmpPage_addPost.php");
include("lmp_utilities.php");
include("lmp_install.php");
include("lmpDisplay_PostLinks.php");

register_activation_hook(__FILE__, 'linkmypost_install');

/* Actions */
add_action ( 'admin_menu', 'lmp_admin_menu' );
add_action ( 'admin_menu', 'lmp_trashLink' );
add_action( 'wp_print_styles', 'lmp_addStyle' );

/* Filter */
add_filter ('the_content', 'insertFootNote');

function lmp_admin_menu() {
    add_posts_page('Manage Your Linked Posts', 'Link Posts', 'administrator', 'lmp', 'lmp_adminPage', get_bloginfo('siteurl')."/wp-content/plugins/LinkMyPosts/images/lmp-icon2.png");
    add_submenu_page('linkPosts', 'Edit Link Title', '', 'administrator', 'lmp_editLink', 'lmp_editLink');
    add_submenu_page('linkPosts', 'Add New Link Title', 'Add Title', 'administrator', 'lmp_addLink', 'lmp_addLinkPage');
    add_submenu_page('linkPosts', 'Assign/Un-Assign Posts', ' Posts', 'administrator', 'lmp_addPost', 'lmp_addPostPage');
    add_submenu_page('linkPosts', 'Add Post and Redirect', ' Posts', 'administrator', 'lmpAction_AddPost', 'lmp_addPost');
}

function lmp_addStyle(){
wp_enqueue_style( 'lmp_styles', get_bloginfo('wpurl') . '/wp-content/plugins/LinkMyPosts/style.css');
}