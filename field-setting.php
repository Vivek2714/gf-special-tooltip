<?php $prefix = $this->_slug; ?>
<div id="gform_spcl_tooltip_tab">  
  <ul id="spcl_tooltip_container">
    <li class="<?php echo $prefix.'text'; ?> field_setting">
      <label for="<?php echo $prefix.'text'; ?>" class="section_label">
        <?php esc_html_e( 'Tooltip Text', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_'.$prefix.'text' ); ?>
      </label>    
      <textarea id="<?php echo $prefix.'text'; ?>" placeholder="Enter Description" class="fieldwidth-3 fieldheight-2" onkeypress="SetFieldProperty('<?php echo $prefix.'text'; ?>', this.value);"></textarea>
    </li>  

    <li class="<?php echo $prefix.'background_color'; ?> field_setting">
      <label for="<?php echo $prefix.'background_color'; ?>" class="section_label">
        <?php esc_html_e( 'Tooltip Background Color', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_'.$prefix.'background_color' ) ?>
      </label>      
      <input type="color" id="<?php echo $prefix.'background_color'; ?>" class="fieldwidth-3" size="35" onclick="SetFieldProperty('<?php echo $prefix.'background_color'; ?>', this.value);" />
    </li> 

    <li class="<?php echo $prefix.'font_color'; ?> field_setting">
      <label for="<?php echo $prefix.'font_color'; ?>" class="section_label">
        <?php esc_html_e( 'Tooltip Font Color', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_'.$prefix.'font_color' ) ?>
      </label>      
      <input type="color" id="<?php echo $prefix.'font_color'; ?>" class="fieldwidth-3" size="35" onclick="SetFieldProperty('<?php echo $prefix.'font_color'; ?>', this.value);" />
    </li>   

    <li class="<?php echo $prefix.'box_width'; ?> field_setting">
      <label for="<?php echo $prefix.'box_width'; ?>" class="section_label">
        <?php esc_html_e( 'Tooltip Box Width (in px)', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_'.$prefix.'box_width' ) ?>
      </label>      
      <input type="text" id="<?php echo $prefix.'box_width'; ?>" placeholder="200px"value="200px" class="fieldwidth-3" size="35" onclick="SetFieldProperty('<?php echo $prefix.'box_width'; ?>', this.value);" />
    </li>  

    <li class="<?php echo $prefix.'border_color'; ?> field_setting">
      <label for="<?php echo $prefix.'border_color'; ?>" class="section_label">
        <?php esc_html_e( 'Tooltip Border Color', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_'.$prefix.'border_color' ) ?>
      </label>       
      <input type="color" id="<?php echo $prefix.'border_color'; ?>" placeholder="#000" class="fieldwidth-3" size="35" onclick="SetFieldProperty('<?php echo $prefix.'border_color'; ?>', this.value);" />
    </li> 

    <li class="<?php echo $prefix.'border_width'; ?> field_setting">
      <label for="<?php echo $prefix.'border_width'; ?>" class="section_label">
        <?php esc_html_e( 'Tooltip Border Width (in px)', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_'.$prefix.'border_width' ) ?>
      </label>     
      <input type="text" id="<?php echo $prefix.'border_width'; ?>" placeholder="1px" class="fieldwidth-3" size="35" onclick="SetFieldProperty('<?php echo $prefix.'border_width'; ?>', this.value);" />
    </li>
  </ul>   
</div>