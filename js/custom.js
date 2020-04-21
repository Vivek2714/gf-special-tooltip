//This function is copied to grvity perk plugins
addTab = function(elem, id, label) {

  //jQuery(elem" > ul").append('<li style="width:110px; padding:0px; "><a href="'+id+'">'+label'</a></li>');

  // var tabClass = id == 'gwp_field_tab';

  // var tabClass    = id.replace( '#', '' ),
  //     altTabClass = tabClass.replace( 'gws', 'gwp' ),
  //     tabClass    = tabClass != altTabClass ? tabClass + ' ' + altTabClass : tabClass;


  // destory tabs already initialized
  //elem.tabs( 'destroy' );

  // add new tab
  elem.find( 'ul' ).eq(0).append( '<li style="width:100px; padding:0px;"> \
      <a href="' + id + '">' + label + '</a> \
      </li>' )
      
  // add new tab content
  elem.append( jQuery( id ) );
    
} 