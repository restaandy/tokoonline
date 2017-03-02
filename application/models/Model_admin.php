<?php
class Model_admin extends CI_Model {

    public function get_id_barang_uniq()
    {
            for(;;){
                $id_barang=random_string('alnum', 8);
                $this->db->where("id_barang",$id_barang);
                $query=$this->db->get("barang");
                if($query->num_rows()==0){
                    break;     
                }
            }  
            return $id_barang;
    }
    public function get_stok(){
        $query=$this->db->get("barang");
        return $query;
    }
    public function barang_exist_by_id($id_barang){
        $this->db->where("id_barang",$id_barang);
        $query=$this->db->get("barang");
        if($query->num_rows()>0){
            return $query;     
        }else{
            return false;
        }
    }
    public function get_prov($id_provinsi=NULL){
        if($id_provinsi!=NULL){
            $this->db->where("id",$id_provinsi);
        }
        $query=$this->db->get("loc_prov");
        return $query;
    }
    public function get_kabkot($id_provinsi=NULL,$self=FALSE){
        if($id_provinsi!=NULL){
            if($self){
                $this->db->where("id",$id_provinsi);
            }else{
                $this->db->where("id_provinsi",$id_provinsi);    
            }
        }
        $query=$this->db->get("loc_kabkot");
        return $query;
    }
    public function get_kec($id_kabkot=NULL,$self=FALSE){
        if($id_kabkot!=NULL){
            if($self){
                $this->db->where("id",$id_kabkot);
            }else{
                $this->db->where("id_kabkot",$id_kabkot);    
            }
        }
        $query=$this->db->get("loc_kec");
        return $query;
    }
    public function get_toko_by_member($id_member){
        $this->db->where("id_member",$id_member);
        $query=$this->db->get("toko");
        return $query;
    }
    public function get_toko_by_id($id_toko){
        $this->db->where("id_toko",$id_toko);
        $query=$this->db->get("toko");
        return $query;
    }
    public function get_member_by_id($id_member){
        $this->db->where("id_member",$id_member);
        $query=$this->db->get("member");
        return $query;
    }
    public function get_kategori_ajax($kategori=NULL){
        $this->db->select("id,kategori as text");
        $this->db->from("kategori");
        $this->db->where('kategori like ',$kategori."%");
        $this->db->limit(15);
        $query=$this->db->get();
        return $query;
    }
    public function get_kategori_by_coma_separator($coma){
        $coma=explode(",",$coma);
        $this->db->where_in("id",$coma);
        $data=$this->db->get("kategori");
        return $data;
    }
}
?>