<?php
/**
 * @package p5schema
 * 
 * Init plugin
 */

namespace Inc;

final class Init{

    public static function get_services(){
        return [
			Base\Enqueue::class,
			Base\CptController::class,
			Base\SavePostMetaController::class,
			Base\PushSchema::class

        ];
    }

    public static function register_services(){
        foreach (self::get_services() as $class){
			$service = self::instantiate($class);
			if(method_exists($service, 'register')){
				$service->register();
			}
        }
    }

	private static function instantiate($class){
		$service = new $class;
		return $service;
	}

}

/*
 

use Inc\Base\Activate;
use Inc\Base\Deactivate;
use Inc\Pages\Admin;

if( ! class_exists('p5chema')){
	class p5Schema 
	{
		public $pluginName;

		function __construct()
		{
			$this->pluginName = plugin_basename(__FILE__);
		}

		function register(){
			add_action('admin_enqueue_scripts', array($this, 'enqueue'));
			add_action('admin_menu', array($this, 'manage_admin_pages'));
			add_filter("plugin_action_links_$this->pluginName", array($this, 'settings_link'));
		}

		public function settings_link($links){
			$settings_link = '<a href="admin.php?page=p5Schema_general"> Settings </a>';
			array_push($links, $settings_link);
			return $links;
		}

		public function manage_admin_pages(){
			add_menu_page('P5Maketing Schema Manager', 'P5Maketing Schema Manager', 'manage_options', 'p5Schema_general', array($this, 'admin_index'),'dashicons-networking', 110  );
		}

		public function admin_index(){
			require_once plugin_dir_path(__FILE__). 'templates/admin.php';
		}

		public static function enqueue(){
			wp_enqueue_style('white-css', plugins_url('/assets/styles.css',__FILE__), false, 'all');
			wp_enqueue_script('white-js', plugins_url('/assets/styles.js', __FILE__), array(), 1.0, false);
		}

		function CPT(){
			$labels = array(
				'name'                  => _x( 'p5Schemas', 'Post type general name', 'textdomain' ),
				'singular_name'         => _x( 'P5Schema', 'Post type singular name', 'textdomain' ),
				'menu_name'             => _x( 'p5Schemas', 'Admin Menu text', 'textdomain' ),
				'name_admin_bar'        => _x( 'p5Schema', 'Add New on Toolbar', 'textdomain' ),
				'add_new'               => __( 'Add New', 'textdomain' ),
				'add_new_item'          => __( 'Add New p5Schema', 'textdomain' ),
				'new_item'              => __( 'New p5Schema', 'textdomain' ),
				'edit_item'             => __( 'Edit p5Schema', 'textdomain' ),
				'view_item'             => __( 'View p5Schema', 'textdomain' ),
				'all_items'             => __( 'All p5Schemas', 'textdomain' ),
				'search_items'          => __( 'Search p5Schemas', 'textdomain' ),
				'parent_item_colon'     => __( 'Parent p5Schemas:', 'textdomain' ),
				'not_found'             => __( 'No p5Schemas found.', 'textdomain' ),
				'not_found_in_trash'    => __( 'No p5Schemas found in Trash.', 'textdomain' ),
				'featured_image'        => _x( 'p5Schema Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
				'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
				'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
				'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
				'archives'              => _x( 'p5Schema archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
				'insert_into_item'      => _x( 'Insert into p5Schema', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
				'uploaded_to_this_item' => _x( 'Uploaded to this p5Schema', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
				'filter_items_list'     => _x( 'Filter p5Schemas list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
				'items_list_navigation' => _x( 'p5Schemas list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
				'items_list'            => _x( 'p5Schemas list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'p5Schema' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			);
			register_post_type('p5Schema', $args);
		}

		public function activate(){
			Activate::activate();
			register_activation_hook(__FILE__, array('Activate', 'activate'));
		}

		public function deactivate(){
			Deactivate::deactivate();
			register_deactivation_hook(__FILE__, array('Deactivate', 'deactivate'));
		}
		

	}// end class p5Schema 

	$p5Schema = new p5Schema();
	$p5Schema->register();

}
*/