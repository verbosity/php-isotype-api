<?
// cookie cutter api script

// isince this script alwayds outputs svg set the header as svg
Header('Content-type: image/svg+xml; charset=utf-8');

/*
*input processing
*/
$variables   = array();
$adjustments = array();
	
// check the type is set
if (isset($_GET['type']) && $_GET['type']!='')                { $variables['type']         = $_GET['type']; } 
else                                                          { $variables['type']         = 'couple'; }

// check arrangement
// note Arrangement can be overridden dependant on numicons
if (isset($_GET['arrangement']) && $_GET['arrangement']!='')  { $variables['arrangement']  = $_GET['arrangement']; }
else                                                          { $variables['arrangement']  = 'block'; }

// values building
// check the number of values
if (isset($_GET['numvalues']) && $_GET['numvalues']!='')      { $variables['numvalues']    = $_GET['numvalues']; } 
if(!isset($_GET['numvalues']) or ($_GET['numvalues']=='0') )  { $variables['numvalues']    = 1; }

// api numvalues fix
if ($variables['numvalues'] == '0')                           { $variables['numvalues']    = '1'; }
// check the number of icons ( not always applicable)
if (isset($_GET['numicons']) && ($_GET['numicons']!='' ) )    { $variables['numicons']     = $_GET['numicons'];   } 
if(!isset($_GET['numicons']) or ($_GET['numicons']=='0') )    { $variables['numicons']     = 1; }
if (isset($_GET['value1'])   )                                { $variables['value1']       = $_GET['value1'] ;} 
else                                                          { $variables['value1']       = 50 ;}

if ($variables['value1']== 0 )                                { $variables['value1']       = 50 ;}
		
if (isset($_GET['yvalue1'])   )                               { $variables['yvalue1']      = $_GET['yvalue1'] ;} 
else                                                          { $variables['yvalue1']      = 0 ; } 

// headers & labels
if (isset($_GET['showheader']) && $_GET['showheader']==1)     { $variables['showheader']   = TRUE ;}
else                                                          { $variables['showheader']   = FALSE;}

if (isset($_GET['showlabels']) && $_GET['showlabels']==1)     { $variables['showlabels']   = TRUE;}
else                                                          { $variables['showlabels']   = FALSE;}

if (isset($_GET['showkey']) && $_GET['showkey']==1)           { $variables['showkey']      = TRUE;}
else                                                          { $variables['showkey']      = FALSE;}

if (isset($_GET['showvalues']) && $_GET['showvalues']==1)     { $variables['showvalues']   = TRUE;}
else                                                          { $variables['showvalues']   = FALSE;}

// visstyle
if (isset($_GET['visstyle']) && $_GET['visstyle']!='')        { $variables['visstyle']     = $_GET['visstyle'];} 
else                                                          { $variables['visstyle']     ='total_gradient';}

// colours
if (!isset($_GET['palette']) or $_GET['palette']!='')         { $variables['palette']['value']  = 1;} 
else                                                          { $variables['palette']['value']  =$_GET['palette'];}


// end of input validation
//-------------------------------------------------------------------------------------------



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
function quickvis_paths($icon_type) {
	    $cookie_path=array();
	    
  switch($icon_type){
  case "man";
    $cookie_path['width']=120;
    $cookie_path['height']=330;
    $cookie_path['path']= ' d="M170,105h-55v-0.25c25.267-2.509,45-23.824,45-49.75c0-27.614-22.386-50-50-50S60,27.386,60,55	c0,25.927,19.733,47.241,45,49.75V105H50c-27.614,0-50,22.386-50,50v150c0,22.092,17.91,40,40,40V175c0-2.761,2.238-5,5-5	s5,2.239,5,5v402.5c0,15.188,12.312,27.5,27.5,27.5s27.5-12.312,27.5-27.5V355c0-2.762,2.238-5,5-5s5,2.238,5,5v222.5	c0,15.188,12.312,27.5,27.5,27.5s27.5-12.312,27.5-27.5V175c0-2.761,2.238-5,5-5s5,2.239,5,5v170c22.09,0,40-17.908,40-40V155	C220,127.386,197.614,105,170,105z" ' ;

  break;	
	  case "woman";

    $cookie_path['width']=140;
    $cookie_path['height']=330;
    $cookie_path['path']= ' d="M205.061,170c2.296,0,4.209,1.556,4.797,3.664l43.514,162.284c21.337-5.717,34.002-27.65,28.284-48.99	l-38.823-144.889c-6.004-22.409-26.316-37.151-48.475-37.059V105h-47.844v-0.25c25.267-2.509,45-23.824,45-49.75	c0-27.614-22.386-50-50-50s-50,22.386-50,50c0,25.927,19.733,47.241,45,49.75V105H88.67v0.01	c-22.158-0.092-42.47,14.65-48.475,37.059L1.372,286.958c-5.718,21.34,6.947,43.273,28.285,48.99l43.538-162.364	C73.809,171.518,75.7,170,77.967,170c2.762,0,5,2.239,5,5c0,0.382-0.052,0.751-0.133,1.109L26.872,385h54.642v192.5	c0,15.188,12.312,27.5,27.5,27.5s27.5-12.312,27.5-27.5V385h10v192.5c0,15.188,12.312,27.5,27.5,27.5s27.5-12.312,27.5-27.5V385	h54.642l-55.96-208.885c-0.082-0.359-0.135-0.73-0.135-1.115C200.061,172.239,202.299,170,205.061,170z" ' ;

  break;
  	  case "house";

    $cookie_path['width']=250;
    $cookie_path['height']=350;
    $cookie_path['path']= 'd="M500,68L250,268h50v400h40V368h140v300h220V268h50L500,68z M660,433h-65v-65h65V433z M585,368v65h-65v-65H585z M520,443h65 v65h-65V443z M595,508v-65h65v65H595z" ' ;
  break;	
    	  case "pound";

    $cookie_path['width']=200;
    $cookie_path['height']=250;
    $cookie_path['path']= '    d="M 131.83759,0.99559593 C 14.825935,1.4274279 -7.0322584,134.898 36.619585,211.2017 c -15.01952,0.60321 -33.1917903,-1.92667 -48.14168,-1.32388 -2.71732,1.77639 -1.32052,6.13286 -1.97406,9.04273 -0.20475,8.4877 -0.51754,17.09657 -0.0185,25.51486 1.94284,2.9564 6.6172197,0.7124 9.6851597,1.33131 17.9666303,-0.26215 35.9334503,-0.51039 53.9003003,-0.75723 6.56674,22.60153 13.28703,45.90283 12.25934,69.67771 -7.14943,35.53449 -44.0346,68.46861 -68.5804303,88.8424 -1.86013,3.25948 2.6442,5.90248 3.88054,8.714 8.4278,11.6572 16.2604403,24.00422 25.1029703,35.08288 3.043,1.37636 5.85951,-1.97709 8.60884,-2.91171 57.82372,-43.9844 118.732695,3.94731 174.617615,5.01633 41.72933,4.61057 59.82986,-12.91807 85.04126,-29.953 5.935,-4.21028 -20.37579,-37.8537 -23.69212,-42.59015 -19.21158,5.48549 -39.76525,18.74303 -56.88278,17.90119 -31.63161,0.32669 -55.08824,-19.66434 -84.07478,-18.62434 -27.386595,0.53995 -46.619075,8.75391 -69.431865,17.50814 48.855915,-50.46513 73.948805,-89.62666 54.258945,-148.53102 27.03488,0 54.06975,0 81.10463,0 4.26313,-4.49271 2.15712,-28.46208 1.77793,-34.46343 -39.05515,-0.36136 -73.48527,-0.97541 -100.098605,-1.02813 C -18.887166,42.598311 228.41824,-2.6521166 226.97993,138.51591 c 0,0 4.38936,0.62867 7.92695,1.28647 14.63732,-0.22086 29.36209,0.4875 43.94823,-0.62432 3.08004,-2.22627 -0.35423,-6.11651 -0.75534,-9.0031 C 278.99281,39.635318 206.17413,-0.19676253 131.83759,0.99559593 z" ' ;
  break;
  
      	  case "euro";

    $cookie_path['width']=200;
    $cookie_path['height']=280;
    $cookie_path['path']= ' d="M31.57,257.82H0v-30.4h25.724c-0.586-8.184-1.17-16.952-1.17-25.723s0.584-18.125,1.17-26.894H0v-30.985h32.154 C55.541,56.125,132.125,0,225.082,0c68.983,0,116.926,32.74,147.91,77.17L332.651,99.97 c-22.215-33.324-63.141-56.709-107.569-56.709c-66.646,0-120.434,39.17-141.479,100.556h176.559v30.985H76.586 c-1.17,8.771-1.754,17.539-1.754,26.894c0,8.771,0.584,17.539,1.754,25.723H260.16v30.4H83.603 c20.462,61.97,74.832,102.31,141.479,102.31c44.43,0,85.354-23.971,107.568-56.709l40.928,22.216 c-32.742,45.019-79.514,77.757-148.496,77.757C130.958,403.393,54.373,346.681,31.57,257.82z" ' ;
  break;
  
        	  case "baby";

    $cookie_path['width']=160;
    $cookie_path['height']=240;
    $cookie_path['path']= '       d="m 120.93463,420.82094 c 6.43104,6.37954 20.33952,6.48227 27.17034,0.53275 7.95621,-6.92971 8.90945,-26.48897 3.72926,-31.43235 -14.68936,-14.01783 -38.89087,-36.75986 -38.89087,-36.75986 l 34.62886,-35.16162 30.36684,-1.0655 35.69437,36.22712 c 0,0 -28.86967,25.2621 -41.02188,39.42362 -6.29711,7.33831 -3.47159,22.31475 3.72926,28.76859 6.74567,6.04588 19.6767,5.62217 27.17033,0.53275 26.55412,-18.03465 65.52846,-68.72496 65.52846,-68.72496 0,0 6.31647,-12.80471 6.39302,-19.71182 0.0822,-7.41566 -6.39302,-21.31006 -6.39302,-21.31006 l -43.68564,-42.08739 -46.88215,47.94765 46.88215,-47.4149 0.53275,-22.90832 -0.53275,-47.4149 c 0,0 30.87297,44.85008 54.87343,53.80792 8.16755,3.04843 19.63793,4.24821 26.10483,-1.59825 6.54027,-5.9128 10.18692,-19.57553 4.26201,-26.10484 -27.99418,-30.84987 -86.30577,-84.70751 -86.30577,-84.70751 l -9.58953,-6.92578 -12.25329,-3.72926 c -27.59308,0 -27.70309,0 -27.70309,0 0,0 38.35813,-13.12116 39.42363,-44.51881 C 213.63343,60.680805 192.9387,37.19429 161.95651,37.517834 134.10665,37.808667 111.3451,55.88604 111.3451,87.85114 c 1.59825,30.0143 38.35812,43.15288 38.35812,43.15288 l -25.03933,0 c 0,0 -9.56258,1.61539 -13.85154,3.72926 -3.40892,1.68012 -9.05678,6.92578 -9.05678,6.92578 0,0 -65.819499,49.29189 -83.109261,83.64201 -4.072694,8.09135 -5.61111,20.51378 0.532752,27.17034 6.052272,6.55732 19.697081,8.2725 26.637584,2.66376 C 64.813867,239.7832 99.624565,201.86 99.624565,201.86 l 1.065505,45.81664 125.19664,-0.53275 -125.19664,1.06551 -0.53275,21.84281 47.4149,47.94765 -47.4149,-47.94765 -44.218393,44.21839 c 0,0 -5.381663,12.97513 -4.794765,19.71181 0.807514,9.269 11.187785,25.57209 11.187785,25.57209 0,0 41.782103,44.58055 58.602683,61.26644 z" ' ;
  break; 
  
          	  case "ambulance";

    $cookie_path['width']=220;
    $cookie_path['height']=180;
    $cookie_path['path']= '       d="m 255.12946,4.3755749 c -3.61304,-0.5406916 -7.52698,1.9241287 -6.83035,5.9598211 -0.79877,2.31611 -1.93321,4.921225 -2.20982,7.5 -2.50433,3.915607 -1.11479,9.771955 -4.10715,13.258929 -22.3669,0.993513 -45.03167,-0.162106 -67.34959,0.690891 -3.26505,-0.679748 -7.71046,-0.474072 -11.51139,-0.403994 -52.13237,0.723545 -104.270035,0.910415 -156.4068747,0.829174 -4.0124572,1.845164 -1.1442187,7.749179 -2.0089285,11.294643 0,56.607141 0,113.214291 0,169.821431 1.7879763,3.75211 7.2556092,2.22353 10.6919002,2.84434 3.760784,0.25184 8.10151,-0.28751 11.473278,0.30298 -0.120827,2.79898 2.4287,4.4757 2.366072,7.34375 1.323833,3.0591 1.940173,6.65401 4.0625,9.19643 1.546745,1.92953 3.105454,4.26863 5.513393,5.625 3.001946,2.24499 6.80569,3.22265 10.223214,4.62053 6.84791,0.4312 14.072386,1.23859 20.736607,-0.55803 2.337821,-1.77957 5.905385,-1.77701 7.745536,-4.15179 5.0347,-2.02059 6.608964,-7.46771 10.223214,-11.02678 1.584686,-3.48246 3.416529,-6.7897 4.464286,-10.58036 1.478,-1.9097 5.036864,-0.45977 7.276221,-1.06701 63.833372,-0.9165 127.693532,0.28771 191.518422,-0.96424 8.88327,-1.47213 18.26219,-0.71689 27.27679,-0.625 2.64347,-0.25041 0.66438,3.50149 2.74553,4.50893 0.2934,3.17428 1.44084,6.09536 2.8125,8.86161 1.49442,6.74033 7.27844,11.68931 13.37054,14.24107 1.83528,2.02653 4.9473,1.7243 7.03125,3.25893 4.49207,0.43883 9.55658,0.99172 13.57143,-1.25 3.82375,-0.16065 6.47346,-2.63466 9.82142,-4.12947 4.52924,-3.16858 8.54241,-7.67061 9.50893,-13.34821 2.22098,-3.43647 2.20622,-7.7017 3.88393,-11.4509 2.42566,-2.11434 8.00635,-0.27541 11.62947,-0.89285 5.12987,-0.37002 10.57551,0.76957 15.49107,-0.625 1.36315,-6.17836 0.18303,-12.8684 0.58035,-19.24107 -0.88677,-4.73004 -9.5906,1.05756 -7.85714,-4.86608 -0.19018,-12.89307 0.37561,-25.93908 -0.27764,-38.73847 -3.57927,-4.2355 -7.84014,-8.1421 -11.06164,-12.73474 -3.40749,-2.06749 -5.56279,-5.90276 -8.21429,-8.54911 -1.82931,-2.9956 -6.48134,-1.2038 -9.46367,-1.87235 -3.13586,-0.33355 -7.74597,0.38017 -10.04526,-0.44908 -0.66823,-12.15937 -0.023,-24.52232 -1.85268,-36.540175 -1.26653,-2.192279 -1.10712,-5.198486 -2.99107,-6.986607 -1.29002,-3.916007 -4.25388,-7.298828 -7.54464,-9.642857 -1.45115,-1.862597 -4.23782,-2.504052 -6.31697,-3.28125 -5.33976,-2.105276 -11.59545,-0.756103 -17.27671,-1.215347 -12.36991,-0.09809 -24.73497,-0.464418 -37.09829,-0.860546 -0.19315,-11.856917 0.382,-23.874548 -0.2863,-35.632077 -2.54945,-2.899693 -7.70692,-0.659485 -11.29852,-1.35453 -4.23917,1.140041 -6.08988,-0.805536 -6.07143,-4.821429 0.25807,-3.115141 -2.27702,-5.131773 -2.09821,-8.236607 -0.8822,-3.697579 -2.35027,-6.982135 -2.74554,-10.8035715 -1.45585,-4.7012053 -7.54212,-2.8842402 -11.09375,-3.2589286 z M 173.27679,63.505039 c 0.19009,10.198332 -0.3807,20.555829 0.2863,30.6544 2.67219,2.945443 8.01325,0.608822 11.72262,1.354529 8.13988,0 16.27977,0 24.41965,0 0,10.565482 0,21.130952 0,31.696432 -11.67067,0.19432 -23.50325,-0.38542 -35.07405,0.2863 -2.94544,2.67219 -0.60882,8.01325 -1.35452,11.72263 0,8.85416 0,17.70833 0,26.5625 -11.27977,0 -22.55953,0 -33.83929,0 -0.19188,-12.38546 0.38057,-24.9308 -0.2863,-37.2169 -2.67219,-2.94545 -8.01326,-0.60883 -11.72263,-1.35453 -8.37798,0 -16.75595,0 -25.13393,0 0,-10.56548 0,-21.13095 0,-31.696432 11.90927,-0.191893 23.97841,0.380528 35.78833,-0.2863 2.94544,-2.672193 0.60882,-8.013257 1.35453,-11.722629 0.16501,-7.950508 -0.34627,-16.23293 0.51339,-23.995535 11.01603,-1.01035 22.38724,0.222745 33.3259,-0.803572 0,1.599702 0,3.199405 0,4.799107 z m 142.8125,15.535715 c 6.94362,0.383135 14.23727,-0.747093 20.80357,1.428571 4.5592,-0.319214 7.02681,4.170086 8.79464,7.65625 1.36303,1.524364 1.29147,4.062764 2.56696,5.714286 0.92182,11.064599 0.49027,22.293709 0.9375,33.392859 -20.04454,-0.0504 -40.0893,-0.009 -60.13392,-0.0223 0.19759,-15.86317 0.17857,-31.730754 0.64732,-47.589289 8.73554,-0.604393 17.59359,-0.545636 26.38393,-0.580357 z" ' ;
  break;  
  
            	  case "bed";

    $cookie_path['width']=220;
    $cookie_path['height']=130;
    $cookie_path['path']= '  d="M 11.580357,2.6970036 C 7.7407832,3.3054235 5.9985213,7.3058376 4.147321,10.040754 2.7291797,31.184367 3.6289778,52.46206 3.2932856,73.656799 c -0.037841,47.187481 -0.00598,94.375021 -0.0165,141.562531 1.752488,3.95524 7.4815667,1.19749 10.9374997,2.00892 5.457448,1.64238 5.828338,-3.83525 5.223215,-7.72321 0,-24.80655 0,-49.61309 0,-74.41964 120.08929,0 240.17857,0 360.26786,0 0,26.7113 0,53.42262 0,80.13393 1.7465,3.96405 7.49193,1.18155 10.9375,2.00892 5.52137,0.90233 3.4406,-5.90168 3.79464,-9.15178 -0.14824,-63.58917 0.37974,-127.273731 -0.51339,-190.803573 -1.62165,-3.341882 -4.71465,-8.5391323 -9.19643,-6.316965 -2.07845,1.621462 -2.91837,4.335412 -4.30804,6.495536 -1.5742,15.856445 -0.0993,31.975214 -1.0491,47.857143 -1.79443,-3.092436 -3.88487,-5.953339 -5.53572,-8.995536 -1.91283,-2.40459 -3.61454,-4.983296 -6.25,-6.696428 -1.62917,-3.078703 -5.06499,-4.399848 -7.45536,-6.25 -3.09386,-0.651398 -5.4222,-3.055956 -8.83928,-3.214286 -3.59829,-1.567339 -7.46716,-2.383118 -11.40625,-2.790179 -6.83327,-2.533493 -14.58333,-1.665194 -21.49554,-3.950893 -9.83005,-0.640899 -19.34139,-2.961066 -29.23813,-3.171911 -5.85502,-0.574823 -11.86927,-0.295406 -17.65919,-0.91291 -5.02923,-1.891119 -10.86876,-0.759199 -16.20536,-1.25 -26.70477,-0.185814 -53.5195,-0.715949 -80.15625,0.669643 -6.77081,1.878592 -14.13922,0.392506 -21.13839,1.25 -8.02044,0.62175 -16.43076,0.259813 -24.04018,2.767857 -2.85659,0.01611 -5.28294,1.265502 -7.63393,2.633929 -4.49619,1.227389 -7.55605,4.560565 -11.51785,6.875 -3.25979,2.68678 -6.38794,6.962332 -8.61607,9.799107 -2.447297,-2.043223 -7.981476,-1.978915 -7.031255,-6.294643 0.569758,-5.582684 -0.698078,-11.392394 -5.223214,-15.133929 -1.6157,-1.643877 -3.605957,-2.503868 -5.133928,-4.107143 -3.016579,-0.839752 -5.678972,-2.055402 -8.482143,-3.169642 -3.587513,-0.426635 -7.051922,-0.95107 -10.334822,-2.232143 -3.866148,-0.735528 -6.718747,2.083298 -10.491071,2.008928 -5.70879,1.931564 -11.472605,5.786435 -13.638393,11.785715 -3.113254,4.348489 -1.173808,10.595657 -1.785714,15.669642 0.844453,2.216804 -0.55516,2.766995 -1.741072,1.361608 C 32.595296,49.424447 25.634772,49.092344 19.59375,50.665754 19.106497,37.856902 19.785661,23.818507 19.256529,10.599774 17.633235,7.5114715 15.933298,2.4875744 11.580357,2.6970036 z M 213.00893,37.250575 c 20.04318,0.313556 40.2181,0.510224 60.13393,1.964286 9.31167,1.614686 19.02663,0.945206 28.32589,2.96875 8.4327,0.799259 16.90464,1.242446 25.13393,2.991071 3.97259,0.221437 7.92149,0.597182 11.5625,1.986607 5.90373,0.284693 12.63758,0.621204 17.03125,4.799108 4.20158,1.303937 6.94213,4.982692 9.33036,8.348214 3.16976,2.290555 4.05082,6.302673 7.03125,8.883928 1.45443,3.618121 3.62643,6.327029 5.69196,9.441965 1.36586,3.0578 2.9123,5.8547 2.36606,9.352328 0.15157,5.787229 0.0659,11.577793 0.0893,17.366418 -95.66965,0 -191.33929,0 -287.008932,0 0.842029,-3.23503 2.295043,-6.370132 2.209822,-9.933032 1.0599,-4.975557 2.396414,-9.920943 3.080357,-15.022321 1.745328,-2.938122 1.564757,-6.609818 3.459823,-9.486608 0.3403,-2.42928 1.68306,-4.074885 2.90178,-5.959821 0.81983,-2.326047 2.83248,-4.269106 3.68304,-6.607143 1.69731,-1.229332 3.31721,-2.771659 4.04018,-4.665178 2.59341,-3.460101 6.1251,-5.543274 9.88839,-7.254465 1.53295,-1.658128 4.35667,-1.26749 6.04911,-2.723214 5.97076,-0.889916 11.40137,-3.43761 17.45536,-3.772321 9.69256,-2.30603 19.92097,-1.318028 29.86607,-2.075893 12.55476,-0.394227 25.11705,-0.667804 37.67857,-0.602679 z M 19.571428,60.442539 c 5.133902,0.678648 11.063148,-1.475069 15.46875,1.584822 4.337305,0.95639 7.965146,3.347634 12.410715,3.883928 3.109176,2.263915 7.466821,1.728207 10.491071,4.107143 3.860483,0.849857 7.298189,3.08625 11.361607,3.459822 2.024019,1.346507 4.696083,1.652485 6.852679,2.633928 3.138907,1.818486 7.065264,1.755857 10.200893,3.727679 1.286457,1.483986 0.172378,4.285121 -0.513393,6.09375 -0.823222,4.565936 -0.660243,9.266328 -2.433036,13.504464 0.169936,4.156625 0.254807,7.470905 -5.066964,5.915175 -19.635417,0 -39.270834,0 -58.90625,0 0.08828,-14.897446 -0.177165,-30.374661 0.133928,-44.910711 z" ' ;
  break;  
  
              	  case "old";

    $cookie_path['width']=70;
    $cookie_path['height']=220;
    $cookie_path['path']= '   d="m 63.276371,388.11115 -55.7209835,0.94443 c 0,0 -1.6882671,-0.42882 -2.3610586,-0.94443 -0.6246692,-0.47873 -1.4166351,-1.88884 -1.4166351,-1.88884 L 1.4166352,118.95047 c 0,0 1.527435,-28.345157 7.0831758,-41.082417 3.008188,-6.896662 7.974579,-13.055308 13.69414,-17.944046 5.032497,-4.301476 17.471834,-9.444234 17.471834,-9.444234 0,0 -2.125864,-23.113027 3.305482,-32.58261 3.587052,-6.254046 10.262136,-12.7663891 17.471834,-12.7497154 11.144567,0.025774 23.469621,8.3065494 26.916068,19.8328924 3.596646,12.028673 0.297178,20.143397 -4.722117,28.332703 -1.428079,2.330003 -4.260745,6.195337 -7.481709,7.819755 -4.185819,2.11102 -9.074354,-0.981522 -10.462337,0.680057 -1.292325,1.547064 5.666541,8.027599 5.666541,8.027599 L 59.53902,65.673505 59.68014,57.02043 c 0,0 7.007883,-1.621468 10.225659,-3.162768 3.584144,-1.716788 8.016871,-3.158891 9.883828,-6.667155 3.924057,-7.373832 4.006838,-17.719639 0.01834,-25.058815 -2.875817,-5.291748 -9.229854,-8.811784 -15.167931,-9.817851 -4.45784,-0.755276 -11.116354,0.155752 -13.179214,3.208322 -2.156328,3.190881 -3.328763,11.356984 -4.557407,16.346848 -2.316745,9.408943 -2.209961,19.277416 -2.209961,19.277416 l 14.805222,16.805179 9.444235,2.833272 c 1.550684,8.924795 2.793876,19.153814 3.305482,28.804914 0.999912,18.862638 -0.472211,56.665408 -0.472211,56.665408 l -36.832515,-1.41664 0.472212,-48.16559 c -2.467913,-23.284749 -0.476384,40.61095 -0.472212,49.11002 l 37.776938,-0.47222 -0.472212,1.88885 13.69414,0.47221 1.572188,3.06104 0.788871,21.02177 c 0,0 9.833262,1.06393 13.694138,-1.41664 2.61187,-1.6781 4.81486,-4.75356 4.72213,-8.02761 -0.15527,-5.48157 -2.63509,-6.12802 -5.19434,-8.02759 -3.880274,-2.88008 -13.930245,-4.0138 -13.930245,-4.0138 l -1.652742,-3.06938 c 0,0 11.871964,1.39851 16.763517,4.48601 2.97412,1.87724 6.84706,8.0276 6.84706,8.0276 0,0 1.81157,1.15405 4.83766,3.1284 1.60596,1.0478 4.57163,2.66585 5.55101,3.71867 3.07186,3.30223 6.61096,11.8053 6.61096,11.8053 l -9.91644,0.47221 c 0,0 -1.91075,-9.29362 -5.66655,-9.91645 -3.52051,-0.58381 -8.02759,7.08318 -8.02759,7.08318 l -1.88885,198.80113 c 0,0 -2.29291,2.38289 -3.777696,2.36106 -1.702399,-0.025 -4.249905,-2.83327 -4.249905,-2.83327 l 1.888847,-199.27335 -5.194329,-1.41663 -4.722117,1.88884 -12.749717,0 -59.887347,-0.001 60.060627,0.45436 -7.25646,110.98874 -9.916446,77.44272 8.972023,8.97203 c 0,0 1.959804,2.5474 1.416635,3.77769 -0.342352,0.77543 -2.361058,0.94442 -2.361054,0.94442 z" ' ;
  break; 
                	  case "hospital";

    $cookie_path['width']=180;
    $cookie_path['height']=110;
    $cookie_path['path']= '   d="M 4.9463677,4.0742356 C 3.3527947,6.3542403 4.5437648,9.446876 4.1762784,12.076468 c 0.077752,15.105988 -0.1555279,30.264218 0.116682,45.337543 -0.2552914,7.280128 -0.051432,15.051128 -0.116682,22.5196 0.077241,15.22521 -0.1545059,30.501959 0.1159148,45.694949 0.1175775,1.84262 -0.3028036,4.0343 -0.1159148,6.09077 0.077673,10.82029 -0.155392,21.69275 0.1166144,32.48042 0.8393724,2.75508 4.3869497,1.2966 6.5240102,1.6602 44.605654,0 89.211307,0 133.816967,0 3.08108,-0.59542 1.7301,-4.37489 2.10753,-6.59469 0.58111,-19.34502 0.0975,-38.70528 0.77193,-58.04817 10.57305,-0.13529 21.17252,0.29388 31.72991,-0.29018 1.95932,-1.143474 0.61135,2.13147 1.00447,3.20313 0.01,19.91897 0.28533,39.83669 0.47991,59.75446 0.63797,3.08716 4.41216,1.65604 6.64062,1.97545 45.55432,0 91.10864,0 136.66295,0 3.11816,-0.60374 1.67717,-4.40889 1.99777,-6.64062 0,-19.40477 0,-38.80953 0,-58.21429 -0.27641,-1.847751 0.18598,-4.030001 0,-6.071429 0,-19.047618 0,-38.09524 0,-57.142857 -0.48255,-1.862335 0.3117,-3.987107 0,-6.071429 -0.0776,-8.796492 0.15534,-17.645124 -0.11662,-26.4089966 -0.83937,-2.7550734 -4.38695,-1.2965995 -6.52401,-1.6601999 -104.40476,0 -208.80952,0 -313.2142838,0 C 5.76482,3.7914975 5.3555938,3.9328666 4.9463677,4.0742356 z M 162.24548,19.074236 c 3.26265,0 6.52529,0 9.78794,0 0.15294,5.736976 -0.30661,11.576764 0.23323,17.248796 1.23215,2.38375 4.57736,0.918346 6.76454,1.322632 5.52455,0 11.04911,0 16.57366,0 0,6.644347 0,13.28869 0,19.933036 -7.43103,0.07843 -14.91464,-0.156382 -22.31301,0.116614 -2.77101,0.844497 -1.27024,4.403129 -1.60974,6.546057 0.0532,4.921975 0.1075,9.843936 0.16159,14.7659 -6.22396,0 -12.44792,0 -18.67188,0 -0.0779,-6.820992 0.15523,-13.69421 -0.11661,-20.482657 -0.83937,-2.755075 -4.38695,-1.2966 -6.52401,-1.6602 -4.69122,0 -9.38244,0 -14.07366,0 0,-6.168153 0,-12.33631 0,-18.504464 6.10671,-0.07793 12.26563,0.155183 18.3398,-0.116614 2.75507,-0.839373 1.2966,-4.38695 1.6602,-6.524011 0,-4.21503 0,-8.43006 0,-12.645089 3.26265,0 6.5253,0 9.78795,0 z m -50.21206,28.180803 c 0,3.203125 0,6.40625 0,9.609375 -31.29092,0 -62.581845,0 -93.872767,0 0.06209,-6.346703 0.122765,-12.693418 0.178572,-19.040178 31.2314,-0.05951 62.462796,-0.119037 93.694195,-0.178572 0,3.203125 0,6.40625 0,9.609375 z m 158.0692,-9.609375 c 13.98065,0 27.96131,0 41.94196,0 -0.026,6.405393 -0.004,12.812643 -0.0112,19.21875 -31.2872,0 -62.5744,0 -93.86161,0 0,-6.40625 0,-12.8125 0,-19.21875 17.31027,0 34.62054,0 51.93081,0 z M 65.102618,101.21709 c 15.6436,0 31.287203,0 46.930802,0 0,8.07292 0,16.14584 0,24.21875 -31.29092,0 -62.581845,0 -93.872767,0 0.02604,-8.07206 0.0037,-16.14598 0.01116,-24.21875 15.643601,0 31.287204,0 46.930804,0 z m 205.000002,0 c 13.97693,0 27.95387,0 41.9308,0 0,8.07292 0,16.14584 0,24.21875 -31.2872,0 -62.5744,0 -93.86161,0 0,-8.07291 0,-16.14583 0,-24.21875 17.31027,0 34.62054,0 51.93081,0 z" ' ;
  break; 
  
                  	  case "beer";

    $cookie_path['width']=60;
    $cookie_path['height']=200;
    $cookie_path['path']= '  d="m 71.740151,7.5673864 c -6.524257,0.4145292 -14.55288,2.0049771 -17.800263,8.3968926 -0.994886,2.441808 -2.317616,4.994625 -2.171115,7.677981 1.747668,1.846852 4.686771,0.523757 2.429923,4.040286 -1.059261,4.145207 -3.35821,8.116548 -3.580182,12.379666 1.100575,1.608188 3.047308,2.986908 2.089908,5.183557 -3.065067,30.276348 -6.274818,60.537801 -9.422811,90.805581 -5.327673,13.08348 -11.027888,26.05235 -16.118009,39.20947 0,60.68097 0,121.36194 0,182.04291 0.874115,3.10326 5.129625,2.53543 7.534194,3.86136 10.510407,3.12337 21.140112,6.51779 32.13505,7.26307 16.945061,0.37372 33.331824,-4.56624 49.681414,-8.40105 2.92552,-1.40334 1.09282,-5.38115 1.6061,-7.94268 0.001,-15.09854 -0.0463,-30.20342 0.60388,-45.29146 -1.11082,-4.31584 -0.1716,-8.98129 -0.51548,-13.42915 -0.24004,-39.63951 -0.25188,-79.30366 -0.65472,-118.92768 -5.46349,-13.41545 -11.56397,-26.65194 -16.90646,-40.09346 -3.059623,-30.22403 -6.121102,-60.447877 -9.184482,-90.671529 1.765524,-1.535745 3.788324,-3.638755 2.136422,-6.064471 -1.26782,-4.091207 -2.813345,-8.330032 -3.890568,-12.310922 2.587003,0.752693 5.594526,-1.075445 4.126556,-3.954016 -1.085334,-4.364639 -2.752456,-9.31317 -7.433551,-10.95622 C 81.879222,8.1707782 76.742242,7.4273863 71.740151,7.5673864 z M 71.438207,205.05253 c 9.269724,-0.29066 18.157746,2.7668 26.149678,7.26482 3.973975,2.07432 7.995265,4.00393 11.708235,6.4664 0.10687,28.88807 0.0979,57.79701 0.27318,86.67204 -9.03865,4.57033 -17.822832,9.9851 -27.692489,12.56659 -10.86173,2.63232 -22.350068,0.42308 -31.919696,-5.04677 -4.859545,-2.44435 -9.531705,-5.07264 -14.191325,-7.87927 0.07666,-28.74211 0.153348,-57.48421 0.230052,-86.22632 8.495842,-4.93856 17.148433,-10.06084 26.631582,-12.78295 2.885764,-0.67736 5.848737,-0.98543 8.810783,-1.03454 z" ' ;
  break; 
  
                     	  case "bus";

    $cookie_path['width']=280;
    $cookie_path['height']=170;
    $cookie_path['path']= '   d="m 347.33493,51.311681 c -103.98259,0.04238 -207.96516,0.105091 -311.947737,0.157836 -5.954928,1.336233 -9.994757,7.034156 -10.148876,13.005714 -1.156996,20.711118 -0.433696,41.494699 -0.626712,62.234859 0.180795,41.47908 0.01378,82.96845 0.958168,124.43817 -0.120688,7.99311 2.955525,17.14857 10.764438,20.67656 9.715511,4.32446 20.68728,2.54388 30.999047,3.06742 23.796355,0.0834 47.592932,0.0241 71.389382,0.042 0.91513,11.43982 6.60809,23.11074 17.12524,28.53681 8.94101,5.14528 19.74409,4.64035 29.59432,3.23564 12.94521,-2.72912 23.03951,-14.07881 25.17489,-27.00579 0.81012,-1.64202 -0.43141,-5.33424 2.19393,-4.76666 64.87637,-0.002 129.7548,-0.0901 194.62798,0.66291 1.83677,11.28187 7.78961,22.60265 18.37215,27.85812 8.93257,4.99725 19.61103,4.60349 29.45226,3.34613 12.77357,-2.65181 22.59679,-13.84382 24.93814,-26.48494 0.38122,-1.77581 0.63194,-3.57546 0.80497,-5.38222 10.83188,-0.21861 21.7653,0.51993 32.53007,-0.80496 5.84846,-0.76583 10.35001,-5.40678 11.94821,-10.93806 2.67395,-7.56563 1.13539,-15.79349 1.57836,-23.64389 -0.0206,-35.00858 0.0136,-70.32335 0,-105.51359 0.013,-19.97514 -0.11218,-40.489164 -0.37881,-60.672283 0.027,-6.64942 -0.0913,-14.554956 -5.76102,-19.113981 -5.12096,-3.960108 -11.99859,-2.171318 -17.96178,-2.730568 C 451.08737,51.15122 399.21004,51.344887 347.33493,51.311681 z M 49.529329,74.923996 c 3.961692,0 7.923384,0 11.885076,0 0,19.035062 0,38.070124 0,57.105184 -7.923384,0 -15.846768,0 -23.770152,0 0,-19.03506 0,-38.070122 0,-57.105184 3.961692,0 7.923384,0 11.885076,0 z m 89.666821,0 c 0,19.035062 0,38.070124 0,57.105184 -21.39209,0 -42.784167,0 -64.176253,0 0,-19.03506 0,-38.070122 0,-57.105184 21.392086,0 42.784163,0 64.176253,0 z m 93.78635,0 c 0.22495,19.035078 0.45103,38.070144 0.6787,57.105184 -27.12155,0 -54.24309,0 -81.36463,0 0,-19.03506 0,-38.070122 0,-57.105184 26.89531,0 53.79062,0 80.68593,0 z m 57.46821,0 c 10.8644,0 21.7288,0 32.5932,0 0,19.035062 0,38.070124 0,57.105184 -23.7491,0 -47.49821,0 -71.24732,0 0,-19.03506 0,-38.070122 0,-57.105184 12.88471,0 25.76941,0 38.65412,0 z m 127.54754,0 c 0,19.035062 0,38.070124 0,57.105184 -25.59053,0 -51.18106,0 -76.77159,0 -0.89247,-18.98541 -0.39602,-38.077192 -0.53664,-57.105184 25.76941,0 51.53882,0 77.30823,0 z m 87.88328,0 c 0,19.035062 0,38.070124 0,57.105184 -19.87686,0 -39.75371,0 -59.63057,0 0,-19.03506 0,-38.070122 0,-57.105184 19.87686,0 39.75371,0 59.63057,0 z M 49.529329,164.82757 c 3.961692,0 7.923384,0 11.885076,0 0,19.03506 0,38.07013 0,57.10519 -7.923384,0 -15.846768,0 -23.770152,0 0,-19.03506 0,-38.07013 0,-57.10519 3.961692,0 7.923384,0 11.885076,0 z m 51.012701,0 c 8.50738,0 17.01476,0 25.52214,0 -0.004,32.04499 0.0178,63.74812 0,95.72774 -3.83947,0.6273 -8.84501,0.0885 -13.13199,0.26832 -12.6383,0.0273 -25.284972,-0.0388 -37.912283,0.56821 -0.01709,-32.08726 0.003,-63.89234 0,-96.04341 1.766378,-1.26934 5.936591,-0.13485 8.586297,-0.52086 5.645278,0 11.290561,0 16.935836,0 z m 81.83814,0 c 13.55814,0 27.11628,0 40.67443,0 -0.22767,19.03505 -0.45375,38.07011 -0.6787,57.10519 -26.89531,0 -53.79062,0 -80.68593,0 0,-19.03506 0,-38.07013 0,-57.10519 13.5634,0 27.1268,0 40.6902,0 z m 93.61273,0 c 10.29619,0 20.59238,0 30.88857,0 0,19.03506 0,38.07013 0,57.10519 -20.33984,0 -40.67968,0 -61.01952,0 -0.2477,-19.03499 -0.49038,-38.07004 -0.72605,-57.10519 10.28567,0 20.57134,0 30.857,0 z m 85.42103,0 c 10.94858,0 21.89716,0 32.84574,0 0,19.03506 0,38.07013 0,57.10519 -21.89716,0 -43.79432,0 -65.69148,0 0,-19.03506 0,-38.07013 0,-57.10519 10.94857,0 21.89716,0 32.84574,0 z m 106.31855,0 c 10.02261,0 20.04522,0 30.06782,0 0,19.03506 0,38.07013 0,57.10519 -20.04521,0 -40.09042,0 -60.13564,0 0,-19.03506 0,-38.07013 0,-57.10519 10.02261,0 20.04522,0 30.06782,0 z" ' ;
  break; 
}
//end of switch statement
     return $cookie_path;
}
// end of path and dimensions of icons function 

function isotype_palettes() {

  return array(
    0 => array('#69D2E7', '#A7DBD8', '#E0E4CC', '#F38630', '#FA6900'),
    1 => array('#556270', '#4ECDC4', '#C7F464', '#FF6B6B', '#C44D58'),
    2 => array('#ECD078', '#D95B43', '#C02942', '#542437', '#53777A'),
    3 => array('#FE6102', '#E9BF09', '#046D32', '#005EA8', '#D01B20'),
    4 => array('#CA81A4', '#81A1CA', '#81CAA9', '#C4CA81', '#81444A'),
    5 => array('#25B79F', '#4CDFCE', '#4CB2DF', '#4C7BDF', '#844CDF'),
    6 => array('#C1D1EA', '#FF6503', '#065195', '#0B7F7C', '#FDE7D2'),
    7 => array('#E20F76', '#FD7FBE', '#F7E4C6', '#6E7E51', '#405A3D'),
    8 => array('#CFF09E', '#A8DBA8', '#A8DBA8', '#3B8686', '#0B486B'),
    9 => array('#A484C6', '#231730', '#8140C7', '#C7AFE1', '#2E7D9C'),
    10 => array('#22374C', '#1F738B', '#42BED8', '#85E6EF', '#C8EBF1'),
    11 => array('#E8DDCB', '#CDB380', '#036564', '#033649', '#031634'),
    12 => array('#FE4365', '#FC9D9A', '#F9CDAD', '#C8C8A9', '#83AF9B'),
    13 => array('#3F6875', '#423F75', '#75593F', '#CEC1B4', '#E3BD56'),
    14 => array('#251F49', '#3D336F', '#4D4598', '#715FBB', '#A78BE5'),
    15 => array('#292940', '#634063', '#FF595C', '#FFA959', '#FFFC59'),
    16 => array('#D1626A', '#D10B19', '#5E7BCC', '#EEE9DC', '#E1AE26'),
    17 => array('#D11F5D', '#BCA231', '#75617D', '#DE3B72', '#5A1528'),
    18 => array('#3D4057', '#F0BC1E', '#A1E0F6', '#58B5BE', '#BFB4A4'),
    19 => array('#E0E3F0', '#D3DA84', '#84B2DA', '#3680C1', '#B0C136'),
    20 => array('#F90B06', '#36CCE5', '#DCE536', '#CE65BE', '#B4336A'),
    21 => array('#B60028', '#FFA311', '#FF5002', '#910035', '#C4314E'),
    22 => array('#83C7A2', '#C4FC2A', '#048C75', '#0E7781', '#1A667D'),
    23 => array('#A69696', '#8A7B7B', '#906484', '#CCC7C7', '#B8A8A8'),
    24 => array('#BDBAAB', '#0082BB', '#FF93B5', '#FF644E', '#DF006E'),
    25 => array('#89BABB', '#D9D6C6', '#779DA9', '#8B8574', '#326779'),
    26 => array('#63E12F', '#60F8F4', '#5B4E24', '#F453A6', '#F4C453'),
    27 => array('#3DB4CA', '#22656E', '#C53215', '#AB0D07', '#F99513'),
    28 => array('#E65924', '#DA3B36', '#995D74', '#699795', '#49B9DF'),
    29 => array('#13F2F9', '#0A3C54', '#B2D32E', '#59431A', '#41084F'),
    30 => array('#ABABAB', '#8C8C8C', '#595959', '#2B2B2B', '#121212'),
  );
}

// this function builts the icon information giving a single colour to the icon
// function returns the path with all needed style options
function isotype_build_solid_style($icon,$colour) {
	
}

// this function builds the icon
// function returns the path with all needed style options
function isotype_build_gradient_style($icon,$colour1, $colour2, $value) {
	
}

//
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
if (  ( $variables['type']!= 'family') && ( $variables['type'] !='couple') ) {
	$quickvis_svg_builder  = '';
}
// end of all other cases


 return $quickvis_svg_builder;
}
// end of build image functions

//----------------------------------------------------------------

 echo quickvis_build_image($variables,$adjustments) ;
?>