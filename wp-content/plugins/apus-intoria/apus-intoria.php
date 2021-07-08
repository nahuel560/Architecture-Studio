<?php
/**
 * Plugin Name: Apus Intoria
 * Plugin URI: http://apusthemes.com/apus-intoria/
 * Description: Powerful plugin to create a project on your website.
 * Version: 1.0.0
 * Author: Habq
 * Author URI: http://apusthemes.com/
 * Requires at least: 3.8
 * Tested up to: 5.2
 *
 * Text Domain: apus-intoria
 * Domain Path: /languages/
 *
 * @package apus-intoria
 * @category Plugins
 * @author Habq
 */
if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

if ( !class_exists("Apus_Intoria") ) {
	
	final class Apus_Intoria {

		private static $instance;

		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Apus_Intoria ) ) {
				self::$instance = new Apus_Intoria;
				self::$instance->setup_constants();
				self::$instance->load_textdomain();

				self::$instance->includes();
			}

			return self::$instance;
		}
		/**
		 *
		 */
		public function setup_constants(){
			define( 'APUS_INTORIA_PLUGIN_VERSION', '1.0.0' );

			define( 'APUS_INTORIA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			define( 'APUS_INTORIA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			define( 'APUS_INTORIA_PREFIX', 'project_' );
		}

		public function includes() {
			// post type
			require_once APUS_INTORIA_PLUGIN_DIR . 'includes/post-types/class-post-type-project.php';
			require_once APUS_INTORIA_PLUGIN_DIR . 'includes/taxonomies/class-taxonomy-project-categories.php';

			//
			require_once APUS_INTORIA_PLUGIN_DIR . 'includes/class-template-loader.php';
			require_once APUS_INTORIA_PLUGIN_DIR . 'includes/class-mixes.php';
		}

		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for Apus_Intoria's languages directory
			$lang_dir = APUS_INTORIA_PLUGIN_DIR . 'languages/';
			$lang_dir = apply_filters( 'apus_intoria_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-intoria' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-intoria', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apus-intoria/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apus-intoria folder
				load_textdomain( 'apus-intoria', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apus-intoria/languages/ folder
				load_textdomain( 'apus-intoria', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-intoria', false, $lang_dir );
			}
		}
	}
}

function Apus_Intoria() {
	return Apus_Intoria::getInstance();
}

add_action( 'plugins_loaded', 'Apus_Intoria' );