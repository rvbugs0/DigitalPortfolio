<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	 public function __construct()
    {
        parent:: __construct();
        if(file_exists("custom/DatabaseConnection.php"))
        {
	        $this->load->model("Admin_model");        	
        }

    }

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
		if(!$this->Admin_model->getCount())
		{
			$this->load->view("CreateAdmin");
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
		if($done)
		{
			 redirect('/welcome', 'index');
		}
		else
		{
			die("Error occured during installation");
		}


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
            fputs($f," public "."$"."serverAddress = ".$serverName.";\r\n");
            fputs($f," public "."$"."dbName = ".$databaseName.";\r\n");
            fputs($f," public "."$"."dbUsername = ".$username.";\r\n");
            fputs($f," public "."$"."dbPassword = ".$password.";\r\n");
            fputs($f,"}\r\n");
            fputs($f,"?".">");
            fclose($f);
			while(!file_exists("custom/DatabaseConnection.php"))
			{
			    sleep(1);
			}
			$oldContents=file_get_contents("application/config/database.php");
           	$f=fopen("application/config/database.php","w");
           	$oldContents = str_replace("#serverAddress#",$serverName,$oldContents);
           	$oldContents = str_replace("#dbName#",$databaseName,$oldContents);
           	$oldContents = str_replace("#dbUsername#",$username,$oldContents);
           	$oldContents = str_replace("#dbPassword#",$password,$oldContents);
            fputs($f,$oldContents);
            fclose($f);
			sleep(2);
            $c=null;
	        $done=true;
        }

        catch(PDOException $pe)
        {
			print $pe->getMessage()."<br/>"; // remove after testing
            $done=false;
        }
        catch(Exception $e)
        {
			print $e->getMessage()."<br/>"; // remove after testing
            $done=false;
        }
        return $done;
    }

    function firstRun()
    {
    	$name="";
		$email = "";
		$password = "";
		
		if(!$this->input->post("adminName")) die("Admin name not specified");
		else $name = trim($this->input->post("adminName"));

		if(!$this->input->post("adminEmail")) die("Admin name not specified");
		else $email = trim($this->input->post("adminEmail"));

		if(!$this->input->post("adminPassword")) die("Admin name not specified");
		else $password = trim($this->input->post("adminPassword"));

		if($this->Admin_model->add($name,$email,$password))
		{
			echo "Admin Added";
		}
		else
		{
			echo "Failed to add Admin";
		}

    }



}
