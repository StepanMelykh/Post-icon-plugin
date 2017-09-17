<?php


class Post_icon_activator {

    public static function activation() {
    	$args = array (
    		'title_position' => 'left',
    		'posts_id' => array(),
    		'icon' => '',
    	);

        update_option('post_icon_option_name', $args);
    }
}

?>