<?php


class Post_icon_deactivator {

    public static function deactivation() {
        delete_option('post_icon_option_name');
    }
}

?>