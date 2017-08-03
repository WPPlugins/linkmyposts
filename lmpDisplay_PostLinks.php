<?php

function insertFootNote($content) {
    global $post;

    if ((is_single())) {
        $postLinked = postLink($post->ID);
        if ($postLinked <> '') {
            $linkedPosts = getPosts($postLinked);
            $newContent = "Other Related Posts<BR /><div class='notVisibleLinks'>";
            if (count($linkedPosts) <= 4) {
                foreach ($linkedPosts as $linkedPost) {
                    $actualPost = get_post($linkedPost->postID);
                    $permLink = get_permalink($actualPost->ID);
                    if ($post->ID <> $linkedPost->postID) {
                        $newContent .= "<a class='notVisibleLinks' href='{$permLink}'>{$linkedPost->PagePosition}</a>";
                    } else {
                        $newContent .= "<font class='visibleLink'>{$linkedPost->PagePosition}</font>";
                    }
                }
                $newContent.= "</div>";
                echo $newContent;
            }
            if (count($linkedPosts) > 4) {
                foreach ($linkedPosts as $linkedPost) {
                    $actualPost = get_post($linkedPost->postID);
                    $permLink = get_permalink($actualPost->ID);
                    
                    $currPosition = lmp_queryPosition($postLinked, $post->ID);
                    $bottom = $currPosition - 3;
                    $top = $currPosition + 3;

                    if ($linkedPost->PagePosition == 1) {
                        if (lmp_queryPosition($postLinked, $post->ID) <> 1) {
                            $newContent .= "<a class='notVisibleLinks' href='{$permLink}'><<</a>";
                            if ($currPosition > 3){
                                $newContent .= "<font class='notVisibleLinks'> .. </font>";
                            }
                        }
                    }
                    if (($linkedPost->PagePosition > $bottom) && ($linkedPost->PagePosition < $top)) {
                        if ($post->ID <> $linkedPost->postID) {
                            $newContent .= "<a class='notVisibleLinks' href='{$permLink}'>{$linkedPost->PagePosition}</a>";
                        }
                    }
                    if ($post->ID == $linkedPost->postID) {
                        $newContent .= "<font class='visibleLink'>{$linkedPost->PagePosition}</font>";
                    }
                }

                if (count($linkedPosts) <> lmp_queryPosition($postLinked, $post->ID)) {
                    if ($currPosition < 3){
                        $newContent .= "<font class='notVisibleLinks'> .. </font>";
                    }
                    $newContent .= "<a class='notVisibleLinks' href='{$permLink}'>>></a>";
                }
                $newContent.= "</div>";
                echo $newContent;
            }
        }
    }
    echo $content;
}

function postLink($postID) {
    $isLinked = '';

    $isLinked = postLinks($postID);

    return $isLinked;
}