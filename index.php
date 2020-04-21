<?php
/*
Plugin Name: GF Special tooltip
Description: tooltips
version: 1.6
Author: Vivek V.
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class gfSpecialTooltip{

  // Common variables
  public $cfp;  // Current File Path
  public $_slug          = 'special_tooltip_';     // Plugin slug
  public $_plugin_title  = 'Special Tooltip';      // plugin Title
  public $setting_fields = [
    'label'            ,       // Tooltip label
    'text'             ,       // Tooltip description
    'background_color' ,       // Tooltip background
    'font_color'       ,       // Tooltip font color
    'box_width'        ,       // Tooltip box width
    'border_color'     ,       // Tooltip border color
    'position'         ,       // Tooltip position
    'uses'             ,       // Tooltip Display label or input
    'toggle'           ,       // Tooltip Display label or input
  ];


  public function __construct(){ 

    $this->cfp = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

    // Adding settings fields into field settings area
    add_action( 'gform_field_standard_settings', [$this,'addSettingFields'], 10, 2 );

    // Adding javascript to handle setting operation
    add_action( 'gform_editor_js', [$this,'editorScript'] );

    // Creating tooltips for field settings label
    add_filter( 'gform_tooltips', [$this,'addSpecialTooltips'] );

    // Add Css file
    add_action( 'admin_enqueue_scripts', [ $this,'tooltip_style_for_backend' ] );
    add_action( 'wp_enqueue_scripts', [ $this,'enqueue_scripts' ] );

    include $this->cfp.'inc/special-tooltip-handler.php';
  }   

  public function tooltip_style_for_backend(){
   wp_enqueue_style('custom-css-backend',plugin_dir_url(__FILE__).'css/admin-custom.css');
  }

  #############
  public function enqueue_scripts(){
    wp_enqueue_style('font-awesome',plugin_dir_url(__FILE__).'font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('custom-css',plugin_dir_url(__FILE__).'css/custom.css');
  }  

  // @addSettingFields() is being used to add HTML fields in the gravity forms field setting under the new tab
  public function addSettingFields( $position, $form_id ) { 
    if ( $position == -1 ) {
      include $this->cfp.'field-setting.php';
    }
  }

  // @editorScript() is being used to display the setting filed under the new tab
  // Also this function includes the code to add the text of the field
  public function editorScript(){ ?>
  <script type='text/javascript'>
    // Field prefix
    var prefix = '<?php echo $this->_slug; ?>';

    // Setting fields
    var setting_fields = '<?php echo json_encode($this->setting_fields); ?>';   

    addTab = function(elem, id, label) {
      // add new tab
      elem.find( 'ul' ).eq(0).append( '<li style="width:100px; padding:0px;"><a href="' + id + '">' + label + '</a></li>' );
      // add new tab content
      elem.append( jQuery( id ) );
    }      
    // This function is used to add Tab in gravity from field
    addTab( jQuery('#field_settings'), '#gform_spcl_tooltip_tab', '<?php _e('Spcl Tooltip', 'gravityperks') ?>');    

    // Parse field object
    var fields = JSON.parse(setting_fields);

    //This code is used to display my html field in all gravity form field contant
    jQuery.each(fieldSettings, function(index, value) {
      for (i = 0; i < fields.length; i++) {
        fieldSettings[index] += ", ."+prefix+fields[i];
      }
    });   

    // Adding field values
    jQuery(document).on('gform_load_field_settings', function(event, field, form){
      var fieldData = JSON.parse(JSON.stringify(field));
      for (i = 0; i < fields.length; i++) {
        jQuery('#'+prefix+fields[i] ).val( fieldData[prefix+fields[i]] || '' );          
      }        
    });

    // Adding field values on change
    for (var i = 0; i < fields.length; i++) {
      jQuery('#'+prefix+fields[i]).bind('input propertychange', function() {
        SetFieldProperty( jQuery(this).attr('id'), jQuery(this).val());
      }); 
    }        
                                                     
  </script>
  <?php
  }

  // @addSpecialTooltips() is being used to add the infor text like tooltip to the label of the field in the general tab
  public function addSpecialTooltips( $tooltips ) {
    $prefix = $this->_slug;
    $tooltips[ 'form_'.$prefix.'label']            = "<h6>Special Tooltip Label</h6>Enter tooltip label";
    $tooltips[ 'form_'.$prefix.'text']             = "<h6>Special Tooltip Text</h6>Enter tooltip text";
    $tooltips[ 'form_'.$prefix.'uses']             = "Special tooltip use for?";
    $tooltips[ 'form_'.$prefix.'position']          = "<h6>Tooltip Postion</h6>Select tooltip postion";
    $tooltips[ 'form_'.$prefix.'background_color'] = "<h6>Background Color</h6>Select tooltip background color";
    $tooltips[ 'form_'.$prefix.'font_color']       = "<h6>Font Color</h6>Select tooltip font color";
    $tooltips[ 'form_'.$prefix.'box_width']        = "<h6>Width</h6>Enter tooltip box width";
    $tooltips[ 'form_'.$prefix.'border_color']     = "<h6>Border color</h6> Select tooltip border color";
    $tooltips[ 'form_'.$prefix.'border_width']     = "<h6>Border width</h6> Enter tooltip border width";
    return $tooltips;
  }  
}

add_action( 'plugins_loaded', function() {
   
  // Check if Gravity form plugin is activated
  if ( !class_exists( 'GFAPI' ) ) return;

  // Calling class object
  new gfSpecialTooltip();
});