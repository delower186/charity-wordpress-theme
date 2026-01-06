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
/**
 * Summary of get_current_post_page_title from outside of loop
 * @return void
 */
function get_current_post_page_title(){
    $page_id   = get_queried_object_id();
    $page_title = get_the_title($page_id);
    return $page_title;
}
/**
 * Summary of get_current_post_page_thumbnail from outside of loop
 * @return void
 */
function get_current_post_page_thumbnail(){
    
    $page_id   = get_queried_object_id();
    $page_thumb = get_the_post_thumbnail_url($page_id, 'full');

    if ( $page_thumb ) {
        return $page_thumb;
    }

}