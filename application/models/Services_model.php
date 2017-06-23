<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Services_model extends CI_Model
{
	public $title;
	public $description;
	public $imageUrl;
    public $admin;
	
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function getCount()
    {
        $this->db->from('Services');
        return $this->db->count_all_results();
    }

    public function add($title,$description,$imageUrl,$admin)
    {
        $this->title = trim($title);
        $this->description  = trim($description);
        $this->imageUrl  = trim($imageUrl);
        $this->admin = trim($admin);
        $this->db->insert('Services', $this);
        return $this->db->insert_id();    
    }

    public function update($title,$description,$imageUrl,$admin,$code)
    {
        $this->title = trim($title);
        $this->description  = trim($description);
        $this->imageUrl  = trim($imageUrl);
        $this->admin = trim($admin);
        $this->db->where('code',$code);
        $this->db->update('Services',$this);
        return $this->db->affected_rows();    
    }

    public function delete($code)
    {
        $this->db->where('code', $code);
        $this->db->delete('Services'); 
    }

}


?>