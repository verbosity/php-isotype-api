<?php

// input functions for isotype api

// this file contains all the functions for processing the $_GET and $_POST values in the isotype api
// it has been seperated out to allow for better readability and commenting of both these functions and the main api file

function process_get($_GET) {
if (isset($_GET['type']) && $_GET['type']!='')                { $variables['type']         = $_GET['type']; } 
else                                                            { $variables['type']         = 'couple'; }

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

if (isset($_GET['value1'])   )                                 { $variables['value1']       = $_GET['value1'] ;} 
else                                                            { $variables['value1']       = 50 ;}
if ($variables['value1']== 0 )                                  { $variables['value1']       = 50 ;}
		

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
if (!isset($_GET['palette']) or $_GET['palette']!='')         { $variables['palette']['value']  = 1;} 
else                                                            { $variables['palette']['value']  =$_GET['palette'];}	

return $variables;	
	
	
}

Function process_post($POST) {
	
if (isset($_POST['type']) && $_POST['type']!='')                { $variables['type']         = $_POST['type']; } 
else                                                            { $variables['type']         = 'couple'; }

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

if (isset($_POST['value1'])   )                                 { $variables['value1']       = $_POST['value1'] ;} 
else                                                            { $variables['value1']       = 50 ;}
if ($variables['value1']== 0 )                                  { $variables['value1']       = 50 ;}
		

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
if (!isset($_POST['palette']) or $_POST['palette']!='')         { $variables['palette']['value']  = 1;} 
else                                                            { $variables['palette']['value']  =$_POST['palette'];}	

return $variables;
}






?>