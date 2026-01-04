<?php 
/***
*
* Excertp Limit
*/
function charity_excerpt_limit($limit, $contents){
    $excerpt = strip_tags($contents);
    if (strlen($excerpt) > $limit) {
        $excerpt = substr($excerpt, 0, $limit) . '...';
    }
    return $excerpt;
}