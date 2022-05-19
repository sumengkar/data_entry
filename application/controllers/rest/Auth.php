<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends REST_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load these helper to create JWT tokens
        $this->load->helper(['jwt', 'authorization']);   

        $this->load->model('user/user_m'); 
    }

    public function login_post()
    {
        $user = $this->user_m->get_by(array(
            'username' => $this->post('username'),
            'password' => $this->user_m->hash($this->post('password'))
        ), TRUE);

        if ($user) {
            $token_data = md5($user['user_id']);

            // $login_data = array(
            //     'username'       => $user['username'],
            //     'firstname'      => $user['firstname'],
            //     'lastname'       => $user['lastname'],
            //     'email'          => $user['email'],
            //     'user_group_id'  => $user['user_group_id'],
            //     'user_privilege' => (int) $user['user_privilege'],
            //     'language_code'  => $user['language_code'],
            //     'image'          => $user['image'],
            //     'loggedin'       => TRUE
            // );

            // Create a token
            $token = AUTHORIZATION::generateToken($token_data);

            // Set HTTP status code
            $status = parent::HTTP_OK;

            // Prepare the response
            $response = ['status' => $status, 'token' => $token];
            // $response = ['status' => $status, 'token' => $token, 'login_data' => $login_data];
        } else {
            $status   = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
        }

        // REST_Controller provide this method to send responses
        $this->response($response, $status);
    }


}
