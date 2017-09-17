<div class="post_icon_wrap">
    <?php screen_icon(); ?>
    <form id="plugin_post_icon" action="options.php" method="post">
    	<?php
                settings_fields( 'post_icon_option_group' );
                do_settings_sections( 'post_icon_setings' );
                submit_button();
        ?>        
    </form>
</div>

