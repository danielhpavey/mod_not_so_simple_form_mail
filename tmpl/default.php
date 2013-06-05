<?php
defined( '_JEXEC' ) or die;

echo '<form action="' . $currenturl . '" method = "post" class="form-validate" onSubmit="return myValidate(this);">';
echo '<Legend>' . $params->get('form_title', '') . '</legend>';
echo '<fieldset>';
echo '<fieldset>';
foreach ( $fields as $f )
	echo $f . '<br />';


echo '<input type = "hidden" name = "action" value = "submit">';
echo '</fieldset>';
echo '<fieldset>';
echo '<label>&nbsp;</label><input type = "submit" class = "button" value = "Submit">';
echo '</fieldset>';
echo '</fieldset>';

echo '</form>';
