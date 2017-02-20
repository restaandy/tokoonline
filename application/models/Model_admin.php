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

}
?>