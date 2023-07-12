<?php
/**
 * @package p5schema
 * 
 * ACTIVATION HOOKS
 */

namespace Inc\Base;

 class Activate
 {
    public static function activate(){
        flush_rewrite_rules();
    }

 }