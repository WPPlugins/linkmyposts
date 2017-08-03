<?php
function checkLinkRules($LinkTitle) {

    $error = false;

    //Link Title cannot be blank.
    if ($LinkTitle == "") {
        $return = "<div id='error' class='error'><p>Error: The Link title you supplied was empty.</p></div>";
        $error = true;
    }
    else {
        $LinkArray = getLinks();
        //Check to make sure the Link name does not exist.
        foreach ($LinkArray as $Link) {
            if ($Link->Title == $LinkTitle) {
                $return = "<div id='error' class='error'><p>Error: The Link title you supplied already exists. Please try another name.</p></div>";
                $error = true;
                break;
            }
        }
    }

    return $error;
}

function makeLinkRules($LinkTitle) {
    $return = "<div id='message' class='updated fade'><p>Your Link title has been added to the Link list.</p></div>";

    $result = makeLink($LinkTitle);
    // Make sure the database insert was successful. If not, inform the user.
    if (($result == 0) || ($result == FALSE)) {
        $return = "<div id='error' class='error'><p>Error: There was a problem with the database. Your link was not saved.</p></div>";
        $error = true;
    }

    return $return;
}

function updateLinkRules($LinkTitle, $linkID) {
    $return = "<div id='message' class='updated fade'><p>Your Link title has been updated.</p></div>";

    $result = updateLink($LinkTitle, $linkID);
    // Make sure the database insert was successful. If not, inform the user.
    if (($result == 0) || ($result == FALSE)) {
        $return = "<div id='error' class='error'><p>Error: There was a problem with the database. Your link was not saved.</p></div>";
        $error = true;
    }

    return $return;
}