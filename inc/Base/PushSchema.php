<?php
/**
 * @package p5schema
 * 
 * Push Schema by page
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class PushSchema{
    public function register(){
        add_action('wp_head', array($this, 'pushSchemaByPage'), 1);
    }

    public function pushSchemaByPage(){
        global $wp, $post;
        $current_url = '';
        $url = '';
        $array = [];
        $current_url = home_url( $wp->request );

        $args = array(
            'post_type' => 'p5schema',
            'numberposts'      => -1
        );

        $posts = get_posts($args);

        foreach($posts as $post){
            
            $url = get_post_meta($post->ID, 'url', true);
            $schema = get_post_meta($post->ID, 'schema', true );
            
            if( $current_url.'/' == $url){
                $html = '<script type="application/ld+json" class="p5schemaJson">';
                $html .= $schema;
                $html .= '</script>';
                echo $html;
            }
        }
    }
}