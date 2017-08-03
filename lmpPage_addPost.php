<?php

require 'lmp_linkedPostsClass.php';

function lmp_addPostPage() {

    if (isset($_GET['addPost_linkID'])) {
        $linkID = $_GET['addPost_linkID'];

        //add a post if postID is passed.
        if (isset($_GET['postID'])) {
            $postID = $_GET['postID'];

            //Dont let users add duplicate entries.
            $isPresent = isPostLinked($postID, $linkID);

            if (($isPresent == NULL)) {
                addPost($postID, $linkID);
            }
        }

        //Get the position of the post if it is passed.
        if (isset($_GET['Position'])) {
            $position = $_GET['Position'];
        }

        //remove a post if a remove post is passed.
        if (isset($_GET['removePostID'])) {
            $postID = $_GET['removePostID'];
            lmp_deleteLinkedPost($linkID, $postID);
            lmp_updateLinkPositionsAfterDelete($linkID, $position);
        }

        $linkedPosts = new lmp_linkedPostsClass();

        if (isset($_GET['TopPostID'])) {
            $postID = $_GET['TopPostID'];
            lmp_updateLinkPositionsMoveToTop($postID, $linkID, $position);
        } elseif (isset($_GET['UpPostID'])) {
            $postID = $_GET['UpPostID'];
            lmp_updateLinkPositionMoveOneSpot($postID, $linkID, $position, 'up');
        } elseif (isset($_GET['DownPostID'])) {
            $postID = $_GET['DownPostID'];
            lmp_updateLinkPositionMoveOneSpot($postID, $linkID, $position, 'down');
        } elseif (isset($_GET['BottomPostID'])) {
            $postID = $_GET['BottomPostID'];
            lmp_updateLinkPositionsMoveToBottom($postID, $linkID, $position);
        }

        $allPosts = getAllPosts();
        $linkTitle = getLinkTitle($linkID);

        echo addPostHeader();
        echo addPostsTitleSubHeader($linkID, $linkTitle, $linkedPosts);
    }
}

/* * *******************************************************************************
  Update Link Positions after a delete.
 * ******************************************************************************** */

function lmp_updateLinkPositionsAfterDelete($linkID, $position) {

    $posts = getPosts($linkID);

    if ($position > 0) {
        if (lmp_getLinkTotal($linkID) > 0) {
            foreach ($posts as $post) {
                $newPosition = $position;
                if ((int) $post->PagePosition >= (int) $position) {
                    lmp_updateLinkPosition($linkID, $post->postID, $newPosition);
                    $newPosition = $newPosition + 1;
                }
            }
        }
    }
}

/* * *******************************************************************************
  Move link to top of the list.
 * ******************************************************************************** */

function lmp_updateLinkPositionsMoveToTop($postID, $linkID, $prevPosition) {
    //Prevent an update if the position matches the previous position.
    if (lmp_queryPosition($linkID, $postID) <> 1) {
        //Update the position of the post that started this call.
        lmp_updateLinkPosition($linkID, $postID, 1);

        $posts = getPosts($linkID);

        $position = 0;

        foreach ($posts as $post) {
            //You do not want to update the post that started this call. It was updated first.
            if ($post->postID <> $postID) {
                //You only want to update the posts that have a lower position than the post that was moved.
                if ($position < $prevPosition) {
                    $position = (int) ($post->PagePosition + 1);

                    lmp_updateLinkPosition($linkID, $post->postID, $position);
                }
            }
        }
    }
}

/* * *******************************************************************************
  Move link to bottom of the list.
 * ******************************************************************************** */

function lmp_updateLinkPositionsMoveToBottom($postID, $linkID, $prevPosition) {

    $count = lmp_getLinkTotal($linkID);

    //Prevent an update if the position matches the previous position.
    if (lmp_queryPosition($linkID, $postID) <> $count) {
        //Update the position of the post that started this call.
        lmp_updateLinkPosition($linkID, $postID, $count);

        $posts = getPosts($linkID);
        $position = $count;

        foreach ($posts as $post) {
            //You do not want to update the post that started this call. It was updated first.
            if ($post->postID <> $postID) {
                //You only want to update the posts that have a lower position than the post that was moved.
                if (($prevPosition < (int) $post->PagePosition) && ($position <> 1)) {
                    $newPosition = (int) $post->PagePosition - 1;

                    lmp_updateLinkPosition($linkID, $post->postID, $newPosition);

                    $position -= 1;
                }
            }
        }
    }
}

/* * *******************************************************************************
  Move link up or down one.
 * ******************************************************************************** */

function lmp_updateLinkPositionMoveOneSpot($postID, $linkID, $prevPosition, $direction) {

    (int) $newPosition = (int) lmp_calculatePosition($prevPosition, $direction);

    //Update the position of the post that started this call.
    lmp_updateLinkPosition($linkID, $postID, $newPosition);

    $posts = getPosts($linkID);

    foreach ($posts as $post) {
        //You do not want to update the post that started this call. It was updated first.
        if ($post->postID <> $postID) {
            if ((int) $post->PagePosition == (int) $newPosition) {
                lmp_updateLinkPosition($linkID, $post->postID, $prevPosition);
            }
        }
    }
}

function lmp_calculatePosition($position, $direction){
    if ($direction == 'up'){
        (int)$position -= 1;
    }
    elseif ($direction == 'down'){
        (int)$position += 1;
    }
    else{
        $position = 0;
    }

    return $position;
}