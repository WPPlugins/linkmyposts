<?php
function lmp_addPost(){
    if ((isset($_GET['postID'])) && (isset($_GET['linkID'])) && (isset($_GET['linkID']))) {
        $postID = $_GET['postID'];
        $linkID = $_GET['linkID'];
        if (($postID == NULL) || ($postID == "")){
            echo "<div id='error' class='error'>An error was encountered with the post you selected (postID).</div>";
        }
        if (($linkID == NULL) || ($linkID == "")){
            echo "<div id='error' class='error'>An error was encountered with the post you selected (linkID).</div>";
        }

        ?><script type="text/javascript">
            <!--
            window.location = "<?php echo get_bloginfo('siteurl').'/wp-admin/admin.php?page=lmp_addPost&addPost_linkID='.$linkID?>"
            //-->
         </script>
<?php
//        wp_redirect(get_bloginfo('siteurl').'/wp-admin/admin.php?page=lmp');
//        die();
    }
        ?><script type="text/javascript">
            <!--
            window.location = "<?php echo get_bloginfo('siteurl').'/wp-admin/admin.php?page=lmp_addPost&addPost_linkID='.$linkID?>"
            //-->
         </script>
<?php
}