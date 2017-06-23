<!DOCTYPE html>
<html>
<head>
<?php include_once("includes/head.php");  ?>
</head>
<body>

<h1>New Admin</h1>

<form action="<?php  echo base_url(); ?>index.php/welcome/firstrun" method="post">
	<table>
		<tr>
			<td>Admin Name</td>
			<td><input type="type" name="adminName"></td>
		</tr>
		<tr>
			<td>Admin Email</td>
			<td><input type="type" name="adminEmail"></td>
		</tr>
		<tr>
			<td>Admin Password</td>
			<td><input type="Password" name="adminPassword"></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type="Password" name="confirmPassword"></td>
		</tr>
	</table>
	<br>
	<button type="submit">Submit</button>
</form>




</body>
</html>