<?php
// Output messages
$response = '';
// Check if the form was submitted
  if (isset($_POST['name'], $_POST['email'], $_POST['age'])) {
    // Process form data 
    // Assign POST variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $interests = $_POST['interests'];
    $availability = $_POST['availability'];
    // Validate input
	   if (empty($name) || empty($email) || empty($age) || !is_numeric($age) || $age < 18 || $age > 99) {
		// Display error message to user
			$response = '<p>Please enter a valid name, email, and age between 18 and 99.</p>';
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// Display error message to user
			$response = '<p>Please enter a valid email address.</p>';
		} else {
			// Process form data
			// ...
		}
        
        // Where to send the mail? It should be your email address
      $to      = 'ymn0981@gmail.com';
      // Mail from
      $from    = 'noreply@cutlistinteriors.in';
      // Mail subject
      $subject = 'New volunteer submission';
      // Mail headers
      $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'Return-Path: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
      // Define email template for recipient
      $recipient_template = '<html>
        <body>
          <h1>New Volunteer Submission</h1>
          <p>A user has submitted a new volunteer form with the following information:</p>
          <ul>
            <li>Name: ' . htmlspecialchars($name, ENT_QUOTES) . '</li>
            <li>Email: ' . htmlspecialchars($email, ENT_QUOTES) . '</li>
            <li>Age: ' . htmlspecialchars($age, ENT_QUOTES) . '</li>
            <li>Phone: ' . htmlspecialchars($phone, ENT_QUOTES) . '</li>
            <li>Interests: ' . htmlspecialchars($interests, ENT_QUOTES) . '</li>
            <li>Availability: ' . htmlspecialchars($availability, ENT_QUOTES) . '</li>
          </ul>
        </body>
      </html>';
      // Define email template for sender
      $sender_template = '<html>
        <body>
          <p>Dear ' . htmlspecialchars($name, ENT_QUOTES) . ',</p>
          <p>Thank you for submitting a volunteer form. We appreciate your interest in our organization and will be in touch shortly.<br><br> Best regards, <br>Volunteer team</p>
        </body>
      </html>';
      // Capture the email template file as a string
      ob_start();
      include 'mail-template.php';
      $email_template = ob_get_clean();        
      if (mail($to, $subject, $recipient_template, $headers)) {
        // Success
        $sender_success = mail($email, 'Thank you for your volunteer submission', $sender_template, $headers);
        if ($sender_success) {
            $response = 'success';
        } else {
            $response = '<p>There was an error sending the confirmation email.</p>';
        }
        
        } else {
        // Failure
        $response = '<p>There was an error sending your message. Please try again later.</p>';
      }
    }    
  }    
  // Output response
  echo $response;
?>