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
	  
	<?php $user = find_doctor_by_username($user_id); ?>


	<table border="1" cellpadding="2px" cellspacing="0" style="border-collapse: collapse; width: 100%">
		<tr>
			<th colspan="2" style="background-color: #F0F8FF; color: #000; font-size: 22px; margin:0px; padding: 5px">Trust Care Welcomes You</th>
		</tr>
		<?php if(is_array($user)): ?>
			<tr>
				<th colspan="2" style="background-color: #F0F8FF; color: #000; font-size: 22px; margin:0px; padding: 5px">Dear <?php echo ucwords($user['name']); ?>, you are registered with us successfully, following are the account details.</th>
			</tr>
			<tr>
				<th style="background-color: #F0F8FF; color: #000; font-size: 14px; margin:0px; padding: 5px">Name</th>
				<td><?php echo ucwords($user['name']); ?></td>
			</tr>
			
			<tr>
				<th style="background-color: #F0F8FF; color: #000; font-size: 14px; margin:0px; padding: 5px">Username</th>
				<td><?php echo $user['email']; ?></td>
			</tr>
			<tr>
				<th style="background-color: #F0F8FF; color: #000; font-size: 14px; margin:0px; padding: 5px">Password</th>
				<td><?php echo $password; ?></td>
			</tr>
			 
			<tr>
				<th colspan="2" style="background-color: #F0F8FF; color: #000; font-size: 22px; margin:0px; padding: 5px"><a href="http://harshita.tclinfotech.in/dashboard/doctor-login.php" target="_blank">Login to Account</a></th>
			</tr>
		<?php endif; ?>
	</table>
</body>
</html>