<?php

function lmp_editLink(){
    if (isset($_GET['edit_linkID'])) {
        $linkID = $_GET['edit_linkID'];
        echo createEditLinkHeader();
        echo editLinkTitle($linkID);

        if(isset($_POST['new_link_name'])) {
            $linkTitle = $_POST['new_link_name'];
            $error = checkLinkRules($linkTitle);

            //add Link to db if no errors exist.
            if ($error != true) {
                updateLinkRules($linkTitle, $linkID);
            }

            $location = admin_url('admin.php?page=lmp');

             ?>
            <script type="text/javascript">
                <!--
                window.location= <?php echo "'" . $location . "'"; ?>;
                //-->
            </script>
            <?php
        }
    }
}