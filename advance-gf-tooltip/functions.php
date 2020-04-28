<?php
/*
Plugin Name: Advance GF Special tooltip
Description: tooltips
version: 1.1
Author: Shubham.
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class advanceGFSpecialTooltip{

  // Common variables
  public $_directory_path;
  public $_directory_url;  
  public $_slug          = 'special_tooltip_'; // Plugin slug
  public $_plugin_title  = 'Special Tooltip';  // plugin Title
  public $setting_fields = [
    'label'            ,       // Tooltip label
    'text'             ,       // Tooltip description
    'box_width'        ,       // Tooltip box width
    'box_max_width'    ,       // Tooltip max box width
    'box_min_width'    ,       // Tooltip min box width
    'trigger'          ,       // Tooltip Trigger
    'position'         ,       // Tooltip position
    'uses'             ,       // Tooltip Display label or input
    'toggle'           ,       // Tooltip Display label or input
    'animation'        ,       // Tooltip Display label or input
  ];


  public function __construct(){ 
   
    $this->_directory_path = dirname( __FILE__ ) . DIRECTORY_SEPARATOR; // Current Directory Path
    $this->_directory_url  = plugin_dir_url(__FILE__);

    // Adding settings fields into field settings area
    add_action( 'gform_field_standard_settings', [$this,'addSettingFields'], 10, 2 );

    // Adding javascript to handle setting operation
    add_action( 'gform_editor_js', [$this,'editorScript'] );

    // Creating tooltips for field settings label
    add_filter( 'gform_tooltips', [$this,'addSpecialTooltips'] );

    // Add Css file
    add_action( 'admin_enqueue_scripts', [ $this,'adminEnqueueScripts' ] );

    // enqueue script
    add_action( 'gform_enqueue_scripts', [ $this,'enqueueScripts' ] ,10,2); 

    // Add content 
    add_filter( 'gform_field_content', array( $this, 'gfAddField' ), 10, 5 );
  }   

  public function adminEnqueueScripts(){
   wp_enqueue_style($this->_slug.'custom-css-backend',$this->_directory_url.'css/admin-custom.css');
  }

  #############
  public function enqueueScripts($form,$is_ajax ){

    $tooltipFVC = [];  // Selected Tooltip value Container
    $tooltipFV  = [];
    foreach ($form['fields'] as $Fkey => $Fvalue) {
      $formID  = $Fvalue->formId;
      $fieldID = $Fvalue->id;
      foreach ($this->setting_fields as $Fname) {
        $tooltipFV[$this->_slug.$Fname] = $Fvalue[$this->_slug.$Fname];
      }
      $tooltipFVC[$this->_slug.$formID.'_'.$fieldID] = $tooltipFV;      
    }
    wp_enqueue_style($this->_slug.'font_awesome',plugin_dir_url(__FILE__).'font-awesome/css/font-awesome.min.css');
    wp_enqueue_style($this->_slug.'custom',plugin_dir_url(__FILE__).'css/custom.css');    
    wp_enqueue_style($this->_slug.'tooltipster.bundle',$this->_directory_url.'css/tooltipster.bundle.min.css');
    wp_enqueue_script($this->_slug.'tooltipster.bundle',$this->_directory_url.'js/tooltipster.bundle.js');      
    wp_enqueue_script($this->_slug.'custom',$this->_directory_url.'js/custom.js'); 
    wp_localize_script($this->_slug.'custom', 'gf_'.$this->_slug.'advance', array(
      'slug'          => $this->_slug,
      'tooltipFields' => $tooltipFVC
    ));
  }  

  # this is used to add HTML in field 

  public function gfAddField( $field_container, $field, $value, $lead_id, $form_id ) {

    if(is_admin()){
      return $field_container;
    } 
    $slug    =  $this->_slug; 
    $formID  = $form_id;
    $fieldID = $field->id;  

    // Tooltip HTML
    $tooltip     = '<span class="'.$slug.'custom_tooltip '.$slug.$formID.'_'.$fieldID.'"></span>';
    $tooltipUses = !empty($field[$slug.'uses']) ? $field[$slug.'uses'] : 'label';
    $required    = ($field->isRequired) ? '<span class="gfield_required">*</span>' : '';
    $position    = (empty($field[$slug.'position'])) ? 'right' : $field[$slug.'position'];

    if($tooltipUses == 'field'){
      $required = ""; // reset variable
      # this condition is find the field and then now appned tooltip html
      foreach (['input','select','textarea'] as $htmlField) {
        if(strstr($field_container,'<'.$htmlField) !=false){
          $field_container = str_replace("<{$htmlField}" ,"{$tooltip} <{$htmlField}", $field_container);
          //$field_container .= $tooltip;
        }
      }
      $tooltip = ""; // reset variable
    }

    if(!empty($field[$slug.'label'])){
      $field_container .= '
        <label class="'.$slug.'label'.' gfield_label " for="input_'.$formID.'_'.$fieldID.'">'.$field[$slug.'label'].$tooltip.' '.$required.'</label>';
    }

    return $field_container;
  }  

  // @addSettingFields() is being used to add HTML fields in the gravity forms field setting under the new tab
  public function addSettingFields( $position, $form_id ) { 
    if ( $position != -1 ) {return;}
    $fieldSetting = $this->_directory_path.'field-setting.php';
    if (file_exists($fieldSetting)) {
      include_once $fieldSetting;
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
    $tooltips[ 'form_'.$prefix.'animation']        = "Tooltip Animation";
    $tooltips[ 'form_'.$prefix.'position']         = "<h6>Tooltip Postion</h6>Select tooltip postion";
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
  new advanceGFSpecialTooltip();
});