<div id="gform_tab_4">  
  <ul id="tooltipFieldContainer">
    <li class="SpecialTooltipText field_setting">
      <label for="SpecialTooltipText" class="section_label">
        <?php esc_html_e( 'Text', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_special_tooltip_text' ) ?>
      </label>    
      <textarea id="specialTooltipText" placeholder="Enter Description" class="fieldwidth-3 fieldheight-2" onkeypress="SetFieldProperty('specialTooltipText', this.value);"></textarea>
    </li>  

    <li class="SpecialTooltipBackgroundColor field_setting">
      <label for="SpecialTooltipBackgroundColor" class="section_label">
        <?php esc_html_e( 'Background Color', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_special_tooltip_Background_color' ) ?>
      </label>      
      <input type="color" id="special_tooltip_background_color" class="fieldwidth-3" size="35" onclick="SetFieldProperty('fieldBackgroundColor', this.value);" />
    </li> 

    <li class="SpecialTooltipFontColor field_setting">
      <label for="SpecialTooltipFontColor" class="section_label">
        <?php esc_html_e( 'Font Color', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_special_tooltip_font_color' ) ?>
      </label>      
      <input type="color" id="special_tooltip_font_color" class="fieldwidth-3" size="35" onclick="SetFieldProperty('fieldFontColor', this.value);" />
    </li>   

    <li class="SpecialTooltipWidth field_setting">
      <label for="SpecialTooltipWidth" class="section_label">
        <?php esc_html_e( 'Width', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_special_tooltip_width' ) ?>
      </label>      
      <input type="text" id="special_tooltip_width" placeholder="0px" class="fieldwidth-5" size="15" onclick="SetFieldProperty('fieldWidth', this.value);" />
    </li>  

    <li class="SpecialTooltipBorder field_setting">
      <label for="SpecialTooltipBorder" class="section_label">
        <?php esc_html_e( 'Border', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_special_tooltip_Border' ) ?>
      </label>       
      <input type="text" id="special_tooltip_Border" placeholder="1px solid #000" class="fieldwidth-3" size="35" onclick="SetFieldProperty('fieldBorder', this.value);" />
    </li> 

    <li class="SpecialTooltipBorderWidth field_setting">
      <label for="SpecialTooltipBorderWidth" class="section_label">
        <?php esc_html_e( 'Border Width', 'gravityforms' ); ?>
        <?php gform_tooltip( 'SpecialTooltipBorderWidth' ) ?>
      </label>       
      <input type="text" id="SpecialTooltipBorderWidth" placeholder="Border Width" class="fieldwidth-3" size="35" onclick="SetFieldProperty('SpecialTooltipBorderWidth', this.value);" />
    </li>
  </ul>   
</div>