<?php
/*
Plugin Name: GF Special Tooltip
Description: GF Special Tooltip
Author: IDS
Version: 1.1
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( class_exists( 'GFAPI' ) ) return;

class gfSpecialTooltip{
  
  private static $_instance = null;
  public function __construct(){
    // ini_set('display_startup_errors', 1);
    // ini_set('display_errors', 1);
    // error_reporting(-1);    


    // this filter is used to add the custom field in gravity form
    add_filter( 'gform_field_standard_settings', [$this,'AddHTMLField'], 10, 2 );

    // add_action( 'gform_field_advanced_settings', [$this,'tooltip_input'], 10, 2 );
    // add_action( 'gform_editor_js', [$this,'editor_script'] );
    // add_filter( 'gform_tooltips', [$this,'add_encryption_tooltips'] );



    // add_filter( 'gform_form_settings', [$this,'add_form_setting'], 10, 2 );    

    // add_filter( 'gform_tabindex_1', [$this,'change_tabindex'] );
    // add_filter( 'gform_settings_menu', [$this,'tab_settting'] );

    // add_filter( 'gform_tooltips', array( $this, 'tooltips' ) );
    // add_action( 'gform_field_appearance_settings', array( $this, 'field_appearance_settings' ), 10, 2 );    

  } 

  public function AddHTMLField( $position, $form_id ) {

    //create settings on position 25 (right after Field Label)
    if ( $position == 50 ) {
      ?>     
      <li class="tooltip_input field_setting" style="display:list-item !important">
        <label for="tooltip_input" class="section_label">
          <?php esc_html_e( 'Shubham', 'gravityforms' ); ?>
        </label>
        <input type="text" id="tooltip_input"  /> 
      </li>
      <?php
    }
  }

  public static function instance () {
    if ( is_null( self::$_instance ) )
      self::$_instance = new self();
    return self::$_instance;
  } // End instance()

}

function gfSpecialTooltip(){
  return gfSpecialTooltip::instance();
}

add_action( 'plugins_loaded', function() {
  gfSpecialTooltip();
});