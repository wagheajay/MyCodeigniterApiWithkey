
<?php


class Api extends CI_Controller

{


    private function api_key()
    {
        $key = $this->api_model->get_api_key();
        return $key;
    }


    //get all flowers data
    public function get_flowers()
    {

        if (isset($_GET['api_key'])) {

            $access_key_received = $this->encryption->decrypt($_GET['api_key']);
    
            if ($access_key_received == $this->api_key()) {

                $result = $this->api_model->get_flower();

                if(empty($result)){
                    echo " No Data Found";
                    $this->output->set_status_header(404);
                    return;
                }
                    echo json_encode(['flower'=>$result],JSON_UNESCAPED_UNICODE);
                    $this->output->set_status_header(200);
                }
            

                
            } else {
                echo "The API Key is Invalid!";
                $this->output->set_status_header(401);
            }
        
        }
         


    //get flower by id
    //      api/get_flower_by_id/
    public function get_flower_by_id()
    {
        if(isset($_GET['id'])){
            $id = ($_GET['id']);

            if(empty($id)){
                echo json_encode('id is null, please provide id parameter');
                return;
               }

       }

        if (isset($_GET['api_key'])) {

            $access_key_received = $this->encryption->decrypt($_GET['api_key']);
    
            if ($access_key_received == $this->api_key()) {

                $result = $this->api_model->get_flower_by_id($id);

                if(empty($result)){
                    echo " No Record Found,Try Other id";
                    $this->output->set_status_header(404);
                    return;
                }

                echo json_encode($result,JSON_UNESCAPED_UNICODE);
                $this->output->set_status_header(200);
            } else {
                echo "The API Key is Invalid!";
                $this->output->set_status_header(401);
            }
        }
    }


    //delete flower by id
    public function delete_flower_by_id()
    {

        if(isset($_GET['id'])){
            $id = ($_GET['id']);

            if(empty($id)){
                echo json_encode('id is null, please provide id parameter');
                return;
               }

       }
 
        if (isset($_GET['api_key'])) {

            $access_key_received = $this->encryption->decrypt($_GET['api_key']);
    
            if ($access_key_received == $this->api_key()) {

                $result = $this->api_model->delete_flower_by_id($id);

                if($result){
                    echo json_encode("deleted item with id " .$id,JSON_UNESCAPED_UNICODE);
                    $this->output->set_status_header(200);
                }

                
            } else {
                echo "The API Key is Invalid!";
                $this->output->set_status_header(401);
            }
        }
    }
}
