<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// This file is use to handle of the special tooltip plugin code
class gfSpecialTooltipHandler{
  public $_slug_name;
  public function __construct(){ 
    // Slug Name
    $this->_slug_name = 'special_tooltip_';

    // ini_set('display_startup_errors', 1);
    // ini_set('display_errors', 1);
    // error_reporting(-1);

    // this hook is used to display the custom html in front end
    add_filter( 'gform_field_content', array( $this, 'gfAddField' ), 10, 5 );
  }

  # this is used to add HTML in field 

  public function gfAddField( $field_container, $field, $value, $lead_id, $form_id ) {

    if(is_admin()){
      return $field_container;
    }

    $slug    =  $this->_slug_name;
    $formID  = $form_id;
    $fieldID = $field->id;  

    // Dynamic tooltip css add  
    $css = 'background-color: '.$field[$slug.'background_color'].'; '.'color: '.$field[$slug.'font_color'].'; '.'width: '.$field[$slug.'box_width'];

    $tooltipUses = !empty($field[$slug.'uses']) ? $field[$slug.'uses'] : 'label';
    $required    = ($field->isRequired) ? '<span class="gfield_required">*</span>' : '';
    $position    = (empty($field[$slug.'position'])) ? 'right' : $field[$slug.'position'];
    $trigger     = (empty($field[$slug.'trigger'])) ? 'hover' : $field[$slug.'trigger'];

    // Tooltip HTML
    $tooltip = '<span class="'.$slug.'custom_tooltip '.$slug.$trigger.'">
      <input type="checkbox" class="'.$slug.'active_click">
      <span class="'.$slug.'tooltiptext '.$slug.$position.'" style="'.$css.'">'.$field[$slug.'text'].'</span>
    </span>';

    if($tooltipUses == 'field'){
      $required = ""; // reset variable
      # this condition is find the field and then now appned tooltip html
      // foreach (['input','select','textarea'] as $htmlField) {
      //   if(strstr($field_container,'<'.$htmlField) !=false){
      //     $field_container = str_replace("<{$htmlField}" ,"{$tooltip} <{$htmlField}", $field_container);
      //     //$field_container .= $tooltip;
      //   }
      // }
      # append custom html in gravity forms form field at front end
      $field_container = str_replace("</div>" ,"{$tooltip} </div>", $field_container);
      $tooltip         = ""; // reset variable
    }

    if(!empty($field[$slug.'label'])){
      $addHTML = $field[$slug.'label'].$tooltip.$required;
      $field_container .= '
        <label class="'.$slug.'label'.' gfield_label" for="input_'.$formID.'_'.$fieldID.'">'.trim(preg_replace('/[\t\n\r\s]+/',' ', $addHTML)).'</label>';
    }

    return $field_container;
  }
}
new gfSpecialTooltipHandler();