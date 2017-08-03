<?php
function lmp_trashLink() {
    if (isset($_GET['delete_linkID'])) {
        $linkID = $_GET['delete_linkID'];
        $page = $_GET['page'];

        deleteLinkTitle($linkID);

        if ($page == 'admin') {
            $page = 'admin.php?page=lmp';
        }

        if ($page == 'add') {
            $page = 'admin.php?page=lmp_addLink';
        }

        wp_redirect(admin_url($page));
        die;
    }
}