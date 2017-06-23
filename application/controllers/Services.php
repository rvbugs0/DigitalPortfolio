<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();
        $this->load->model("Services_model");
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
		$this->load->view('Services',array('error' => ' ' ));
	}

	public function add()
	{


		$title = "";
		$description = "";
		$image = "";

		if(!$this->input->post("title")) die("Title not specified");
		else $title = trim($this->input->post("title"));

		if(!$this->input->post("description")) die("Description not specified");
		else $description = trim($this->input->post("description"));

		$newName = uniqid();

		$config['upload_path']          = './uploads/services';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 1920;
        $config['max_height']           = 1080;
        $config['file_name']			= $newName;

        $this->load->library('upload', $config);
		
        if ( ! $this->upload->do_upload("tnimage"))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('Services', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $uploadedName = $data["upload_data"]["file_name"];
            $imageUrl = base_url()."uploads/services/".$uploadedName;

            echo $imageUrl;
        }



	}








}
