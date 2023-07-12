<?php
/**
 * @package p5schema
 * 
 *  CSS and JS
 */

 namespace Inc\Base;

 use \Inc\Base\BaseController;

 class Enqueue extends BaseController
 {
    public  function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    public function enqueue(){
        wp_enqueue_style('p5schema-css', $this->plugin_url . 'assets/styles.css', false, 'all');
        wp_enqueue_script('p5schema-js', $this->plugin_url . 'assets/styles.js', array(), 1.0, false);
    }

 }