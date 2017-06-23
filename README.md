# DigitalPortfolio

<br>

<h2>Configuration</h2>

changed config/autoload.php
$autoload['helper'] = array(''); -> $autoload['helper'] = array('url');

changed config/config.php
$config['base_url'] = ''; -> $config['base_url'] = 'http://localhost:9090/digiport/';

<hr>

#Documentation

Upon copying the project files to server root, when the site is accessed, the program checks for existence of custom/DatabaseConnection.php file.

<b>custom/DatabaseConnection.php</b> is a dummy file, which is created when the Database connection details provided by the user are valid and connection setup is successful.
<br>
This file has just one purpose and that is to check if the database details have been set-up.
With the creation of this file the contents of the file <b>application/config/database.php</b> are updated with the database details.

<br>

Upon successful connection, the next step is to check for existence of an Admin record in the Admin  table.

If the Count(Admin) == 0 , the process to add a new (First) admin is initiated and the user is presented with the Add Form.
<br>
Once the admin is created, user is redirected to home page where he/she can choose to login / browse the website.
<br> 
