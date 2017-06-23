<?php if(! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_model extends CI_Model
{
	public $name;
	public $email;
	public $password;
	
	public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }

    public function exists($email)
    {
        $this->db->where('email', $email);
        $this->db->from('Admin');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCount()
    {
        $this->db->from('Admin');
        return $this->db->count_all_results();
    }

    public function add($name,$email,$password)
    {
        $this->name = trim($name);
        $this->email  = trim($email);
        $this->password  = md5(trim($password));
        $this->db->insert('Admin', $this);
        return $this->db->insert_id();    
    }

}


?>