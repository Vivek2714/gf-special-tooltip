jQuery(document).ready(function($) {
	var slug   = gf_special_tooltip_advance.slug;
	var fields = gf_special_tooltip_advance.tooltipFields;

  $.each( fields, function( elem, field ){	
  	// console.log(field[slug+'uses']);
  	// if(field[slug+'uses'] == 'field'){
   //    $('.'+slug+field[slug+'uses']).parents().append('<span class="'+slug+'custom_tooltip '+elem+'"></span>');
  	// }
  	
	  $('.'+elem).tooltipster({
	  	theme: ['tooltipster-noir', 'tooltipster-noir-customized'],
	  	contentAsHTML: true,
			content: field[slug+'text']          || '',
			animation: field[slug+'animation']   || 'fade',
		  maxWidth:field[slug+'box_max_width'] || '',
		  minWidth:field[slug+'box_min_width'] || '',			
			trigger: field[slug+'trigger']       || 'hover',
			side: field[slug+'position']         || 'left'
		})
  });

});