<?php

// input functions for isotype api

// this file contains all the functions for processing the $_GET and $_POST values in the isotype api
// it has been seperated out to allow for better readability and commenting of both these functions and the main api file

function process_get($_GET) {
if (isset($_GET['type']) && $_GET['type']!='')                  { $variables['type']         = $_GET['type']; } 
else                                                            { $variables['type']         = 'man'; }
if (isset($_GET['title']) && $_GET['title']!='')                { $variables['title']        = $_GET['title']; } 
else                                                            { $variables['type']         = ' '; }

// check arrangement
// note Arrangement can be overridden dependant on numicons
if (isset($_GET['arrangement']) && $_GET['arrangement']!='')  { $variables['arrangement']  = $_GET['arrangement']; }
else                                                            { $variables['arrangement']  = 'block'; }

// values building
// check the number of values
if (isset($_GET['numvalues']) && $_GET['numvalues']!='')      { $variables['numvalues']    = $_GET['numvalues']; } 
if(!isset($_GET['numvalues']) or ($_GET['numvalues']=='0') )  { $variables['numvalues']    = 1; }

// api numvalues fix
if ($variables['numvalues'] == '0')                           { $variables['numvalues']    = '1'; }
// check the number of icons ( not always applicable)
if (isset($_GET['numicons']) && ($_GET['numicons']!='' ) )    { $variables['numicons']     = $_GET['numicons'];   } 
if(!isset($_GET['numicons']) or ($_GET['numicons']=='0') )    { $variables['numicons']     = 1; }

if (isset($_GET['value'])   )                                 { $variables['value']       = $_GET['value'] ;} 
else                                                            { $variables['value']       = 50 ;}
if ($variables['value']== 0 )                                  { $variables['value']       = 50 ;}

if (isset($_GET['showvalues'])   )                                 { $variables['showvalues']       = $_GET['showvalues'] ;} 
else                                                            { $variables['showvalues']       = TRUE ;}		

// headers & labels
if (isset($_GET['showheader']) && $_GET['showheader']==1)     { $variables['showheader']   = TRUE ;}
else                                                            { $variables['showheader']   = FALSE;}

if (isset($_GET['showlabels']) && $_GET['showlabels']==1)     { $variables['showlabels']   = TRUE;}
else                                                            { $variables['showlabels']   = FALSE;}

if (isset($_GET['showkey']) && $_GET['showkey']==1)           { $variables['showkey']      = TRUE;}
else                                                            { $variables['showkey']      = FALSE;}

if (isset($_GET['showvalues']) && $_GET['showvalues']==1)     { $variables['showvalues']   = TRUE;}
else                                                            { $variables['showvalues']   = FALSE;}

// visstyle
if (isset($_GET['visstyle']) && $_GET['visstyle']!='')        { $variables['visstyle']     = $_GET['visstyle'];} 
else                                                            { $variables['visstyle']     = 'total_gradient';}

// colours
if (isset($_GET['color']) and $_GET['color']!='' )            {$variables['colour'] =$_GET['color'] ;}
else {
     if (isset($_GET['colour']) and $_GET['colour']!='')      { $variables['colour'] =$_GET['colour'];} 
}
if (!isset($variables['colour']) ) {$variables['colour']= 0 ; }

return $variables;	
	
	
}

Function process_post($POST) {
	
if (isset($_POST['type']) && $_POST['type']!='')                { $variables['type']         = $_POST['type']; } 
else                                                            { $variables['type']         = 'man'; }
if (isset($_POST['title']) && $_POST['title']!='')            { $variables['title']    = $_POST['title']; } 
else                                                          { $variables['type']         = ' '; }


// check arrangement
// note Arrangement can be overridden dependant on numicons
if (isset($_POST['arrangement']) && $_POST['arrangement']!='')  { $variables['arrangement']  = $_POST['arrangement']; }
else                                                            { $variables['arrangement']  = 'block'; }

// values building
// check the number of values
if (isset($_POST['numvalues']) && $_POST['numvalues']!='')      { $variables['numvalues']    = $_POST['numvalues']; } 
if(!isset($_POST['numvalues']) or ($_POST['numvalues']=='0') )  { $variables['numvalues']    = 1; }

// api numvalues fix
if ($variables['numvalues'] == '0')                           { $variables['numvalues']    = '1'; }
// check the number of icons ( not always applicable)
if (isset($_POST['numicons']) && ($_POST['numicons']!='' ) )    { $variables['numicons']     = $_POST['numicons'];   } 
if(!isset($_POST['numicons']) or ($_POST['numicons']=='0') )    { $variables['numicons']     = 1; }

if (isset($_POST['value'])   )                                 { $variables['value']       = $_POST['value1'] ;} 
else                                                            { $variables['value']       = 50 ;}
if ($variables['value']== 0 )                                  { $variables['value']       = 50 ;}

if (isset($_POST['showvalues'])   )                                 { $variables['showvalues']       = $_POST['showvalues'] ;} 
else                                                            { $variables['showvalues']       = TRUE ;}			

// headers & labels
if (isset($_POST['showheader']) && $_POST['showheader']==1)     { $variables['showheader']   = TRUE ;}
else                                                            { $variables['showheader']   = FALSE;}

if (isset($_POST['showlabels']) && $_POST['showlabels']==1)     { $variables['showlabels']   = TRUE;}
else                                                            { $variables['showlabels']   = FALSE;}

if (isset($_POST['showkey']) && $_POST['showkey']==1)           { $variables['showkey']      = TRUE;}
else                                                            { $variables['showkey']      = FALSE;}

if (isset($_POST['showvalues']) && $_POST['showvalues']==1)     { $variables['showvalues']   = TRUE;}
else                                                            { $variables['showvalues']   = FALSE;}

// visstyle
if (isset($_POST['visstyle']) && $_POST['visstyle']!='')        { $variables['visstyle']     = $_POST['visstyle'];} 
else                                                            { $variables['visstyle']     = 'total_gradient';}

// colours
// colours
if (isset($_POST['color']) and $_POST['color']!='' )            {$variables['colour'] =$_POST['color'] ;}
else {
     if (isset($_POST['colour']) and $_POST['colour']!='')      { $variables['colour'] =$_POST['colour'];} 
}
if (!isset($variables['colour']) ) {$variables['colour']= 0 ;}

return $variables;
}






?>