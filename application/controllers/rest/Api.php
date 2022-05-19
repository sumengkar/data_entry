<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load these helper to create JWT tokens
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model('user/user_m');    
    }

    public function get_me_data_post()
    {
        // Call the verification method and store the return value in the variable
        $data = $this->user_m->verify_jwt_request();
        // Send the return data as reponse
        $status = parent::HTTP_OK;
        $response = ['status' => $status, 'data' => $data];
        $this->response($response, $status);
    }

}