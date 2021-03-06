<?php $prefix = $this->_slug; ?>
<div id="gform_spcl_tooltip_tab">  
  <ul id="spcl_tooltip_container">
    <li class="<?php echo $prefix.'label'; ?> field_setting">
      <label for="<?php echo $prefix.'label'; ?>" class="section_label">
        <?php esc_html_e( 'Tooltip Label', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_'.$prefix.'label' ); ?>
      </label>    
      <input id="<?php echo $prefix.'label'; ?>" placeholder="Enter Label" class="fieldwidth-3" size="35" onkeypress="SetFieldProperty('<?php echo $prefix.'label'; ?>', this.value);">
    </li>      
    <li class="<?php echo $prefix.'text'; ?> field_setting">
      <label for="<?php echo $prefix.'text'; ?>" class="section_label">
        <?php esc_html_e( 'Tooltip Text', 'gravityforms' ); ?>
        <?php gform_tooltip( 'form_'.$prefix.'text' ); ?>
      </label>    
      <textarea id="<?php echo $prefix.'text'; ?>" placeholder="Enter Description" class="fieldwidth-3 fieldheight-2" onkeypress="SetFieldProperty('<?php echo $prefix.'text'; ?>', this.value);"></textarea>
    </li> 
    <li class="<?php echo $prefix.'toggle'; ?> field_setting">        
      <div class="<?php echo $prefix.'tabs'; ?>">
        <div class="<?php echo $prefix.'tab'; ?>">
          <input type="checkbox" id="chck1">
          <label class="<?php echo $prefix.'tab_label'; ?> section_label" for="chck1">
            <p><?php esc_html_e( $this->_plugin_title.' Addvance Fields', 'gravityforms' ); ?></p>
            <span></span>
          </label>
           <div class="<?php echo $prefix.'tab_content'; ?>">
              <ul id="spcl_tooltip_container">
                <li class="<?php echo $prefix.'uses'; ?> field_setting">
                  <label for="<?php echo $prefix.'uses'; ?>" class="section_label">
                    <?php esc_html_e( 'Tooltip use for?', 'gravityforms' ); ?>
                    <?php gform_tooltip( 'form_'.$prefix.'uses' ) ?>
                  </label>
                  <select id="<?php echo $prefix.'uses'; ?>" name="<?php echo $prefix.'uses'; ?>" onchange="SetFieldProperty('<?php echo $prefix.'uses'; ?>', this.value);" class="fieldwidth-1"/>
                    <option value=""><?php _e('Tooltip use for ?', 'mtfgf'); ?></option>
                    <option value="label"><?php _e('Label', 'mtfgf'); ?></option>
                    <option value="field"><?php _e('Field', 'mtfgf'); ?></option>
                  </select>       
                </li>   

                <li class="<?php echo $prefix.'animation'; ?> field_setting">
                  <label for="<?php echo $prefix.'animation'; ?>" class="section_label">
                    <?php esc_html_e( 'Tooltip Animation', 'gravityforms' ); ?>
                    <?php gform_tooltip( 'form_'.$prefix.'animation' ) ?>
                  </label>
                  <select id="<?php echo $prefix.'animation'; ?>" name="<?php echo $prefix.'animation'; ?>" onchange="SetFieldProperty('<?php echo $prefix.'animation'; ?>', this.value);" class="fieldwidth-1"/>
                    <option value=""><?php _e('Tooltip Animation', 'mtfgf'); ?></option>
                    <?php
                      foreach (['fade','grow','swing','slide','fall'] as $aValue) { ?>
                        <option value="<?php echo $aValue; ?>"><?php _e(ucfirst($aValue), 'mtfgf'); ?></option>
                    <?php  } ?>
                  </select>       
                </li>                      

                <li class="<?php echo $prefix.'position'; ?> field_setting">
                  <label for="<?php echo $prefix.'position'; ?>" class="section_label">
                    <?php esc_html_e( 'Tooltip Position', 'gravityforms' ); ?>
                    <?php gform_tooltip( 'form_'.$prefix.'position' ) ?>
                  </label>
                  <select id="<?php echo $prefix.'position'; ?>" name="<?php echo $prefix.'position'; ?>" onchange="SetFieldProperty('<?php echo $prefix.'position'; ?>', this.value);" class="fieldwidth-1"/>
                    <option value=""><?php _e('Tooltip position', 'mtfgf'); ?></option>
                    <?php foreach (['top','bottom','left','right'] as $position) { ?>
                      <option value="<?php echo $position; ?>"><?php _e(ucfirst($position), 'mtfgf'); ?></option>
                    <?php } ?>
                  </select>       
                </li>   

                <li class="<?php echo $prefix.'trigger'; ?> field_setting">
                  <label for="<?php echo $prefix.'trigger'; ?>" class="section_label">
                    <?php esc_html_e( 'Tooltip Trigger', 'gravityforms' ); ?>
                    <?php gform_tooltip( 'form_'.$prefix.'trigger' ) ?>
                  </label>
                  <select id="<?php echo $prefix.'trigger'; ?>" name="<?php echo $prefix.'trigger'; ?>" onchange="SetFieldProperty('<?php echo $prefix.'trigger'; ?>', this.value);" class="fieldwidth-1"/>
                    <option value=""><?php _e('Tooltip trigger', 'mtfgf'); ?></option>
                    <?php foreach (['click','hover'] as $trigger) { ?>
                      <option value="<?php echo $trigger; ?>"><?php _e(ucfirst($trigger), 'mtfgf'); ?></option>
                    <?php } ?>
                  </select>       
                </li>                     

                <li class="<?php echo $prefix.'background_color'; ?> field_setting">
                  <label for="<?php echo $prefix.'background_color'; ?>" class="section_label">
                    <?php esc_html_e( 'Tooltip Background Color', 'gravityforms' ); ?>
                    <?php gform_tooltip( 'form_'.$prefix.'background_color' ) ?>
                  </label>      
                  <input type="color" id="<?php echo $prefix.'background_color'; ?>" class="fieldwidth-1" size="35" onclick="SetFieldProperty('<?php echo $prefix.'background_color'; ?>', this.value);" />
                </li> 

                <li class="<?php echo $prefix.'font_color'; ?> field_setting">
                  <label for="<?php echo $prefix.'font_color'; ?>" class="section_label">
                    <?php esc_html_e( 'Tooltip Font Color', 'gravityforms' ); ?>
                    <?php gform_tooltip( 'form_'.$prefix.'font_color' ) ?>
                  </label>      
                  <input type="color" id="<?php echo $prefix.'font_color'; ?>" class="fieldwidth-1" size="35" onclick="SetFieldProperty('<?php echo $prefix.'font_color'; ?>', this.value);" />
                </li>   

                <li class="<?php echo $prefix.'box_width'; ?> field_setting">
                  <label for="<?php echo $prefix.'box_width'; ?>" class="section_label">
                    <?php esc_html_e( 'Tooltip Box Width (in integer)', 'gravityforms' ); ?>
                    <?php gform_tooltip( 'form_'.$prefix.'box_width' ) ?>
                  </label>     
                  Max Width: <input type="number" id="<?php echo $prefix.'box_max_width'; ?>" style="width:30%;" placeholder="200px"value="200px" onclick="SetFieldProperty('<?php echo $prefix.'box_width'; ?>', this.value);" />  
                  Min Width: <input type="number" id="<?php echo $prefix.'box_min_width'; ?>" placeholder="200px"value="200px" style="width:30%;" onclick="SetFieldProperty('<?php echo $prefix.'box_width'; ?>', this.value);" />
                </li>  

                <li class="<?php echo $prefix.'border_color'; ?> field_setting">
                  <label for="<?php echo $prefix.'border_color'; ?>" class="section_label">
                    <?php esc_html_e( 'Tooltip Border Color', 'gravityforms' ); ?>
                    <?php gform_tooltip( 'form_'.$prefix.'border_color' ) ?>
                  </label>       
                  <input type="color" id="<?php echo $prefix.'border_color'; ?>" placeholder="#000" class="fieldwidth-1" size="35" onclick="SetFieldProperty('<?php echo $prefix.'border_color'; ?>', this.value);" />
                </li>    
              </ul>
           </div>
        </div>
      </div>
    </li>     
  </ul>   
</div>