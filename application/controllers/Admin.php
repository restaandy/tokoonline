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

			$datainput=array(
				'nama_brg'=>$this->input->post('nama_barang'),
				'kategori'=>implode(",",$this->input->post('kategori_barang')),
				'tag'=>$this->input->post('tag_barang'),
				'keyword'=>$this->input->post('keyword_barang'),
				'deskripsi'=>$this->input->post('deskripsi_barang'),
				'keterangan'=>$this->input->post('keterangan_barang'),
				'harga'=>$this->input->post('harga_barang'),
				'stock'=>$this->input->post('stok_barang'),
				'video'=>$this->input->post('video_barang'),
				'status'=>$this->input->post('status_barang')
			);
			$image=$this->input->post("img");
			foreach ($image as $index=>$key) {
				$dataimage=json_decode($key);
				$this->db->set('gambar_aktiv', 1,FALSE);
				$this->db->set('gambar_'.($index+1), $dataimage->message);
			}
			$this->db->set('date_update', 'NOW()', FALSE);
			$this->db->set('id_barang', random_string('alnum', 8));
			$this->db->insert("barang",$datainput);
			if($this->db->affected_rows()>0){
				$this->session->set_flashdata("simpan",array("status"=>true));
			}else{
				$this->session->set_flashdata("simpan",array("status"=>false));
			}
			redirect("admin/barang");
	}
	public function upload_image(){
		if($this->input->is_ajax_request()){
			$config['upload_path'] = './assets/upload/image/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']     = '500';
			$config['max_width'] = '768';
			$config['max_height'] = '768';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
				if ($this->upload->do_upload("file")) {
					echo json_encode(array("status"=>true,"message"=>$this->upload->data('file_name')));
				}else{
					echo json_encode(array("status"=>false,"message"=>$this->upload->display_errors()));
				}
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
