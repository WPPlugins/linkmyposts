<?php
/* * *******************************************************************************
  Create Link components.
 * ******************************************************************************** */

function createLinkTitle() {

    $return_string = '<form method="post" name="addLinkTitle"><div class="metabox-holder has-right-sidebar" id="poststuff">';

    $return_string .= createSaveLinkButtonBox();

    $return_string .= '<div id="post-body"><div id="post-body-content"><div class="stuffbox" id="namediv"><h3><label for="link_name">Name</label></h3>';
    $return_string .= '<div class="inside"><input type="text" id="link_name" value="" tabindex="1" size="30" name="link_name">';
    $return_string .= '<p>Example: The Not-So Adventures of my Life</p></div></div></div></div></div></form>';

    return $return_string;
}

function createSaveLinkButtonBox() {
    $return_string = '<div class="inner-sidebar" id="side-info-column"><div class="meta-box-sortables ui-sortable" id="side-sortables" style="min-height: 100px">';
    $return_string .= '<div class="postbox " id="linksubmitdiv"><div title="Click to toggle" class="handlediv"><br></div>';
    $return_string .= '<h3 class="hndle"><span>Save</span></h3><div class="inside"><div id="submitlink" class="submitbox">';
    $return_string .= '<div id="major-publishing-actions"><div id="publishing-action">';
    $return_string .= '<input type="submit" class="button-primary" value="Add Link Title" name="addLinkTitle" id="addLinkTitle"></div>';
    $return_string .= '<div class="clear"></div></div><div class="clear"></div></div></div></div></div></div>';

    return $return_string;
}

/* * *******************************************************************************
  Edit link components.
 * ******************************************************************************** */

function editLinkTitle($linkID) {

    $linkTitle = getLinkTitle($linkID);

    $return_string = '<form method="post" name="editLinkTitle"><div class="metabox-holder has-right-sidebar" id="poststuff">';

    $return_string .= editSaveLinkButtonBox();

    $return_string .= '<div id="post-body"><div id="post-body-content"><div class="stuffbox" id="namediv"><h3><label for="link_name">Existing Title</label></h3>';
    $return_string .= '<div class="inside"><input type="text" disabled="disabled" size="30" value="' . $linkTitle . '"></input></div></div></div></div>';
    $return_string .= '<div id="post-body"><div id="post-body-content"><div class="stuffbox" id="namediv"><h3><label for="link_name">New Title</label></h3>';
    $return_string .= '<div class="inside"><input type="text" id="new_link_name" value="" size="30" name="new_link_name">';
    $return_string .= '<p>Example: The Not-So Adventures of my Life</p></div></div></div></div></div></form>';
    return $return_string;
}

function editSaveLinkButtonBox() {
    $return_string = '<div class="inner-sidebar" id="side-info-column"><div class="meta-box-sortables ui-sortable" id="side-sortables" style="min-height: 100px">';
    $return_string .= '<div class="postbox " id="linksubmitdiv"><div title="Click to toggle" class="handlediv"><br></div>';
    $return_string .= '<h3 class="hndle"><span>Save</span></h3><div class="inside"><div id="submitlink" class="submitbox">';
    $return_string .= '<div id="major-publishing-actions"><div id="publishing-action">';
    $return_string .= '<input type="submit" class="button-primary" value="Submit" name="editLinkTitle" id="editLinkTitle"></div>';
    $return_string .= '<div class="clear"></div></div><div class="clear"></div></div></div></div></div></div>';

    return $return_string;
}

/* * *******************************************************************************
  Headers.
 * ******************************************************************************** */

function createAdminHeader() {
    $site_url = get_bloginfo("wpurl");

    $return_string = '<div class="wrap nosubsub"><div class="icon32">';
    $return_string .= '<img src="' . $site_url . '/wp-content/plugins/LinkMyPosts/images/lmp-icon.png" height=36 width=36></img>';
    $return_string .= '</div><h2>Manage Post Groups ';
    $return_string .= createAddNewLinkButton();
    $return_string .= '</h2>';

    return $return_string;
}

function createAddLinkHeader() {
    $site_url = get_bloginfo("wpurl");

    $return_string = '<div class="wrap nosubsub"><div class="icon32">';
    $return_string .= '<img src="' . $site_url . '/wp-content/plugins/LinkMyPosts/images/lmp-icon.png" height=36 width=36></img>';
    $return_string .= '</div><h2>Add New Post Group</h2>';

    return $return_string;
}

function createEditLinkHeader() {
    $site_url = get_bloginfo("wpurl");

    $return_string = '<div class="wrap nosubsub"><div class="icon32">';
    $return_string .= '<img src="' . $site_url . '/wp-content/plugins/LinkMyPosts/images/lmp-icon.png" height=36 width=36></img>';
    $return_string .= '</div><h2>Edit Post Group';
    $return_string .= createManageButton() . '</h2>';
    return $return_string;
}

function addPostHeader() {
    $site_url = get_bloginfo("wpurl");

    $return_string = '<div class="wrap nosubsub"><div class="icon32">';
    $return_string .= '<img src="' . $site_url . '/wp-content/plugins/LinkMyPosts/images/lmp-icon.png" height=36 width=36></img>';
    $return_string .= '</div><h2>Assign/Un-Assign Posts';
    $return_string .= createManageButton() . '</h2>';
    return $return_string;
}

/* * *******************************************************************************
  Buttons.
 * ******************************************************************************** */

function createAddNewLinkButton() {
    $site_url = get_bloginfo("wpurl");
    $return_string = "<a class='button add-new-h2' href='{$site_url}/wp-admin/admin.php?page=lmp_addLink'>Add New</a>";

    return $return_string;
}

function createManageButton() {
    $site_url = get_bloginfo("wpurl");
    $return_string = "<a class='button add-new-h2' href='{$site_url}/wp-admin/admin.php?page=lmp'>Manage</a>";

    return $return_string;
}

function createLinkTitleListBox($page) {

    $return_string = tableHeader();
    $return_string .= tableFooter();
    $return_string .= tableBody($page);

    return $return_string;
}

function createLinkTableBody($page) {
    $links = getLinks();

    $return_string = '';

    foreach ($links as $link) {
        $return_string .= '<tr class="alternate iedit" id="link-' . $link->ID . '"><td class="post-title page-title column-title"><strong>';
        $return_string .= '<a title="Edit “' . $link->Title . '”" href="' . get_bloginfo("wpurl") . '/wp-admin/admin.php?page=lmp_addPost&amp;addPost_linkID=' . $link->ID . '" class="row-title">' . $link->Title . '</a></strong>';
        $return_string .= '<div class="row-actions"><span class="edit"><a title="Edit this link" href="admin.php?page=lmp_editLink&amp;edit_linkID=' . $link->ID . '">Edit</a> | </span><span class="view"><a rel="permalink" title="Assign Posts for “' . $link->Title . '”" href="' . get_bloginfo("wpurl") . '/wp-admin/admin.php?page=lmp_addPost&amp;addPost_linkID=' . $link->ID . '">Assign Posts</a></span></div>';
        $return_string .= '<td class="comments column-comments"><div class="post-com-count-wrapper">';
        $return_string .= '<span class="comment-count">' . lmp_getLinkTotal($link->ID) . '</span></div></td>';
        $return_string .= '<td class="manage-column column-comments num"><div class="post-com-count-wrapper">';
        $return_string .= '<span class="delete"><a onclick="if ( confirm(\'You are about to delete this link ' . $link->Title . '\n  Cancel to stop, OK to delete.\') ) { return true;}return false;" href="admin.php?action=trash_lmpLink&amp;delete_linkID=' . $link->ID . '&amp;page=' . $page . '" class="submitdelete"><img src="' . get_bloginfo("wpurl") . '/wp-content/plugins/LinkMyPosts/images/lmp-trashcan-icon.png"></a></span></div></td>';
    }

    return $return_string;
}

function addPostsTitleSubHeader($linkID, $linkTitle, $linkedPosts) {
    //Hidden Div to catch spill-over from the_post(). Otherwise all post_id's would show.
?> <div style="visibility: hidden"> <?php
    $site_url = get_bloginfo("wpurl");

    $linkedPosts = $linkedPosts->loadPosts($linkID);

    //Upper Form (Posts that have been added)
    $return_string = '<form method="post" name="currentPostAssignments"><div class="metabox-holder has-right-sidebar" id="poststuff">';
    $return_string .= '<table class="widefat page fixed"><tbody>';

    //Upper Form Header
    $return_string .= 'Posts Currently Assigned to : ' . $linkTitle;
    $return_string .= '<thead><tr><th class="manage-column column-title">Post Title</th></th>';
    $return_string .= '<th colspan="3" width="24%"><DIV ALIGN="CENTER">Position</DIV></th><th><DIV ALIGN="RIGHT">Remove</DIV></th></tr></thead>';
    //$return_string .= '<th width=15%><DIV ALIGN="RIGHT">' . createNavigationButtons("top") . '</DIV></th></tr></thead>';
    //Upper Form Table Body (Content)
    if (!empty($linkedPosts)) {
        foreach ($linkedPosts as $post => $id) {
            $size = lmp_getLinkTotal($linkID);
            $return_string .= '<tr class="alternate iedit"><td class="post-title page-title column-title" style="vertical-align:middle">';
            $return_string .= '<a href="' . get_permalink($id["postID"]) . '">' . $id["title"] . '</a></td>';
            $return_string .= '<td width=8% align="right">' . createUpTopArrowPositionButtons($id["position"], $linkID, $id["postID"], $size) . createUpArrowPositionButtons($id['position'], $linkID, $id['postID'], $size) . '</td>';
            $return_string .= '<td width=8%><DIV ALIGN="CENTER"><input disabled="disabled" style="text-align:center" type="text" size="5" value="' . $id['position'] . '"></input></DIV></td>';
            $return_string .= '<td width=8%>' . createDownArrowPositionButtons($id['position'], $linkID, $id['postID'], $size) . createToBottomArrowPositionButtons($id['position'], $linkID, $id['postID'], $size) . '</td>';
            $return_string .= '<td ALIGN=RIGHT><a href="' . $site_url . '/wp-admin/admin.php?page=lmp_addPost&amp;removePostID=' . $id['postID'] . '&amp;addPost_linkID=' . $linkID . '&amp;Position=' . $id['position'] . '"><img src="' . $site_url . '/wp-content/plugins/LinkMyPosts/images/minus18x18.png" height=12 width=12></img></a></td></tr>';
        }
    } else {
        $return_string .= '<tr class="alternate iedit"><td colspan="3" class="post-title page-title column-title">No Posts are currently assigned.</td><td></td><td></td></tr>';
    }

    //Upper Form Footer
    $return_string .= '<tfoot><tr><th class="manage-column column-title">Post Title</th>';
    $return_string .= '<th colspan="3" width="24%"><DIV ALIGN="CENTER">Position</DIV></th><th><DIV ALIGN="RIGHT">Remove</DIV></th></tr></tfoot>';
    //$return_string .= '<th width=5%><DIV align="RIGHT">' . createNavigationButtons("bottom") . '</DIV></th></tr></tfoot>';

    $return_string .= '</tbody></table></div></form>';

    $return_string .= '<BR>';

    //Lower Form (Posts that can be added)
    $return_string .= '<form method="post" name="availablePosts"><div class="metabox-holder has-right-sidebar" id="poststuff">';
    $return_string .= '<table class="widefat page fixed"><tbody>';

    //Lower Form Header
    $return_string .= '<thead><tr><th class="manage-column column-title">Available Posts for : "' . $linkTitle . '"</th>';
    $return_string .= '<th width=5%><DIV></DIV></th></tr></thead>';

    //Lower Form Body (Content)
    $havePosts = false;

    query_posts('posts_per_page=-1');
    while (have_posts ()) {
        $found = FALSE;
        $havePosts = true;
        the_post();
        $link = get_permalink(the_ID());
        $post = get_post(the_ID());
        $title = $post->post_title;

        if ($linkedPosts != "") {
            $x = 0;
            foreach ($linkedPosts as $linkedPost => $id) {
                $x++;
                if ($id["postID"] == $post->ID) {
                    $found = TRUE;
                }
            }
        }
        if ($found != TRUE) {
            //allow post to be added to group if it does not already belong to a group.
            if ((postLinks($post->ID) == "")) {
                $return_string .= '<tr class="alternate iedit"><td class="post-title page-title column-title"><a href="' . $link . '">' . $title . '</a></td>
               <td ALIGN=RIGHT><a href="' . $site_url . '/wp-admin/admin.php?page=lmp_addPost&amp;addPost_linkID=' . $linkID . '&amp;postID=' . $post->ID . '"><img src="' . $site_url . '/wp-content/plugins/LinkMyPosts/images/plus18x18.png" height=12 width=12></img></a></td></tr>';
            }
            //do not allow post to be added to a group if it already belongs to a group.
            if ((postLinks($post->ID) <> "")) {
                $return_string .= '<tr class="alternate iedit"><td class="post-title page-title column-title"><a href="' . $link . '">' . $title . '</a></td>
               <td ALIGN=RIGHT></td></tr>';
            }
        }
        $found = FALSE;

        if ($havePosts == false) {
            $return_string .= '<td>No Posts are available.</td><td></td>';
        }
    }
    //Lower Form Footer
    $return_string .= '<tfoot><tr><th class="manage-column column-title">Available Posts for : "' . $linkTitle . '"</th>';
    $return_string .= '<th width=5%><DIV></DIV></th></tr></tfoot>';
    $return_string .= '</tbody></table></div></div></div></div></form>';
?> </div> <?php
    return $return_string;
}

function tableHeader() {
    $site_url = get_bloginfo("wpurl");

    /*     * **************************
      Table Header
     * *************************** */
    $return_string = '<div id="linkTitles"><table cellspacing="0" class="widefat page fixed"><BR><BR><thead><tr>';
    $return_string .= '<th style="" class="manage-column column-title" id="link-title" scope="col">Link Title</th>';
    $return_string .= '<th style="" class="manage-column column-comments num" id="comments" scope="col">';
    $return_string .= '<div class="vers"><img src="images/comment-grey-bubble.png" alt=""></div></th>';
    $return_string .= '<th style="" class="manage-column column-comments num" scope="col">';
    $return_string .= '<div class="post-com-count-wrapper"><img src="' . get_bloginfo("wpurl") . '/wp-content/plugins/LinkMyPosts/images/lmp-trashcan-icon.png"></div></th></tr></tfoot></tr></thead>';

    return $return_string;
}

function tableFooter() {
    /*     * **************************
      Table Footer
     * *************************** */

    $return_string = '<tfoot><tr><th style="" class="manage-column column-title" scope="col">Link Title</th>';
    $return_string .= '<th style="" class="manage-column column-comments num" scope="col">';
    $return_string .= '<div class="vers"><img src="images/comment-grey-bubble.png" alt=""></div></th>';
    $return_string .= '<th style="" class="manage-column column-comments num" scope="col">';
    $return_string .= '<div class="post-com-count-wrapper"><img src="' . get_bloginfo("wpurl") . '/wp-content/plugins/LinkMyPosts/images/lmp-trashcan-icon.png"></div></th></tr></tfoot>';

    return $return_string;
}

function tableBody($page) {
    /*     * **************************
      Table Body
     * *************************** */

    $return_string = '<tbody>';
    $return_string .= createLinkTableBody($page);
    $return_string .= '</tbody></table></div>';

    return $return_string;
}

function createUpArrowPositionButtons($currentPosition, $linkID, $postID, $size) {

    $return_string = '';

    //Dont set this if it is the first item in the list.
    if ($currentPosition > 1) {
        $site_url = get_bloginfo("wpurl");

        $return_string = '<a href="' . $site_url . '/wp-admin/admin.php?page=lmp_addPost&amp;UpPostID=' . $postID . '&amp;addPost_linkID=' . $linkID . '&amp;Position=' . $currentPosition . '" id="' . $currentPosition . '" title="' . $linkID . '">';
        $return_string .= '<img src="' . get_bloginfo("wpurl") . '/wp-content/plugins/LinkMyPosts/images/up1.png" alt="UP" title="Move item up 1 spot." width=18 height=18 style="margin: 5px 5px 5px 5px"></img></a>';
    }
    return $return_string;
}

function createUpTopArrowPositionButtons($currentPosition, $linkID, $postID, $size) {

    $return_string = '';

    //Dont set this if it is the first item in the list.
    if ($currentPosition > 1) {
        $site_url = get_bloginfo("wpurl");

        $return_string .= '<a href="' . $site_url . '/wp-admin/admin.php?page=lmp_addPost&amp;TopPostID=' . $postID . '&amp;addPost_linkID=' . $linkID . '&amp;Position=' . $currentPosition . '" id="' . $currentPosition . '" title="' . $linkID . '">';
        $return_string .= '<img src="' . get_bloginfo("wpurl") . '/wp-content/plugins/LinkMyPosts/images/uptop.png" alt="TOP" title="Move item to top of list." width=18 height=18 style="margin: 5px 5px 5px 5px"></img></a>';
    }
    return $return_string;
}

function createDownArrowPositionButtons($currentPosition, $linkID, $postID, $size) {
    $return_string = '';

    if ($currentPosition < $size) {
        $site_url = get_bloginfo("wpurl");

        $return_string .= '<a href="' . $site_url . '/wp-admin/admin.php?page=lmp_addPost&amp;DownPostID=' . $postID . '&amp;addPost_linkID=' . $linkID . '&amp;Position=' . $currentPosition . '" id="' . $currentPosition . '" title="' . $linkID . '">';
        $return_string .= '<img src="' . get_bloginfo("wpurl") . '/wp-content/plugins/LinkMyPosts/images/down1.png" alt="DOWN" title="Move item down 1 spot." width=18 height=18 style="margin: 5px 5px 5px 5px"></img></a>';
    }
    return $return_string;
}

function createToBottomArrowPositionButtons($currentPosition, $linkID, $postID, $size) {

    $return_string = '';

    if ($currentPosition < $size) {
        $site_url = get_bloginfo("wpurl");
        $return_string = '<a href="' . $site_url . '/wp-admin/admin.php?page=lmp_addPost&amp;BottomPostID=' . $postID . '&amp;addPost_linkID=' . $linkID . '&amp;Position=' . $currentPosition . '" id="' . $currentPosition . '" title="' . $linkID . '">';
        $return_string .= '<img src="' . get_bloginfo("wpurl") . '/wp-content/plugins/LinkMyPosts/images/tobottom.png" alt="BOTTOM" title="Move item to bottom of list." width=18 height=18 style="margin: 5px 5px 5px 5px"></img></a>';
    }
    return $return_string;
}