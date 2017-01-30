<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	public function dashboard($content="",$key=NULL){
		if($key!=NULL && $key=="xxx!@#xxx"){
		$data=$content;
		$this->load->view('index_admin',$data);
		}else{
			redirect("not-found");
		}
	}
	public function index()
	{
		$data['title']="Dashboard | Admin";
		$data['logo']="Toko Online";
		$data['content']=$this->load->view("page/dashboard",$data,true);
		$this->dashboard($data,"xxx!@#xxx");

	}
	public function barang()
	{
		$data['title']="Barang | Admin";
		$data['logo']="Toko Online";
		$data['content']=$this->load->view("page/barang",$data,true);
		$this->dashboard($data,"xxx!@#xxx");
	}
	public function not_found(){
		show_404();
	}

}
