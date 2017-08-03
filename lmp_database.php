<?php

/* * *******************************************************************************
  Retrieve all Links from database.
 * ******************************************************************************** */

function getLinks() {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_Links";

    $sql = "SELECT * FROM " . $table_name;
    $Links = $wpdb->get_results($sql);

    return $Links;
}

/* * *******************************************************************************
  Retrieve all Links from database.
 * ******************************************************************************** */

function postLinks($postID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_Pages";

    $sql = "SELECT BookID FROM {$table_name} WHERE postID = {$postID}";
    $link = $wpdb->get_var($sql);

    return $link;
}

/* * *******************************************************************************
  Create a new Link.
 * ******************************************************************************** */

function makeLink($LinkTitle) {
    global $wpdb;

    $table_name = $wpdb->prefix . "lmp_Links";
    $sql = "INSERT INTO " . $table_name . " SET " . $table_name . ".Title = '" . $LinkTitle . "'";
    $results = $wpdb->query($sql);

    return $results;
}

/* * *******************************************************************************
  Update an existing Link.
 * ******************************************************************************** */

function updateLink($LinkTitle, $linkID) {
    global $wpdb;

    $table_name = $wpdb->prefix . "lmp_Links";
    $sql = "UPDATE {$table_name} SET Title='{$LinkTitle}' WHERE ID={$linkID}";
    $results = $wpdb->query($sql);

    return $results;
}

/* * *******************************************************************************
  Count the number of posts assigned to a specific link title.
 * ******************************************************************************** */

function lmp_getLinkTotal($linkID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_pages";

    $sql = "SELECT COUNT(BookID) FROM " . $table_name . " WHERE BookID = " . $linkID;
    $linkCount = $wpdb->get_var($sql);

    return $linkCount;
}

/* * *******************************************************************************
  Delete a title.
 * ******************************************************************************** */

function deleteLinkTitle($linkID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_links";

    $sql = "DELETE FROM " . $table_name . " WHERE ID = " . $linkID;
    $results = $wpdb->query($sql);

    deleteAssociatedPosts($linkID);
}

/* * *******************************************************************************
  Delete a link associations with pages.
 * ******************************************************************************** */

function deleteAssociatedPosts($linkID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_pages";

    $sql = "DELETE FROM " . $table_name . " WHERE BookID = " . $linkID;
    $results = $wpdb->query($sql);
}

/* * *******************************************************************************
  Delete a link associations with pages.
 * ******************************************************************************** */

function lmp_deleteLinkedPost($linkID, $postID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_pages";

    $sql = "DELETE FROM " . $table_name . " WHERE BookID = " . $linkID . " AND postID = " . $postID;
    $results = $wpdb->query($sql);
}

/* * *******************************************************************************
  Update the Link Title.
 * ******************************************************************************** */

function getLinkTitleID($linkID, $newLinkTitle) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_Links";

    $sql = "UPDATE " . $table_name . " SET Title =  " . $newLinkTitle . " WHERE ID = " . $linkID;
    $linkID = $wpdb->get_results($sql);

    return $linkID;
}

/* * *******************************************************************************
  Get a link title from the link id.
 * ******************************************************************************** */

function getLinkTitle($linkID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_Links";

    $sql = "SELECT Title FROM {$table_name} WHERE ID = {$linkID}";
    $linkTitle = $wpdb->get_var($sql);

    return $linkTitle;
}

/* * *******************************************************************************
  Get all posts assigned to a post group.
 * ******************************************************************************** */

function getPosts($linkID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_pages";

    $posts = "";

    if (lmp_getLinkTotal($linkID) > 0) {
        $sql = "SELECT * FROM {$table_name} WHERE BookID = {$linkID} ORDER BY PagePosition ASC";
        $posts = $wpdb->get_results($sql, OBJECT_K);
    }

    return $posts;
}

/* * *******************************************************************************
  Get all posts.
 * ******************************************************************************** */

function getAllPosts() {
    global $wpdb;
    $table_name = $wpdb->prefix . "posts";

    $sql = "SELECT DISTINCT post_parent, post_title, ID FROM {$table_name}";
    $post_titles = $wpdb->get_results($sql);

    $i = 0;

    foreach ($post_titles as $title) {
        if ($i == 0) {
            $sql = "SELECT * FROM {$table_name} WHERE post_title = '" . $title->post_title . "' AND post_parent = " . $title->post_parent . ' AND ID = ' . $title->ID;
            $i = 1;
        } else {
            $sql .= " OR post_title = '" . $title->post_title . "' AND post_parent = " . $title->post_parent . ' AND ID = ' . $title->ID;
        }
    }

    $posts = $wpdb->get_results($wpdb->prepare($sql), OBJECT);

    return $posts;
}

/* * *******************************************************************************
  Add post to Link Group.
 * ******************************************************************************** */

function addPost($postID, $linkID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_pages";

    //Assign the lowest position
    $position = lmp_getLinkTotal($linkID) + 1;

    $sql = "INSERT INTO " . $table_name . " (BookID, PagePosition, postID)
            VALUES ({$linkID}, {$position}, {$postID});";

    $results = $wpdb->query($wpdb->prepare($sql));

    return $results;
}

/* * *******************************************************************************
  Check for existing post in Link Group.
 * ******************************************************************************** */

function isPostLinked($postID, $linkID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_pages";

    $sql = "SELECT ID FROM " . $table_name . " WHERE postID = " . $postID . " AND BookID = " . $linkID;

    $results = $wpdb->get_var($wpdb->prepare($sql));

    return $results;
}

/* * *******************************************************************************
  Query for Post Object.
 * ******************************************************************************** */

function lmp_queryPosts($postID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "posts";

    $sql = "SELECT * FRoM {$table_name} WHERE ID = {$postID}";
    $postObj = $wpdb->get_row($wpdb->prepare($sql, OBJECT, 0));

    return $postObj;
}

/* * *******************************************************************************
  Query for Post Position.
 * ******************************************************************************** */

function lmp_queryPosition($linkID, $postID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_pages";

    $sql = "SELECT PagePosition FRoM {$table_name} WHERE BookID = {$linkID} AND postID = {$postID}";
    $postObj = $wpdb->get_var($wpdb->prepare($sql));

    return $postObj;
}

/* * *******************************************************************************
  Update position of a post.
 * ******************************************************************************** */

function lmp_updateLinkPosition($linkID, $postID, $position) {
    global $wpdb;
    $table_name = $wpdb->prefix . "lmp_pages";

    $sql = "UPDATE " . $table_name . " SET PagePosition =  {$position} " .
            " WHERE BookID = {$linkID} AND postID = {$postID}";
    $results = $wpdb->query($sql);
}
