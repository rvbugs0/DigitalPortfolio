<!DOCTYPE html>
<html>
<head>
	<?php include_once("includes/head.php");  ?>
</head>
<body>

<h1>Add Services</h1>

<form action="<?php echo base_url();?>index.php/services/add" method="post"  enctype="multipart/form-data" > 
<table>
	<tr>
		<td>Title</td>
		<td><input type="text" name="title"></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><textarea name="description" rows="5"></textarea></td>
	</tr>
	<tr>
		<?php echo $error;?>
		<?php echo form_open_multipart('/services/add');?>
		<td>Image (Thumbnail)</td>
		<td><input type="file" name="tnimage"  /></td>
	</tr>
	<tr>
		<td>Admin Code</td>
		<td><input type="number" name="admin"></td>
	</tr>
</table>
<br>
<button type="submit">Submit</button>

</form>

</body>
</html>