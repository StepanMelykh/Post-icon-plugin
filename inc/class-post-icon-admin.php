<?php


class Post_icon_Admin {

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( "admin_enqueue_scripts", array( $this, 'enqueue_styles') );
		add_action( "admin_enqueue_scripts", array( $this, 'enqueue_scripts') );

	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../css/styles.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../js/script.js', array( 'jquery' ), $this->version, false );

	}

}
