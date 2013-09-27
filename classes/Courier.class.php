<?php
// classes/Courier.class.php

/**
 * This class emails converts and emails data from the Email class
 * It takes an Email and uses the mail() function to send it out
 *
 */
class Courier {
    const SEND_OK = 0;
	const SENT_FAIL = 1;
	

	/**
	 * Make text rfj2047 compliant	
	 * We can convert HTML
 	 * character entities into ISO-8859-1, 
 	 * then converting the charset to 
 	 * Base64 for rfc2047 email subject compatibility.
	 */
	public function rfc2047_sanitize($input) {
		$output = mb_encode_mimeheader(
			html_entity_decode(
				$input,
				ENT_QUOTES,
				'ISO-8859-1'),
			'ISO-8859-1','B',"\n");
		return $output;
	}
	
    /**
	 * Set the Email object to draw the information from
	 *
	 * @parameter $email the email to send
	 */
	public function send( $Email=null ) {
		// let's create the headers to show where the email 
		// originated from.
		$headers[] = 'From: '.$Email->sender;
		$headers[] = 'Reply-To: '.$Email->sender;
		
		
		
		// Subjects are tricky.  Even some 
		// sophisticated email clients don't
		// understand unicode subject lines. 
		$subject = rfc2047_sanitize($Email->subject);
		
		// try to send the email. 
		$result = mail( $recipient, 
			$subject, 
			$message, 
			implode("\r\n",$headers) 
		);
				
		// if it fails, let's throw up an error
		if ( !$result ) {
			return self::SEND_FAIL;
		} // fi result
		
		return self::SEND_OK;

	} // send
	
	
}
?>
