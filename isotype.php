<?
// cookie cutter api script

// isince this script alwayds outputs svg set the header as svg
Header('Content-type: image/svg+xml; charset=utf-8');

// set needed arrays constants etc
$variables   = array();
$adjustments = array();


// require / include needed external files
// config file
require "config.cfg";
// svg details file
require "svg_include.php";
// input processing
require "process_inputs.php" ;

// process the inputs
if ($allow_get == TRUE )  { $variables = process_get($_GET) ; }
if ($allow_post == TRUE ) { $variables = process_post($_POST) ; }







// Build functions
// the functions below 
//--------------------------------------------------------------------------------------------------------------------------------------

// SVG header and footer functions
Function quickvis_svg_header($variables) {
  $output  = '';
  // header +DOCTYPE statments
  $output .= '<?xml version="1.0" encoding="utf-8"';
  $output .= "?> ";
  $output .= "\n";
  $output .= "\n";
  $output .= '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">';
  $output .= "\n";
  $output .= '<svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"';
  $output .= ' width="'.$variables['width'].'" height="'.$variables['height'].'" viewBox="0 0 202.394 363.119" enable-background="new 0 0 202.394 363.119"';
  $output .= '  xml:space="preserve"> ';
  $output .= "\n";
  return $output;
}
//end of svg header function

Function quickvis_svg_footer() {
  $result='</svg>';
  return $result;
}
//end of svg footer function
//-------------------------------
// function to get the path and dimensions of an icon

// this function builts the icon information giving a single colour to the icon
// function returns the path with all needed style options
function isotype_build_solid_style($icon,$colour) {
	
}

// this function builds the icon
// function returns the path with all needed style options
function isotype_build_gradient_style($icon,$colour1, $colour2, $value) {
	
}

//

// old function for building all visii, will be broken up
//function to build image 
function quickvis_build_image($variables, $adjustments) {
  $quickvis_values=array();
  
  //labels adjustment values
  if ($variables['showlabels'] == TRUE ) { $variables['labels_adjust'] = '1.2' ;
  }
  else {                                  
  $variables['labels_adjust'] = '1'   ; 
  }
    //labels adjustment value
  if ($variables['showheader'] == TRUE ) {
  $variables['header_adjust'] = '1.2' ; }
  else {                                
  $variables['header_adjust'] = '1'   ; }
  //key adjustment value
    if ($variables['showkey']  == TRUE ) { 
    $variables['key_adjust']   = '1.2' ; }
  else {                                    
  $variables['key_adjust']   = '1'   ; }
  
  // some quickvis options have custom values ( due to usage of diferent icon types )
  // we assign these statically

// start all other cases
// TEST CODE
if (  ( $variables['type']!= 'family') && ( $variables['type'] !='couple') ) { $quickvis_svg_builder  = ''; }
// end of all other cases


 return $quickvis_svg_builder;
}

function quick_vis_tile($variables,$adjustments) {
	$icon_type=$adjustments['type'];

  // flat colour
  if ($adjustments['color'] != 'gradient') {
    $defs           = '';
    $defs_path      =  '';
    $style          =' style="stroke-width:2; stroke:black; fill:'.$adjustments['color'].';" ';
  }
  
	// will define style $defs_path and $defs
  $output='';
  $output.="\n";

  $output.=' <g font-family="Verdana" font-size="34" ';
  $output.=' transform="translate('.$adjustments['xadj'].' , '.$adjustments['yadj'].' ) " stroke="black" stroke-width="2"> ';
  $output.="\n";
  $output.=$variables['gradients']['icon']['1']['defs'];

  $output.='	<path  '. $variables['gradients']['icon']['1']['defspath'] . $variables[$icon_type]['path'].' style='. $variables['gradients']['icon']['1']['style'].' />';
  $output.="\n";

  $output.='</g>';
  $output.="\n";
  return $output ;		
}
// end of tile function
// end of build image functions

//----------------------------------------------------------------

 echo quickvis_build_image($variables,$adjustments) ;
 
 
 
 
 // older or non-functional functions below
 //-------------------------------------------------------------------------------------
 /*
 function for creating gradients

1. check which values are applicable for that icon
2.a. if only one set as a solid colour
	2b. if multiple values
	3. check direction of values
	4. calculate gradient positions
	4. apply applicable gradients

this function will deal with individual icons, or icons that can be dealt with as a group,
for instance  x/y sets of values on a single row, each row can be passed through this

*/	

function create_gradients($variables,$adjustments) {
	$gradient_output = array();
	$gradient_output['icon']['1']['defs']='';
	if (!isset( $colourset) or (  $colourset=='') ){
       $colourset =1 ;	
    }
    $value_counter='1';
    $numgradients='1';
    $gradient = FALSE;
// get the colour palettes
// DEV NOTE - Assumes that iriss vis is installed



// check number of icons and gradient type
  if ( ($variables['numicons'] == 1 ) or ( $variables['visstyle'] == 'total_gradient' ) ) {	
    $gradient_output['icon']['1']['start'] = '0';
    $gradient_output['icon']['1']['end'] = '100' ; 	
    
        // check for horizontal /vertical gradient
    if ( $variables['grad_dir'] == 'horizontal' ) {
      $gradient_output['icon']['1']['lineargradient'] ='<linearGradient id="MyGradient" x1="0%" y1="0%" x2="100%" y2="0%" >';
    } else {
       $gradient_output['icon']['1']['lineargradient'] ='<linearGradient id="MyGradient" x1="0%" y1="0%" x2="0%" y2="100%" >';
    } 
 
    $colourset=$variables['palette']['value'];


    
    while ( $value_counter<= $variables['numvalues']) {
	   
         $gradient_output['icon']['1']['defs'] .='<stop offset="'.$variables['%value'. $value_counter].'%" stop-color="'.$variables['palette'][$colourset][$numgradients].'" /><stop offset="'.($variables['%value'.$value_counter]+1).'%" stop-color="'.$variables['palette'][$colourset][($numgradients+1)].'" />';  
      	 $gradient=TRUE;
      	   $numgradients++;
       
       $value_counter++;
    }
    //end of while  loop
    if ( $gradient == FALSE ) {
      	 $gradient_output['icon']['1']['style'] ='"stroke-width:2; stroke:black; fill:'.$variables['palette'][$colourset][$numgradients].'; "'; 
      	 $gradient_output['icon']['1']['defs'] ='';
      	  $gradient_output['icon']['1']['defspath']  ='';
    }
    else {
       	 $gradient_output['icon']['1']['style'] ='"stroke-width:2; stroke:black;"';
         $gradient_output['icon']['1']['defspath']     =' fill="url(#MyGradient)"';
       	 $gradient_output['icon']['1']['defs'] =' <defs> '. $gradient_output['icon']['1']['lineargradient'].' <stop offset="0%" stop-color="'.$variables['palette'][$colourset]['1'].'" />'. $gradient_output['icon']['1']['defs'].' <stop offset="100%" stop-color="'.$variables['palette'][$colourset][$numgradients].'" /> </linearGradient> </defs> ';  
    }  
  }
  // end of total gradient if
  
  
  
  if ( ( $variables['numicons'] > 1  ) or  ($variables['visstyle'] != 'total_gradient' )) {

    // set range for each icon
    $range_counter=1;
    $last_value=0;
    while ( $range_counter <= $variables['numicons']) {
	  $range_step                                 = 100/$variables['numicons']  ;
      $gradient_output['icon'][$range_counter]['start'] = $last_value                 ;
      $gradient_output['icon'][$range_counter]['end']   = $range_counter*$range_step  ;
      $last_value                                 = $range_counter*$range_step  ;
      $range_counter++;
    }	

    $icon_counter=1;
    while ( $icon_counter <= $variables['numicons']) {
      $value_counter                                = 1;

     $gradient_output['icon'][$icon_counter]['defs'] = '';
     $gradient_output['icon'][$icon_counter]['defspath']     = ' fill="url(#MyGradient)"'; 
       $numgradients= 0;
       
       // start value loop ofor each icon
      while ( $value_counter <=$variables['numvalues'] ) {
        if (($variables['%value'.$icon_counter] > $gradient_output['icon'][$icon_counter]['start']) &&
            ($variables['%value'.$icon_counter] < $gradient_output['icon'][$icon_counter]['end'])  ){
	      $numgradients++;
      	  $gradient_output['icon'][$icon_counter]['defs'] .='';  
      	  $gradient=TRUE;

        }  		
         $value_counter++;
      }
      // end value loop for each icon
      
      // if gradient is true
      
      // do final adjustments for each icon
      if ( $gradient == FALSE ) {
      	$gradient_output['icon'][ $icon_counter]['style'] ='stroke-width:2; stroke:black; fill:blue;';
      	 $gradient_output['icon'][$icon_counter]['defs'] ='<defs></defs>'; 
      }
      else {
       	$gradient_output['icon'][ $icon_counter]['style'] ='stroke-width:2; stroke:black; fill:blue;';
       	 $gradient_output['icon'][$icon_counter]['defs'] =' <defs> '.' <stop offset="0%" stop-color="'.$variables['palette'][$colourset]['1'].'" />'. $gradient_output['icon'][$icon_counter]['defs'].' <stop offset="100%" stop-color="'.$variables['palette'][$colourset]['1'].'" /> </linearGradient> </defs> ';  
      }
      	 $icon_counter++;
   }
//end of per icon  loop
    }
//end of multiple icons

  return  $gradient_output;
  }
  

  // end of  gradients function
  //-------------------------------------------------------------//------------------------------------------------------------------------------------

 
 
 
?>