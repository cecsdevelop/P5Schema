<?php
/**
* Save the metabox
* @param  Number $post_id The post ID
* @param  Array  $post    The post data
*/

/**
 * @package p5schema
 * 
 * ACTIVATION HOOKS
 */

namespace Inc\Base;

use \Inc\Base\BaseController;
use \Inc\Base\CptController;

class SavePostMetaController{

    public function register(){
        add_action( 'save_post', array($this, 'save_schema_custom_fields'), 1, 2 );
    }

    public function save_schema_custom_fields( $post_id, $post ) {
        /*print_r($_POST);
        exit();
        die();*/
        // Verify that our security field exists. If not, bail.
        if ( !isset( $_POST['_namespace_form_metabox_schema_fields'] ) ) return;
     
        // Verify data came from edit/dashboard screen
        if ( !wp_verify_nonce( $_POST['_namespace_form_metabox_schema_fields'], '_namespace_form_metabox_schema' ) ) {
            return $post->ID;
        }
     
        // Verify user has permission to edit post
        if ( !current_user_can( 'edit_post', $post->ID )) {
            return $post->ID;
        }
        
        
         if ( !isset( $_POST['url'] ) ) {
             return $post->ID;
         }
         if ( !isset( $_POST['schema'] ) ) {
             return $post->ID;
         }
        
         $sanitized_url       = wp_filter_post_kses( $_POST['url'] );
         update_post_meta( $post->ID, 'url', $sanitized_url );
         // Save and update url
         $sanitized_schema       = wp_filter_post_kses( $_POST['schema'] );
         update_post_meta( $post->ID, 'schema', $sanitized_schema );
     }

}


