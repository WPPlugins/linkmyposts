<?php

function lmp_addLinkPage() {
    echo createAddLinkHeader();
    echo "<BR>";
    echo createLinkTitle();
    echo createLinkTitleListBox('add');

    if(isset($_POST['addLinkTitle'])) {
        $linkTitle = $_POST['link_name'];
        $error = checkLinkRules($linkTitle);

        //add Link to db if no errors exist.
        if ($error != true) {
            makeLinkRules($linkTitle);
        }

        $location = admin_url('admin.php?page=lmp_addLink');

         ?>
        <script type="text/javascript">
            <!--
            window.location= <?php echo "'" . $location . "'"; ?>;
            //-->
        </script>
        <?php
    }
}