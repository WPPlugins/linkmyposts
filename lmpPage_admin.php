<?php
function lmp_adminPage(){
    $result  = createAdminHeader();

    echo $result;

    echo createLinkTitleListBox('admin');
}