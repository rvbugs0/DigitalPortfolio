<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		if(!file_exists("custom/DatabaseConnection.php"))
		{
			if(!file_exists("custom/tables.sql"))
			{
				die("custom/tables.sql missing");
			}
			$this->load->view("Installation");
			return;
		}
		$this->load->view('welcome_message');			
	}

	public function installTables()
	{

		$serverAddress="";
		$dbUsername = "";
		$dbPassword = "";
		$dbName = "";

		if(!$this->input->post("dbServerName")) die("server address not specified");
		else $serverAddress = trim($this->input->post("dbServerName"));

		if(!$this->input->post("dbName")) die("DB Name not specified");
		else $dbName = trim($this->input->post("dbName"));
		
		if(!$this->input->post("dbUsername")) die("DB Username not specified");
		else $dbUsername = trim($this->input->post("dbUsername"));

		if(!$this->input->post("dbPassword")) die("DB Password not specified");
		else $dbPassword = trim($this->input->post("dbPassword"));
		
		$done = self::install($serverAddress,$dbName,$dbUsername,$dbPassword);
		echo $done;

	}

	static function install($serverName,$databaseName,$username,$password)
    {
        $done=true;
        try
        {

            $c=new PDO("mysql:host=$serverName;dbname=$databaseName","$username","$password");
            $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         	$sql=file_get_contents("custom/tables.sql");
           	$c->exec($sql);
       
            $f=fopen("custom/DatabaseConnection.php","w");
            fputs($f,"<"."?"."php\r\n");
            fputs($f,"class DatabaseConnection\r\n");
            fputs($f,"{\r\n");
            fputs($f," public static function getConnection()\r\n");
            fputs($f," {\r\n");
            fputs($f," $"."c=null;\r\n");
            fputs($f," try\r\n");
            fputs($f," {\r\n");
            fputs($f," $"."c=new PDO(\"mysql:host=$serverName;dbname=$databaseName\",\"$username\",\"$password\");\r\n");
            fputs($f," $"."c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);\r\n");
            fputs($f," }catch(PDOException $"."pe)\r\n");
            fputs($f," {\r\n");
            fputs($f," return null;\r\n");
            fputs($f," }\r\n");
            fputs($f," catch(Exception $"."e)\r\n");
            fputs($f," {\r\n");
            fputs($f," return null;\r\n");
            fputs($f," }\r\n");
            fputs($f," return $"."c;\r\n");
            fputs($f," }\r\n");
            fputs($f,"}\r\n");
            fputs($f,"?".">");
            fclose($f);
			while(!file_exists("DatabaseConnection.php"))
			{
			    sleep(1);
			}
            $c=null;
	        $done=true;
        }

        catch(PDOException $pe)
        {
			print $pe->getMessage(); // remove after testing
            $done=false;
        }
        catch(Exception $e)
        {
			print $e->getMessage(); // remove after testing
            $done=false;
        }
        return $done;
    }



}
