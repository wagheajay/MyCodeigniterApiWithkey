
<?php


class Api extends CI_Controller

{


    private function api_key()
    {
        $key = $this->api_model->get_api_key();
        return $key;
    }


    //get all flowers database info
    public function get_flowers()
    {

        if (isset($_GET['api_key'])) {

            $access_key_received = $this->encryption->decrypt($_GET['api_key']);
    
            if ($access_key_received == $this->api_key()) {

                $result = $this->api_model->get_flower();

                echo json_encode($result,JSON_UNESCAPED_UNICODE);
                $this->output->set_status_header(200);
            } else {
                echo "The API Key is Invalid!";
                $this->output->set_status_header(401);
            }
        }
    }


    public function get_flower_by_id($id)
    {

        if (isset($_GET['api_key'])) {

            $access_key_received = $this->encryption->decrypt($_GET['api_key']);
    
            if ($access_key_received == $this->api_key()) {

                $result = $this->api_model->get_flower_by_id($id);

                echo json_encode($result,JSON_UNESCAPED_UNICODE);
                $this->output->set_status_header(200);
            } else {
                echo "The API Key is Invalid!";
                $this->output->set_status_header(401);
            }
        }
    }


    public function delete_flower_by_id($id)
    {

        if (isset($_GET['api_key'])) {

            $access_key_received = $this->encryption->decrypt($_GET['api_key']);
    
            if ($access_key_received == $this->api_key()) {

                $result = $this->api_model->delete_flower_by_id($id);

                echo json_encode("deleted item with id " .$id,JSON_UNESCAPED_UNICODE);
                echo json_encode($result,);
                $this->output->set_status_header(200);
            } else {
                echo "The API Key is Invalid!";
                $this->output->set_status_header(401);
            }
        }
    }
}
