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
	public function __construct(){
                parent::__construct();
                $this->load->model('Model_admin');
        }
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
	public function liststok($id_barang=NULL){
		$data['title']="Stok Barang | Admin";
		$data['logo']="Toko Online";
		$data['minlogo']="TO";
		$query=$this->Model_admin->barang_exist_by_id($id_barang);
		if($id_barang==NULL){
			$data['barang']=$this->Model_admin->get_stok();
			$data['content']=$this->load->view("page/liststok",$data,true);
		}else if($query){
			$data['editbarang']=$query;
			$data['content']=$this->load->view("page/liststok",$data,true);
		}else{
			$data['barang']=$this->Model_admin->get_stok();
			$data['content']=$this->load->view("page/liststok",$data,true);
		}
		
		
		$this->dashboard($data,"xxx!@#xxx");
	}
	public function barang(){
		$data['title']="Tambah Barang | Admin";
		$data['logo']="Toko Online";
		$data['minlogo']="TO";
		$data['content']=$this->load->view("page/barang",$data,true);
		$this->dashboard($data,"xxx!@#xxx");
	}
	function simpan_barang(){
		if($this->input->post('token')!=NULL){
			$id_barang=$this->Model_admin->get_id_barang_uniq();
			$datainput=array(
				'nama_brg'=>$this->input->post('nama_barang'),
				'kategori'=>implode(",",$this->input->post('kategori_barang')),
				'tag'=>$this->input->post('tag_barang'),
				'keyword'=>$this->input->post('keyword_barang'),
				'deskripsi'=>$this->input->post('deskripsi_barang'),
				'keterangan'=>$this->input->post('keterangan_barang'),
				'harga'=>$this->input->post('harga_barang'),
				'stock'=>$this->input->post('stok_barang'),
				'kondisi'=>$this->input->post('kondisi'),
				'title_seo'=>$this->input->post('title_seo'),
				'permalink'=>$this->input->post('permalink'),
				'video'=>$this->input->post('video_barang'),
				'status'=>$this->input->post('status_barang')
			);
			$file1=$this->input->post("file1");
			$file2=$this->input->post("file2");
			$file3=$this->input->post("file3");
			$file4=$this->input->post("file4");
			$file5=$this->input->post("file5");
			$file6=$this->input->post("file6");
			$gambar_aktiv=0;
			if(file_exists("./assets/upload/temp_image/".$file1)&&$file1!=""){
				$this->db->set('gambar_1',$id_barang."#".$file1);
				$gambar_aktiv=1;
				rename("./assets/upload/temp_image/".$file1, "./assets/upload/image/".$id_barang."#".$file1);
			}
			if(file_exists("./assets/upload/temp_image/".$file2)&&$file2!=""){
				$this->db->set('gambar_2',$id_barang."#".$file2);
				$gambar_aktiv=$gambar_aktiv!=0?$gambar_aktiv:2;
				rename("./assets/upload/temp_image/".$file2, "./assets/upload/image/".$id_barang."#".$file2);
			}
			if(file_exists("./assets/upload/temp_image/".$file3)&&$file3!=""){
				$this->db->set('gambar_3',$id_barang."#".$file3);
				$gambar_aktiv=$gambar_aktiv!=0?$gambar_aktiv:3;
				rename("./assets/upload/temp_image/".$file3, "./assets/upload/image/".$id_barang."#".$file3);
			}
			if(file_exists("./assets/upload/temp_image/".$file4)&&$file4!=""){
				$this->db->set('gambar_4',$id_barang."#".$file4);
				$gambar_aktiv=$gambar_aktiv!=0?$gambar_aktiv:4;
				rename("./assets/upload/temp_image/".$file4, "./assets/upload/image/".$id_barang."#".$file4);
			}
			if(file_exists("./assets/upload/temp_image/".$file5)&&$file5!=""){
				$this->db->set('gambar_5',$id_barang."#".$file5);
				$gambar_aktiv=$gambar_aktiv!=0?$gambar_aktiv:5;
				rename("./assets/upload/temp_image/".$file5, "./assets/upload/image/".$id_barang."#".$file5);
			}
			if(file_exists("./assets/upload/temp_image/".$file6)&&$file6!=""){
				$this->db->set('gambar_6',$id_barang."#".$file6);
				$gambar_aktiv=$gambar_aktiv!=0?$gambar_aktiv:6;
				rename("./assets/upload/temp_image/".$file6, "./assets/upload/image/".$id_barang."#".$file6);
			}
			$this->db->set('gambar_aktiv', $gambar_aktiv);
			$this->db->set('date_update', 'NOW()', FALSE); 
			$this->db->set('id_barang', $id_barang);
			$this->db->insert("barang",$datainput);
			if($this->db->affected_rows()>0){
				$this->session->set_flashdata("simpan",array("status"=>true));
			}else{
				$this->session->set_flashdata("simpan",array("status"=>false));
			}
			redirect("admin/barang");
		}else{
			show_404();
		}
	}
	public function upload_image($edit=0){
		if($this->input->is_ajax_request()){
			if($edit==1){$folder="image";}
			else{$folder="temp_image";}
			$config['upload_path'] = './assets/upload/'.$folder.'/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']     = '500';
			$config['max_width'] = '768';
			$config['max_height'] = '768';
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = "1_".$_FILES['file']['name'];
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
			if($this->input->post('edit')=="1"){
				$folder="image/";
			}else{
				$folder="temp_image/";
			}
		   $storeFolder = './assets/upload/'.$folder;   //2
		   $file=$this->input->post("file");
		   if(file_exists($storeFolder.$file)){	
		   	if(!unlink($storeFolder.$file)){
		   		echo json_encode(array("status"=>false,"message"=>"File not exist"));
		   	}else{
		   		echo json_encode(array("status"=>true,"message"=>$file));
		   	}
		   }else{
		   	echo json_encode(array("status"=>false,"message"=>"File not exist"));
		   }
		}
	}
	public function not_found(){
		show_404();
	}

}
