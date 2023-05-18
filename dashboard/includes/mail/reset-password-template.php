<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TRUST CARE</title>

<style>
	body{
		font-size: 1rem;
	}
	table tr td{
		padding-left: 5px;
	}
</style>
</head>
<body>
	  
	<?php $user = find_customer($user_id); ?>
	<?php  
		$key = $password;
		$user_id = encryption($user_id);
		$output='<p>Dear user,</p>';
		$output.='<p>Please click on the following link to reset your password.</p>';
		$output.='<p>-------------------------------------------------------------</p>';
		$output.='<p><a href="http://harshita.tclinfotech.in/reset-password.php?key='.$key.'&uid='.$user_id.'&action=reset" target="_blank">
		http://harshita.tclinfotech.in/reset-password.php
		?key='.$key.'&uid='.$user_id.'&action=reset</a></p>';		
		$output.='<p>-------------------------------------------------------------</p>';
		$output.='<p>Please be sure to copy the entire link into your browser.
		The link will expire after 1 day for security reason.</p>';
		$output.='<p>If you did not request this forgotten password email, no action 
		is needed, your password will not be reset. However, you may want to log into 
		your account and change your security password as someone may have guessed it.</p>';   	
		$output.='<p>Thanks,</p>';
		echo $output;
	?>


	 
</body>
</html>