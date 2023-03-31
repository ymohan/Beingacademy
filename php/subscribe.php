<?php

$recipient = "ymn0981@gmail.com";
$subject = "Subscription";


$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$email = $_REQUEST['email'];


mail( $recipient, $subject, "Name: $firstname $lastname\nEmail: $email\n" ) or die ("Mail could not be sent.");

?>