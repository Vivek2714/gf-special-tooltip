<?php
/*
Plugin Name: GF Special tooltip
Description: tooltips
version: 1.6
Author: Vivek V.
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( 'GFAPI' ) ) return;

class gfSpecialTooltip{
 
  private static $_instance = null;
  public $_slug         = 'special_tooltip_';
  public $_plugin_title = 'Special Tooltip';
  public function __construct(){ 
    // this filter is used to add the custom field in gravity form
;
    add_action( 'gform_field_standard_settings', [$this,'addSettingFields'], 10, 2 );
    add_action( 'gform_editor_js', [$this,'editorScript'] );
    add_filter( 'gform_tooltips', [$this,'addSpecialTooltips'] );
  }   

  // @addSettingFields() is being used to add HTML fields in the gravity forms field setting under the general tab
  public function addSettingFields( $position, $form_id ) { 
    //create settings on position 25 (right after Field Label)
    if ( $position == -1 ) {
      include dirname( __FILE__ ) . DIRECTORY_SEPARATOR.'viewField.php';
    }
  }

  // @editorScript() is being used to display the setting filed under the general tab
  // Also this function includes the code to add the text of the field
  public function editorScript(){
      ?>
      <script type='text/javascript'>
				addTab = function(elem, id, label) {
				  // add new tab
				  elem.find( 'ul' ).eq(0).append( '<li style="width:100px; padding:0px;"> \
				      <a href="' + id + '">' + label + '</a> \
				      </li>' )
				      
				  // add new tab content
				  elem.append( jQuery( id ) );
				    
				}     	

        //This code is used to display my html field in all gravity form field contant
        jQuery.each(fieldSettings, function(index, value) {
          fieldSettings[index] += ", .SpecialTooltipText , .SpecialTooltipBackgroundColor , .SpecialTooltipFontColor";
          fieldSettings[index] += ", .SpecialTooltipWidth , .SpecialTooltipBorder , .SpecialTooltipBorderWidth";
        });
        

        // This function is used to add Tab in gravity from field
        addTab( jQuery('#field_settings'), '#gform_tab_4', '<?php _e('Tooltip', 'gravityperks') ?>');       

        jQuery(document).on('gform_load_field_settings', function(event, field, form){
          jQuery('#specialTooltipText').val(field.specialTooltipText || '' );
          jQuery('#special_tooltip_background_color').val(field.fieldBackgroundColor || '' );
          jQuery('#special_tooltip_font_color').val(field.fieldFontColor || '' );
          jQuery('#special_tooltip_width').val(field.fieldWidth || '0px' );
          jQuery('#special_tooltip_Border').val(field.fieldBorder || '' );
          jQuery('#SpecialTooltipBorderWidth').val(field.SpecialTooltipBorderWidth || '' );
        });


        jQuery('#specialTooltipText').bind('input propertychange', function() {
          SetFieldProperty('specialTooltipText', jQuery(this).val());
        });  

        jQuery('#special_tooltip_background_color').bind('input propertychange', function() {
          SetFieldProperty('fieldBackgroundColor', jQuery(this).val());
        });  

        jQuery('#special_tooltip_font_color').bind('input propertychange', function() {
          SetFieldProperty('fieldFontColor', jQuery(this).val());
        });  

        jQuery('#special_tooltip_width').bind('input propertychange', function() {
          SetFieldProperty('fieldWidth', jQuery(this).val());
        });

        jQuery('#special_tooltip_Border').bind('input propertychange', function() {
          SetFieldProperty('fieldBorder', jQuery(this).val());
        });  

        jQuery('#SpecialTooltipBorderWidth').bind('input propertychange', function() {
          SetFieldProperty('SpecialTooltipBorderWidth', jQuery(this).val());
        });                                                                        
                         
      </script>
      <?php
  }

  // @addSpecialTooltips() is being used to add the infor text like tooltip to the label of the field in the general tab
  public function addSpecialTooltips( $tooltips ) {
    $tooltips['form_special_tooltip_text']             = "<h6>Special Tooltip Text</h6>Enter field text";
    $tooltips['form_special_tooltip_Background_color'] = "<h6>Background Color</h6>Enter field border color";
    $tooltips['form_special_tooltip_font_color']       = "<h6>Font Color</h6>Enter field font color";
    $tooltips['form_special_tooltip_width']            = "<h6>Width</h6>Enter field width in px";
    $tooltips['form_special_tooltip_Border']           = "<h6>Border</h6> Enter field border";
    $tooltips['SpecialTooltipBorderWidth']             = "<h6>Border Width</h6>Enter field border width in px";
    return $tooltips;
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