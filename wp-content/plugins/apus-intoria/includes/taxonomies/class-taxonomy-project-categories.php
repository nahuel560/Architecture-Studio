<?php
/**
 * Taxonomy: Category
 *
 * @package    apus-intoria
 * @author     Habq 
 * @license    GNU General Public License, version 3
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Apus_Intoria_Taxonomy_Categories{

	/**
	 *
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
	}

	/**
	 *
	 */
	public static function definition() {
		$labels = array(
			'name'              => __( 'Categories', 'apus-intoria' ),
			'singular_name'     => __( 'Category', 'apus-intoria' ),
			'search_items'      => __( 'Search Categories', 'apus-intoria' ),
			'all_items'         => __( 'All Categories', 'apus-intoria' ),
			'parent_item'       => __( 'Parent Category', 'apus-intoria' ),
			'parent_item_colon' => __( 'Parent Category:', 'apus-intoria' ),
			'edit_item'         => __( 'Edit', 'apus-intoria' ),
			'update_item'       => __( 'Update', 'apus-intoria' ),
			'add_new_item'      => __( 'Add New', 'apus-intoria' ),
			'new_item_name'     => __( 'New Category', 'apus-intoria' ),
			'menu_name'         => __( 'Categories', 'apus-intoria' ),
		);

		register_taxonomy( 'project_category', 'project', array(
			'labels'            => apply_filters( 'apusintoria_taxomony_category_labels', $labels ),
			'hierarchical'      => true,
			'query_var'         => 'project-category',
			'rewrite'           => array( 'slug' => __( 'project-category', 'apus-intoria' ) ),
			'public'            => true,
			'show_ui'           => true,
			'show_in_rest'		=> true
		) );
	}
}

Apus_Intoria_Taxonomy_Categories::init();