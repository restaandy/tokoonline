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
		$data['minlogo']="TO";
		$data['content']=$this->load->view("page/barang",$data,true);
		$this->dashboard($data,"xxx!@#xxx");
	}
	function simpan_barang(){
		print_r($this->input->post());
			$datainput=array(
				'nama_brg'=>$this->input->post('nama_barang'),
				'kategori'=>implode(",",$this->input->post('kategori_barang')),
				'keyword'=>$this->input->post('keyword_barang'),
				'deskripsi'=>$this->input->post('deskripsi_barang'),
				'keterangan'=>$this->input->post('keterangan_barang'),
				'harga'=>$this->input->post('harga_barang'),
				'stock'=>$this->input->post('stok_barang'),
				'status'=>$this->input->post('status_barang')
			);
			$this->db->set('date_update', 'NOW()', FALSE);
			$this->db->insert("barang",$datainput);
			if($this->db->affected_rows()>0){
				
			}else{
				
			}
	}
	public function upload_image(){
		if($this->input->is_ajax_request()){
		$ds          = DIRECTORY_SEPARATOR;  //1
 
		$storeFolder = '../../assets/upload/image';   //2
 
		if (!empty($_FILES)) {
		     
		    $tempFile = $_FILES['file']['tmp_name'];          //3             
		      
		    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
		     
		    $targetFile =  $targetPath.$_FILES['file']['name'];  //5
		 
		    move_uploaded_file($tempFile,$targetFile); //6
		     
		}
		echo $_FILES['file']['name'];
		}
	}
	public function remove_image(){
		if($this->input->is_ajax_request()){
		   $storeFolder = './assets/upload/image/';   //2
		   $file=$this->input->post("filename");
		   
		   	if(!unlink($storeFolder.$file)){
		   		echo "gagal".$storeFolder.$file;
		   	}else{
		   		echo "berhasil";
		   	}
		   
		}
	}
	public function not_found(){
		show_404();
	}

}
