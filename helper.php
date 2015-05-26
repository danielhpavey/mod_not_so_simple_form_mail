<?php

class createInput{
			
	public static function createInputDisplay($label, $type, $name, $required, $placeholders)
		{
		
		$input = '';
		if ( $placeholders == 0 ){
		$input .= '<label>' . $label . '</label>';
		}
		
		if($type == "textarea")
			{
			$input .= '<textarea name = "' . str_replace(' ', '_', strtolower($name)) . '"';
			$input .= $required == 1 ? ' required ' : '';
			if ( $placeholders == 1 ){
			$input .= ' placeholder="' . $label . '" ';
			}
			$input .= '>';
			$input .= '</textarea>';
			
			}
		else
			{			
			$input .= '<input type ="' . $type . '"';



			$input .= ' name = "' . str_replace(' ', '_', strtolower($name)) . '"';
			$input .= ' value=""';
			$input .= $required == 1 ? ' required ' : '';
			if ( $placeholders == 1 ){
			$input .= ' placeholder="' . $label . '" ';
			}
			$input .=  '/>';
			}
			
		return $input;
	
		} 


}


class form_submit{

		function __construct( $postdata, $mail, $message, $subject ){
			$this -> post = $postdata;
			$this -> recipient = $mail;
			$this -> message = $message;
            $this -> subject = $subject;
		}
	
		function send(){

		$mailer =& JFactory::getMailer();
		$config =& JFactory::getConfig();
        $jversion = new JVersion();

		if ( isset($this -> sender )){
			$senderaddress = $this -> post[$this -> sender];
			$sender = array( $senderaddress, $senderaddress );
		} else {

            if ( $jversion->RELEASE > 3 ){
                $sender = array( 
                $config->get( 'config.mailfrom' ),
                $config->get( 'config.fromname' ) );
            
            } else {
                $sender = array( 
                $config->getValue( 'config.mailfrom' ),
                $config->getValue( 'config.fromname' ) );
            }
        }

	 	$mailer->setSender($sender);

		$mailer->addRecipient($this -> recipient);

		$mailer->setSubject( $this -> subject );

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


class FormValidation{

	
	function __construct( $valfields, $postdata){
		$this -> valfields = $valfields;
		$this -> post = $postdata;
		//var_dump($this -> valfields);
		//var_dump($this -> post);
	}

	function validate(){

		$err = '0';

		foreach ( $this -> post as $key => $data ){

		if ( $this -> valfields -> $key ){

		if ( $this -> valfields -> $key == "text" || $this -> valfields -> $key == "textarea"  && strlen($data) > 1 ){
		if ( $data != strip_tags( $data )){	
		$err = 1;
		}
		}
		}

		}

		return $err;

			

	}

}

class FormValFields{

	function __set($property, $value){

	$this->$property = $value;

	}

	function __get($property){

	if (isset($this->$property))
	return $this->$property;

	}



}

?>
