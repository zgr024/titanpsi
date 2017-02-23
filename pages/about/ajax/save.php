<?php
	use \FSM\Model\incoming;
	
	require_once('lib/phpmailer/PHPMailerAutoload.php');
	
	if ($_SERVER['HTTP_REFERER'] != 'http://zrosenberg.com/about' && $_SERVER['HTTP_REFERER'] != 'http://flirtskirtormarry.com/about') exit (json_encode(array("error"=>"Invalid Referrer")));
	
	$incoming = new incoming($_POST);
	$incoming->save();
	
	$mail = new PHPMailer(); 
	$mail->From = 'ContactForm@flirtskirtormarry.com';
	$mail->FromName = 'FSM Contact Form';
	$mail->AddAddress('info@flirtskirtormarry.com'); 
	//$mail->AddAddress('zgr024@gmail.com'); 

	$mail->Subject = "Contact Form Submission"; 
	$mail->Body = '
		<div style="width: 800px;">
			<h2>A New Message Has Been Submitted</h2>
			<table width="100%">
				<tr>
					<th align="left" width="200">Name</th>
					<td>'.$_POST['name'].'</td>
				</tr>
				<tr>
					<th align="left">Email</th>
					<td>'.$_POST['email'].'</td>
				</tr>
				<tr>
					<th align="left">Subject</th>
					<td>'.$_POST['subject'].'</td>
				</tr>
				<tr>
					<th align="left">Message</th>
					<td>'.$_POST['message'].'</td>
				</tr>
			</table>
		</div>
	';
	$mail->IsHTML(true); 
	$mail->send();
	
	exit(json_encode(array("success"=>true,"record"=>$incoming)));