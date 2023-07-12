<?php
/**
 * @package p5Schema
 * Plugin Name:  P5Maketing Schema Manager
 * Description: Add custom schema
 * Version: 1.1.1
 * Author: P5Maketing Team
 * Text Domain: p5Schema
 */


if ( ! defined( 'ABSPATH' ) ) { die( 'Invalid request.' ); }

if(file_exists(dirname(__FILE__).'/vendor/autoload.php')){
	require_once dirname(__FILE__).'/vendor/autoload.php';
}


use Inc\Base\Activate;
use Inc\Base\Deactivate;

function activate_schema_plugin(){
	Activate::activate();
}

function deactivate_schema_plugin(){
	Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'activate_schema_plugin' );
register_deactivation_hook(__FILE__, 'deactivate_schema_plugin' );



if(class_exists('Inc\\Init')){
	Inc\Init::register_services();
}