<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class CORE_Controller
 * @author	Sumengkar_
 */
class CORE_Controller extends CI_Controller
{
    public $data = array();
    function __construct() {
        parent::__construct();
        $this->data['error'] = array();
        $this->session->set_flashdata('error', NULL);
    }
}