<?php

class lmp_linkedPostsClass {

    function loadPosts($linkID) {
        $linkedPosts[] = array("position", "postID", "title", "guid");

        if (lmp_getLinkTotal($linkID) > 0) {
            $posts = getPosts($linkID);

            $x = 0;

            foreach ($posts as $post) {
                $linkedPosts[$x] = array('postID' => $post->postID, 'position' => lmp_queryPosition($linkID, $post->postID), 'title' => get_the_title($post->postID), 'guid' => get_the_guid($post->postID));
                $x++;
            }

            return ($linkedPosts);
        }
    }

}