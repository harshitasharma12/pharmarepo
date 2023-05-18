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
		$output.='<p>Please click on the following link to activate your account.</p>';
		$output.='<p>-------------------------------------------------------------</p>';
		$output.='<p><a href="http://harshita.tclinfotech.in/verify.php?key='.$key.'&uid='.$user_id.'&action=verify" target="_blank">
		http://harshita.tclinfotech.in/verify.php
		?key='.$key.'&uid='.$user_id.'&action=verify</a></p>';		
		$output.='<p>-------------------------------------------------------------</p>';
		$output.='<p>Please be sure to copy the entire link into your browser.
		The link will expire after 1 day for security reason.</p>';
		
		$output.='<p>Thanks,</p>';
		echo $output;
	?>


	 
</body>
</html>