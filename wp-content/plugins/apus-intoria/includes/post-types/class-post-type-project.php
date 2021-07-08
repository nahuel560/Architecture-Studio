<?php
/**
 * Post Type: Project
 *
 * @package    apus-intoria
 * @author     Habq 
 * @license    GNU General Public License, version 3
 */

if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class Apus_Intoria_Post_Type_Project {
	public static function init() {
	  	add_action( 'init', array( __CLASS__, 'register_post_type' ) );
	  	add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'metaboxes' ) );
	}

	public static function register_post_type() {
		$labels = array(
			'name'                  => __( 'Proyectos', 'apus-intoria' ),
			'singular_name'         => __( 'Proyecto', 'apus-intoria' ),
			'add_new'               => __( 'Add New Proyecto', 'apus-intoria' ),
			'add_new_item'          => __( 'Add New Proyecto', 'apus-intoria' ),
			'edit_item'             => __( 'Edit Proyecto', 'apus-intoria' ),
			'new_item'              => __( 'New Proyecto', 'apus-intoria' ),
			'all_items'             => __( 'All Proyectos', 'apus-intoria' ),
			'view_item'             => __( 'View Proyecto', 'apus-intoria' ),
			'search_items'          => __( 'Search Proyecto', 'apus-intoria' ),
			'not_found'             => __( 'No Projects found', 'apus-intoria' ),
			'not_found_in_trash'    => __( 'No Projects found in Trash', 'apus-intoria' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Proyectos', 'apus-intoria' ),
		);
		
		register_post_type( 'project',
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'public'            => true,
		        'has_archive'       => true,
				'show_in_rest'		=> true,
				'rewrite'            => array( 'slug' => 'proyecto' ),
				'menu_icon'         => 'dashicons-admin-post',
			)
		);
	}

	/**
	 *
	 */
	public static function metaboxes( array $metaboxes ) {
		$prefix = APUS_INTORIA_PREFIX;
		
		$metaboxes[ $prefix . 'info' ] = array(
			'id'                        => $prefix . 'info',
			'title'                     => __( 'More Information', 'apus-intoria' ),
			'object_types'              => array( 'project' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => self::metaboxes_info_fields()
		);
		
		return $metaboxes;
	}
	/**
	 *
	 */	
	public static function metaboxes_info_fields() {
		$prefix = APUS_INTORIA_PREFIX;

		$fields = array(
			array(
			    'name' => __( 'Address', 'apus-intoria' ),
			    'id' => $prefix.'address',
			    'type' => 'text',
			)
		);
		
		return apply_filters( 'apus_intoria_postype_project_metaboxes_fields' , $fields, $prefix );
	}
}
Apus_Intoria_Post_Type_Project::init();


