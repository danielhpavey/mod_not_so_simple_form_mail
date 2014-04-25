<?php
defined( '_JEXEC' ) or die;

echo '<div class="moduletable' .  $moduleclass_sfx . '">';
echo '<form action="' . $currenturl . '" method = "post" id="simpleform"">';
echo '<Legend>' . $params->get('form_title', '') . '</legend>';
echo '<fieldset>';
echo '<fieldset>';
foreach ( $fields as $f )
	echo $f . '<br />';


echo '<input type = "hidden" name = "action" value = "submit">';
echo '</fieldset>';
echo '<fieldset>';
echo '<label>&nbsp;</label><input type = "submit" class = "button" value = "' . $params->get('submitbuttontext', '') . '">';
echo '</fieldset>';
echo '</fieldset>';

echo '</form>';
echo '<script>
	$("#simpleform").validate();
	</script>';
echo '</div>';
