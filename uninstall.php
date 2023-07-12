<?php
/**
 * Unistall and delete db
 * @package p5schema
 * 
 **/

 if( ! defined('WP_UNINSTALL_PLUGIN')){
    die;
 }

$suscriptors = get_posts(array('post_type'=>'suscriptor', 'numerposts'=> -1));

foreach ($suscriptors as $key => $suscriptor) {
  wp_delete_post($suscriptor->ID, true);
}
