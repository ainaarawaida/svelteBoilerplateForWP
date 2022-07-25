<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       svelteBoilerplate
 * @since      1.0.0
 *
 * @package    Svelteboilerplate
 * @subpackage Svelteboilerplate/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Svelteboilerplate
 * @subpackage Svelteboilerplate/public
 * @author     Luqman Nordin <me@luqmannordin.com>
 */
class Svelteboilerplate_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Svelteboilerplate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Svelteboilerplate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/svelteboilerplate-public.css', array(), $this->version, 'all' );
		$files = glob(SVELTEBOILERPLATE_PATH . '/my-app/dist/assets/*.css');
		
		foreach ($files AS $key => $val){
			wp_enqueue_style( 'svelte_my-app#'.$key , SVELTEBOILERPLATE_URL.'/my-app/dist/assets/' . basename($val) , array(), null, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Svelteboilerplate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Svelteboilerplate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/svelteboilerplate-public.js', array( 'jquery' ), $this->version, false );
		$files = glob(SVELTEBOILERPLATE_PATH . '/my-app/dist/assets/*.js');
		
		foreach ($files AS $key => $val){
			wp_enqueue_script( 'svelte_my-app#'.$key , SVELTEBOILERPLATE_URL.'/my-app/dist/assets/' . basename($val) , array(), null, true );
		}
		wp_localize_script( 'svelte_my-app#'.$key, 'frontend_ajax_object',
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'statuslogin' => wp_get_current_user()
			)
		);
	}


	public function add_type_attribute($tag, $handle, $src) {
		// if not your script, do nothing and return original $tag
		if (strpos($handle, 'svelte_my-app') !== false) {
			$tag = '<script type="module" crossorigin src="' . esc_url( $src ) . '"></script>';
			return $tag;
		}
		
		return $tag;
	}

}
