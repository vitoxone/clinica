<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amazons3 extends CI_Controller {

	public function __construct() {
        parent::__construct();	
		$this->load->library('aws3');	
	}
	
	public function test_addbucket($name){
		$return = $this->aws3->addBucket($name);
		var_dump("test");
		var_dump($return);
	}
	
	public function index()
	{							
		//$this->mytemplate->loadAmin('view_aws',array('error' => ''));

		$datos['active_view'] = 'agenda';

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);
		$this->load->view('view_aws', $datos);
		$this->load->view('footer.php');
	}
	
	
	public function upload()
	{			
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 

		$datos['active_view'] = 'agenda';

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('view_aws', $error);
		}
		else
		{
			$image_data = $this->upload->data();
			$image_data['file_name'] = $this->aws3->sendFile('convatec2017concentimientos',$_FILES['userfile']);	
			$data = array('upload_data' => $image_data['file_name']);
			$this->load->view('view_aws', $data);
		}

		$this->load->view('footer.php');
	}

	public function listImages($bucketName){
		$result = $this->aws3->getAllImages($bucketName);
		var_dump($result);
	}
	
}
