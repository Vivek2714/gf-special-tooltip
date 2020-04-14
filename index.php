<?php
/*
Plugin Name: GF Special tooltip
Description: tooltips
version: 1.6
Author: Vivek V.
*/

class GFSpecialTooltip{

	public function __construct(){

		// check if gravity forms API exists
		if( !class_exists('GFAPI') ){
			return;
		}

		// Adding tooltip option fields
		add_action( 'gform_field_standard_settings', [ $this, 'addSettingFields' ], 10, 2 );
		add_action( 'gform_editor_js', [ $this, 'editorScript' ] );
		add_filter( 'gform_tooltips', [ $this, 'addSpecialTooltips' ] );
	}

	// @addSettingFields() is being used to add HTML fields in the gravity forms field setting under the general tab
	public function addSettingFields( $position, $form_id ) {
		//create settings on position 25 (right after Field Label)
		if ( $position == 25 ) {
			?>
			<li class="special_tooltip_text_class field_setting">
				<label for="field_marketo_label">
					<?php _e("Special Tooltip Text", "gravityforms"); ?>
					<?php gform_tooltip("form_special_tooltip_text"); ?>
				</label>
				<input type="text"  id="special_tooltip_text" class="fieldwidth-3" onfocus="SetFieldProperty('tooltipText', this.value);" value="" size="35"/>
			</li>
			<?php
		}
	}

	// @editorScript() is being used to display the setting filed under the general tab
	// Also this function includes the code to add the text of the field
	public function editorScript(){
		?>
		<script type='text/javascript'>
			jQuery.each(fieldSettings, function(index, value) {
				fieldSettings[index] += ", .special_tooltip_text_class";
			});

	        //binding to the load field settings event to initialize the checkbox
	        jQuery(document).bind("gform_load_field_settings", function(event, field, form) {
	        	console.log( field["tooltipText"] );
				if (typeof field["tooltipText"] !== "undefined") {
					jQuery("#special_tooltip_text").attr("value", field["tooltipText"]);
				} else {
					jQuery("#special_tooltip_text").attr("value", '');
				}
	        });
		</script>
		<?php
	}

	// @addSpecialTooltips() is being used to add the infor text like tooltip to the label of the field in the general tab
	public function addSpecialTooltips( $tooltips ) {
		$tooltips["form_special_tooltip_text"] = "<h6>Special Tooltip Text</h6>Enter the tooltip text";
		return $tooltips;
	}

}

add_action( 'plugins_loaded', function() {
	new GFSpecialTooltip();
});

?>