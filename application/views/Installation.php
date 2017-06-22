<!DOCTYPE html>
<html>
<head>
	<title>System Installation.php</title>
</head>
<body>
<!--
changed config/autoload.php
$autoload['helper'] = array(''); -> $autoload['helper'] = array('url');

changed config/config.php
$config['base_url'] = ''; -> $config['base_url'] = 'http://localhost:9090/digiport/';

-->
<form action="<?php echo base_url();?>index.php/welcome/installtables" method="post"> 
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