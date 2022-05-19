<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Class Frontend_Controller
* @author   Sumengkar_
*/
class Frontend_controller extends CORE_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        // Set Frontend Theme
        $this->load->model('setting/setting_m');
        if ($this->setting_m->get_setting('active_theme')) {
        	$this->data['active_theme'] = $this->setting_m->get_setting('active_theme');
		} else {
			$this->data['active_theme'] = 'default';
		}
    }
}