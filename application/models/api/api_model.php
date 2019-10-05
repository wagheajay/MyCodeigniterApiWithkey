
<?php

class Api_model extends CI_Model
{


  public function get_api_key()
  {

    $query = $this->db->query("Select *
				FROM api_table
        		WHERE (api_id = 1) AND (api_status = 1)");

    $query = $this->db->get('api_table');

    if ($query->num_rows() > 0) {

      $api_key = $this->encryption->decrypt($query->result()[0]->api_key);

      return $api_key;
    }
  }

  public function get_flower()
  {

    $query = $this->db->get('flowers');
    return $query->result();
  }

  public function create_flower($data)
  {

    $query = $this->db->insert('flowers',$data);
    return $query;
  }

  public function get_flower_by_id($id){
           
    $this->db->where('id',$id);
    $query = $this->db->get('flowers');
    return $query->row();
    

  }

  public function delete_flower_by_id($id){
           
    $check_id_exist = $this->db->get_where('flowers', array('id' => $id));
    
    if($check_id_exist->num_rows() > 0){

       $this->db->where('id',$id);
       $query = $this->db->delete('flowers');
       return $query;
    }
    else{

         echo 'Not found';

    }

  }
}
