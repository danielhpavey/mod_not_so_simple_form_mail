<?php
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
include('helper.php');
if(isset($_POST["action"]))
	{
	$valfields = new FormValFields();
	$fieldnumber = 19;
	$fieldcounter = 1;
	while ( $fieldcounter != $fieldnumber ){
	$label = str_replace( ' ', '_', strtolower($params->get('label' . $fieldcounter, '')));
	$type = $params->get('type' . $fieldcounter,'');
	$params->get('display' . $fieldcounter, '') == 1 ? $valfields ->  $label = $type  : false ; 
	$fieldcounter ++;
	}  
	
	// var_dump ($valfields);

	$validation = new FormValidation( $valfields, $_POST);
	$val =  $validation -> validate();
	if ($val == 0){
	$send = new form_submit($_POST, $params->get('email', ''), $params->get('message', ''), $params->get('subject', '') );
	if (strlen($params->get('sender', '')) > 1){
		$send ->sender = $params->get('sender', '');
	}
	$send -> send();
	
	if ( strlen ( $params->get( 'redirect', '')) > 2){
		$header = JURI::base() . $params->get( 'redirect', '');
		header ( "Location:$header");

	} else {
	require JModuleHelper::getLayoutPath('mod_not_so_simple_form_mail', $params->get('layout', 'response'));
	}
	}
	else { echo "There was an error with the information you submitted.  Please try again.";}
	}
	else
	{
	$currenturl = JURI::current();
	$fields = array();
	$fieldnumber = 19;
	$fieldcounter = 1;
	while ( $fieldcounter != $fieldnumber ){
	$params->get('display' . $fieldcounter, '') == 1 ? $fields[] = createInput::createInputDisplay($params->get('label' . $fieldcounter, ''), $params->get('type' . $fieldcounter, ''), $params->get('label' . $fieldcounter, ''), $params->get('required' . $fieldcounter, ''), $params->get('placeholders')) : false;
	$fieldcounter ++;
	}

	require JModuleHelper::getLayoutPath('mod_not_so_simple_form_mail', $params->get('layout', 'default'));

}

?>
