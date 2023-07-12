<?php
/**
 * @package p5schema
 * 
 * ACTIVATION HOOKS
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class CptController extends BaseController
{
    public function register(){
        add_action( 'init', array( $this, 'p5SchemaRegisterCustomPostType') );
        add_action( 'add_meta_boxes', array($this, 'p5schemaRegisterMetaBoxes') );
    }
        
    public function p5SchemaRegisterCustomPostType(){
        $labels = array(
            'name'                  => _x( 'P5Schemas', 'Post type general name', 'textdomain' ),
            'singular_name'         => _x( 'P5Schema', 'Post type singular name', 'textdomain' ),
            'menu_name'             => _x( 'P5Schemas', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar'        => _x( 'P5Schema', 'Add New on Toolbar', 'textdomain' ),
            'add_new'               => __( 'Add New', 'textdomain' ),
            'add_new_item'          => __( 'Add New P5Schema', 'textdomain' ),
            'new_item'              => __( 'New P5Schema', 'textdomain' ),
            'edit_item'             => __( 'Edit P5Schema', 'textdomain' ),
            'view_item'             => __( 'View P5Schema', 'textdomain' ),
            'all_items'             => __( 'All P5Schemas', 'textdomain' ),
            'search_items'          => __( 'Search P5Schemas', 'textdomain' ),
            'parent_item_colon'     => __( 'Parent P5Schemas:', 'textdomain' ),
            'not_found'             => __( 'No P5Schemas found.', 'textdomain' ),
            'not_found_in_trash'    => __( 'No P5Schemas found in Trash.', 'textdomain' ),
            'featured_image'        => _x( 'P5Schema Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'archives'              => _x( 'P5Schema archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
            'insert_into_item'      => _x( 'Insert into P5Schema', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this P5Schema', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
            'filter_items_list'     => _x( 'Filter P5Schemas list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
            'items_list_navigation' => _x( 'P5Schemas list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
            'items_list'            => _x( 'P5Schemas list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
        );
    
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'p5Schema_general' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title' ),
        );
        register_post_type( 'p5schema', $args );
    }

    public function p5schemaRegisterMetaBoxes() {
        $page = 'p5schema';
        $context = 'normal';
        $priority = 'high';

        add_meta_box( '', __( 'My Meta Box', 'textdomain' ), array($this,'wp5schemaDisplayCallback'),  $page, $context, $priority);
        //add_meta_box( id, title, callback, screen, context, priority, callback_args );
    }

    public function wp5schemaDisplayCallback(){
        global $wpdb, $post, $id;

        $args = array(
            'post_type'    => array('page', 'post'), 
            'posts_per_page' => -1
        );
        $pageList = new \WP_Query( $args );

        $url = get_post_meta($post->ID, 'url', true); 
        $schema = get_post_meta($post->ID, 'schema', true);

        $type = explode('/', $url);

        $cat_args=array(
            'orderby' => 'name',
            'order' => 'ASC'
             );
        
        $categories = get_categories($cat_args);
         
        ?>
        <div class="row">
            <div class="col-6" style="display: grid">
                <div class="custom-fields">
                    <div class="custom-fields-title">
                        <label for="url">Url:</label>
                    </div>
                    <div class="custom-fields-input">
                        <input type="text" name="url" id="url" value="<?php if(!empty($url)){echo $url;} ?>" placeholder="Add the url manually">
                        <br>
                        <br>
                        <select class="url" name="url-select" id="url-select">
                            <?php 
                                echo '<option value="">Please select an option</option>';
                                //// Page
                                if ( $pageList->have_posts() ) {
                                    while ( $pageList->have_posts() ) { $pageList->the_post();
                                        echo '<option value="'.get_the_permalink().'">'. esc_html( get_the_title() ).' - '.esc_html(get_post_type()) .'</option>';
                                    }
                                }
                                ///// Categories
                                foreach($categories as $category) {
                                    $args=array(
                                      'showposts' => -1,
                                      'category__in' => array($category->term_id),
                                      'caller_get_posts'=>1
                                    );
                                
                                    $posts=get_posts($args);
                                    if ($posts) {
                                        echo '<option value="'.get_category_link( $category->term_id ).'">'. esc_html($category->name) .'</option>'; 
                                    }
                                } // foreach
                            ?>
                        </select>
                    </div>

                </div>
                <div class="reset_button_container">
                    <span class="reset_button button button-primary button-large"> RESET </span>
                </div>
            </div>
            <div class="col-6">
                <div class="custom-fields">
                    <div class="custom-fields-title">
                        <label for="schema">schema:</label>
                    </div>
                    <div class="custom-fields-input">
                        <textarea rows="10" name="schema" id="schema"> <?php echo ($schema) ? $schema : '' ?> </textarea>
                    </div>
                </div>
            </div>
        </div>       
    <?php
    wp_nonce_field( '_namespace_form_metabox_schema', '_namespace_form_metabox_schema_fields' );
    }
}


