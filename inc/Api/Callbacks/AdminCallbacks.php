<?php
/**
 * @package p5schema
 * 
 *  Administration Callbacks area
 */

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;


class AdminCallbacks extends BaseController
{
    //////////////////////////////////////////////////
    public function adminDashboard(){
       return( require_once $this->plugin_path . 'templates/admin.php');
    }
    //////////////////////////////////////////////////
    public function adminSchema(){
        return( require_once $this->plugin_path . 'templates/schema.php');
     }

    //////////////////////////////////////////////////
    public function p5schemaOptionGroup( $input ){
      return $input;
    }
    //////////////////////////////////////////////////
    public function p5schemaSetSections(){
        echo 'check this section';
    }
    //////////////////////////////////////////////////
    public function p5schemaSetFields(){
        $value = esc_attr( get_option( 'p5schema_settings_name' ) );
        echo '<input type="text" class="p5schema_input_text" name="p5schema_settings_name" value="'.$value.'" placeholder="text-input">';
    }

}