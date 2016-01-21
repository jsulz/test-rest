<?php
/*
	Plugin Name: Test Rest
	Plugin URI: https://profiles.wordpress.org/jsulz
	Description: Plugin for testing the WP REST API
	Author: Jared Sulzdorf
	Version: 1.0.0
	Author URI: https://profiles.wordpress.org/jsulz
 */
	
// Peace out if you're trying to access this up front
if( ! defined( 'ABSPATH' ) ) exit;

//If this class don't exist, make it so
if( ! class_exists( 'TEST_REST' ) ) {

	class TEST_REST {

		private static $instance;

			//the magic
	        public static function instance() {

	            if( ! self::$instance ) {

	                self::$instance = new TEST_REST();
	                self::$instance->plugin_constants();
	                self::$instance->plugin_requires();
	                self::$instance->test_rest_load_plugin_textdomain();
	                add_action('wp_enqueue_scripts', array( self::$instance, 'load_all_scripts' ) );

	            }

	            return self::$instance;

	        }

	    //the constants (folders and such)
		public function plugin_constants() {

			define('TEST_REST_FOLDER', plugin_dir_path( __FILE__ ) );
			define('TEST_REST_INC', trailingslashit( TEST_REST_FOLDER . 'inc' ) );
			define('TEST_REST_CSS', trailingslashit( TEST_REST_FOLDER . 'css' ) );
			define('TEST_REST_JS', trailingslashit( TEST_REST_FOLDER . 'js' ) );	
			define('TEST_REST_CLIENT', TEST_REST_INC . 'client.php' );

		}

		//the files
		public function plugin_requires() {

			require( TEST_REST_CLIENT );

		}
		//in case someone wants to translate stuff 
		public function test_rest_load_plugin_textdomain() {

	    	load_plugin_textdomain( 'text-domain', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		}

		public function load_all_scripts() {

			if ( is_single() && is_main_query() ) {

				wp_enqueue_style( 'test-rest-styles', plugin_dir_url( __FILE__ ) . 'css/styles.css', array(), '0.1', 'all' );
				//wp_enqueue_script( 'javascript', TEST_REST_JS . 'script.js' , $deps, $ver, $in_footer );

			}

		}
		
	}

}

//get this show on the road
function test_rest () {
    return TEST_REST::instance();
}

add_action( 'plugins_loaded', 'test_rest' );


?>