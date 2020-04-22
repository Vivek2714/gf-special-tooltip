<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// This file is use to handle of the special tooltip plugin code

class gfSpecialTooltipHandler{

  public $_slug_name  = 'special_tooltip_';     // Plugin slug
	public function __construct(){ 
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    // this hook is used to display the custom html in front end
    add_filter( 'gform_field_content', array( $this, 'gfAddFIeld' ), 10, 5 );
    add_filter( 'gform_field_input',array( $this, 'gfInputfieldTracker' ), 10, 5 );
	}   


  # this form is used to 
  # input ki html ko replace krke ussi jagah pr new html add krta hai
  function gfInputfieldTracker( $field_container, $field, $value, $lead_id, $form_id ) {
    if(is_admin()){
      return $field_container;
    }
    $slug    =  $this->_slug_name;
    $formID  = $form_id;
    $fieldID = $field->id;    
    $css     = 'background-color: '.$field[$slug.'background_color'].'; '.'color: '.$field[$slug.'font_color'].'; '.'width: '.$field[$slug.'box_width'];
    
    $ids       = $formID.'_'.$fieldID;
    $attrFId   = 'input_'.$ids;
    $attrFname = 'input_'.$fieldID;
    $tag       = "";

    $required    = ($field->isRequired) ? '<span class="gfield_required">*</span>' : '';
    if ( $field[$slug.'uses'] == 'field') {
      $html = '<div class="ginput_container ginput_container_'.$field->type.'">';
      switch ($field->type) {
        case 'textarea':
          $tag = '<textarea name="'.$attrFname.'" id="'.$attrFId.'" class="textarea medium" aria-describedby="gfield_description'.$ids.'" aria-invalid="false" rows="10" cols="50"></textarea>';
        break;
        case 'text':
          $tag = '<input name="'.$attrFname.'" id="'.$attrFId.'" type="text" class="medium" aria-describedby="gfield_description_'.$ids.'" aria-invalid="false">';
        break;
        default:
        return $field_container;
        break;
      }
      $html .= $tag;
      $html .= '<span class="'.$slug.'custom_tooltip"><span class="'.$slug.'tooltiptext '.$slug.$field[$slug.'position'].'" style="'.$css.'">'.$field[$slug.'text'].'</span> </span>';      
      $html .= '</div>';
      $html .= '<label class="'.$slug.'label'.' gfield_label" for="input_'.$formID.'_'.$fieldID.'">'.$field[$slug.'label'].'</label>';
      $field_container .= sprintf( $html, $field->labelPlacement);  
    } 

    return $field_container;
  }  

  # this is used to add HTML in field 
  public function gfAddFIeld( $field_container, $field, $value, $lead_id, $form_id ) {

    if(is_admin()){
      return $field_container;
    }

    $slug    =  $this->_slug_name;
    $formID  = $form_id;
    $fieldID = $field->id;    
    $css     = 'background-color: '.$field[$slug.'background_color'].'; '.'color: '.$field[$slug.'font_color'].'; '.'width: '.$field[$slug.'box_width'];
    
    $tooltipUses = !empty($field[$slug.'uses']) ? $field[$slug.'uses'] : 'label';
    $required    = ($field->isRequired) ? '<span class="gfield_required">*</span>' : '';
    if($tooltipUses == 'label'){
      $field_container .= '
        <label class="'.$slug.'label'.' gfield_label" for="input_'.$formID.'_'.$fieldID.'">'.$field[$slug.'label'].'
          <span class="'.$slug.'custom_tooltip">
            <span class="'.$slug.'tooltiptext '.$slug.$field[$slug.'position'].'" style="'.$css.'">'.$field[$slug.'text'].'</span>
          </span>
          '.$required.'
        </label>';
    }
    return $field_container;
  }
 	 
}

new gfSpecialTooltipHandler();