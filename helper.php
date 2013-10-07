<?php


class createInput{
			
	public static function createInputDisplay($label, $type, $name, $required)
		{
		
		$input = '';
		$input .= '<label>' . $label . '</label>';
		
		if($type == "textarea")
			{
			$input .= '<textarea name = "' . str_replace(' ', '_', strtolower($name));
			$input .= $required == 1 ? ' required ' : '';
			$input .= '">';
			$input .= '</textarea>';
			
			}
		else
			{			
			$input .= '<input type ="' . $type . '"';



			$input .= ' name = "' . str_replace(' ', '_', strtolower($name)) . '"';
			$input .= ' value=""';
			$input .= $required == 1 ? ' required ' : '';
			$input .=  '/>';
			}
			
		return $input;
	
		} 
}


class form_submit{

		function __construct( $postdata, $mail, $message ){
			$this -> post = $postdata;
			$this -> recipient = $mail;
			$this -> message = $message;
		}
	
		function send(){

		$mailer =& JFactory::getMailer();
		$config =& JFactory::getConfig();

		if ( isset($this -> sender )){
			$senderaddress = $this -> post[$this -> sender];
			$sender = array( $senderaddress, $senderaddress );
		} else {
		$sender = array( 
	    $config->getValue( 'config.mailfrom' ),
	    $config->getValue( 'config.fromname' ) );
		}
	 	$mailer->setSender($sender);

		$mailer->addRecipient($this -> recipient);

		$mailer->setSubject('Enquiry From Your Website');

		$body = '';
		$postexcludearray = array( 'action', 'view', 'option');
		foreach( $this -> post as $key=>$data ){
			!in_array($key, $postexcludearray) ? $body .= str_replace('_', ' ', ucwords($key)) . ': ' . htmlentities($data) . '<br />' : '';
		}
		
		$mailer->setBody(nl2br(str_replace('\\', '', $body)));

		$mailer->isHTML(true);
		$mailer->Encoding='8bit';

		$send =& $mailer->Send();
		if ( $send !== true ) {
		    $result =  'Error sending email: ' . $send->get('message');
		} else {
		    $result = htmlentities($this -> message);
		}

			$this -> mailsendresult = $result;	
		}


	function __set($property, $value){

	$this->$property = $value;

	}




}

?>
