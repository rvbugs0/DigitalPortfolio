<!DOCTYPE html>
<html>
<head>
	<?php include_once("includes/head.php");  ?>
</head>
<body>
<form action="<?php echo base_url();?>index.php/welcome/installTables" method="post"> 
<h1>Installation Form</h1>
<table>
	<tr>
		<td>DB Server Address :</td>
		<td><input type="text" name="dbServerName"></td>
	</tr>
	<tr>
		<td>Database Name :</td>
		<td><input type="text" name="dbName"></td>
	</tr>
	<tr>
		<td>Database Username :</td>
		<td><input type="text" name="dbUsername"></td>
	</tr>
	<tr>
		<td>Database Password :</td>
		<td><input type="password" name="dbPassword"></td>
	</tr>
</table>
<br>
<button type="submit">Submit</button>

</form>

</body>
</html>