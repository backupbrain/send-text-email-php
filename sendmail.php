<?
// sendmail.php

require_once('classes/Email.class.php');
require_once('classes/Courier.class.php');

// construct the email
$Email = new Email();
$Email->sender = '"Example Company" <no-reply@example.com>';
$Email->recipient = '"Johnny Appleseed" <johnny@example.com>';
$Email->subject = "Thank you for subscribing!";
$Email->message = "Hello!

Thank you for subscribing to our newsletter!  We are excited to bring you updates about the new services we are offering.

We hope you enjoy our service!

Thank you,
The team.";

// send the email
$Courier = new Courier();
$sent = $Courier->send($Email);

?>
<h1>Send Email</h1>
<? if ($sent = Courier::SENT_OK) { ?>
    <p>Email sent to <?= $Email->recipient; ?></p>
<? } else { ?>
	<p>Email was not sent to <?= $Email->recipient; ?></p>
<? } ?>
