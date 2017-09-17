<?php

class Post_icon {

    private $options;

    private $icons = array('dashicons-format-aside', 'dashicons-format-image', 'dashicons-format-video');


    public function post_icon_run()   {
        add_action( "admin_menu", array( $this, 'add_page_settings' ) );
        add_action( 'admin_init', array( $this, 'page_setting_init' ) );

        $this->options = get_option('post_icon_option_name');
       
        $this->apply_filter();

    }

    /**
     * apply_filter
     */
    public function apply_filter()
    {
    	add_filter( "the_title", array( $this, 'new_title' ), 10, 2 );
    }

    /**
     * @param  [string] $title Post title
     * @param  [integer] $id    Post ID
     * @return [string]        New post title with icon.
     */
    public function new_title( $title, $id )
    {
    	
    	if ( !empty($this->options['posts_id']) ) {

			if ( in_array($id, $this->options['posts_id'] ) ) {
                $iconWPClass = '';
               
                if ( !empty($this->options['icon']) ) 
                    $iconWPClass = $this->options['icon'];


	    		if ( $this->options['title_position'] == 'left' ) {
					$title = '<span class="dashicons '.$iconWPClass.'"></span>'.$title;
	    		} else {
	    			$title = $title.'<span class="dashicons '.$iconWPClass.'"></span>';
	    		}

			}
    	}
    	
    	return $title;
    }


    /**
     * Add page seting to options page;
     */
    public function add_page_settings() {
    	 add_options_page("Post Icon", "Post Icon", 8, "post_icon_setings", array( $this, 'settings_page' ));
    } 

    /**
     * Include page seting template; 
     */
    public function settings_page() {
    	require plugin_dir_path( __FILE__ ) . '../views/views-post-icon-setings.php';
    } 


    /**
     * Register page setings 
     */
    public function page_setting_init() {
        register_setting(
            'post_icon_option_group',
            'post_icon_option_name',
            array( $this, 'validation' )
        );

        add_settings_section(
            'setting_section_id',
            'Post Icon Settings',
            array( $this, 'print_section_info' ),
            'post_icon_setings'
        );  

        add_settings_field(
            'icon',
            'Icon',
            array( $this, 'icon_callback' ),
            'post_icon_setings',
            'setting_section_id'          
        );      

        add_settings_field(
            'position', 
            'Position', 
            array( $this, 'position_callback' ), 
            'post_icon_setings', 
            'setting_section_id'
        ); 

        add_settings_field(
            'posts', 
            'Posts', 
            array( $this, 'posts_calback' ), 
            'post_icon_setings', 
            'setting_section_id'
        );       	
    }

    /** 
     * Validate values
     */
    public function validation( $input )
    {
        $new_input = array();

        if( isset( $input['icon'] ) )
            $new_input['icon'] = $input['icon'];
			
        if( isset( $input['title_position'] ) )
            $new_input['title_position'] = $input['title_position'];
		
        if( isset( $input['posts_id'] ) )
					$new_input['posts_id'] = $input['posts_id'];

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        echo __('Enter your settings below:');
    }

    /** 
     * Get the setting option Icon style 
     */
    public function icon_callback()
    {
			$activeIcon = '';
    	if ( !empty( $this->options['icon'] ) ) {
    		$activeIcon = $this->options['icon'];
    	}

		$html = '<div id="wp-icons" data-icon="'.$activeIcon.'" >';

    	foreach ($this->icons as $icon) {
    		$html .= '<div class="icon-wrap">';
    		$html .= '<input id="'.$icon.'" class="wp-icons" type="radio" name="post_icon_option_name[icon]" value="'.$icon.'"><label for="'.$icon.'"><div class="dashicons '.$icon.'"></div></label>';
				$html .= '</div>';

    	}
		$html .= '</div>';
        print $html; 
    }

    /** 
     * Get the settings option for position icon
     */
    public function position_callback()
    {

    	$position_left = '';
    	$position_right = '';


    	if ( $this->options['title_position'] == 'left' || empty($this->options['title_position']) ) {
    		$position_left = 'checked';
    	} else {
    		$position_right = 'checked';
    	}

        $html = '<div class="radio">';

				$html .= '<input id="left_position" type="radio" name="post_icon_option_name[title_position]" value="left" '.$position_left.'><label for="left_position">'.__("Left").'</label>'; 

				$html .= '<input id="righ_position" type="radio" name="post_icon_option_name[title_position]" value="right" '.$position_right.'><label for="righ_position">'.__("Right").'</label>'; 
        $html .= '</div>';

        print $html;
    }

    /** 
     * Get the settings option for posts title
     */

    public function posts_calback()
    {
    	$args = array(
    		'post_type' => array('post', 'product'),
    		'numberposts' => -1,
    	);

    	$posts = get_posts($args); 

    	if ( !empty($posts) ) :
					$checked = '';
    	$html = '<ul>';

    	foreach ($posts as $post) {

    		if ( !empty($this->options['posts_id']) && in_array($post->ID, $this->options['posts_id']) ) {
				$checked = 'checked';
    		}

    		$html .= 	'<li>
    						<input id="post_'.$post->ID.'" type="checkbox" name="post_icon_option_name[posts_id][]" value="'.$post->ID.'"'.$checked.' >'.
    						'<label for="post_'.$post->ID.'">'.$post->post_title.
    					'</li>';
    		$checked = '';
    	}
    		wp_reset_postdata();
			
            $html .= '</ul>';
    		print $html;    
    	endif;
    }

}

?>