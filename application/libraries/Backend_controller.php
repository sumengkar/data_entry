<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Class Backend_Controller
* @author	Sumengkar_
*/
class Backend_controller extends CORE_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user/user_m');
		$this->load->model('setting/setting_m');
		$this->load->model('localisation/language_m');

		// Login check
		$exception_uris = array(
			'user/login',
			'user/logout',
			'user/register'
		);

		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_m->loggedin() == FALSE) {
				// $redirect = current_url();
				redirect('/user/login');
			}
		}

		// Set languages
		$this->data['languages'] = $this->language_m->get_active();

		if (isset($this->session->userdata['language_code'])) {
			$language_name = $this->session->userdata['language_code'];
			if ($language_name) {
				$this->lang->load('index_lang', $language_name);
				$this->data['language_code']    = $language_name;
				$this->data['date_format_lite'] = get_language_date_format($language_name);
				$this->data['date_format_full'] = get_language_date_format($language_name, 'full');
			} else {
				$this->lang->load('index_lang', $this->config->item('language_code'));
				$this->data['language_code']    = $this->config->item('language_code');
				$this->data['date_format_lite'] = 'd M Y';
				$this->data['date_format_full'] = 'd M Y H:i:s';
			}
		} else {
			$this->lang->load('index_lang', $this->config->item('language'));
		}
	}

    // Validate accses
    public function validate_access($controller = NULL) {
        if ($this->user_m->hasPermission('access', $controller) === TRUE) {
        	return TRUE;
        }

        $this->session->set_flashdata('error', lang('error_permission'));
        return FALSE;
    }

    // Validate modify
    public function validate_modify($controller = NULL) {
        if ($this->user_m->hasPermission('modify', $controller) === TRUE) {
        	return TRUE;
        }

        $this->session->set_flashdata('error', lang('error_permission'));
        return FALSE;
    }

    // Validate publish
    public function validate_publish($controller = NULL) {
        if ($this->user_m->hasPermission('publish', $controller) === TRUE) {
        	return TRUE;
        }

        $this->session->set_flashdata('error', lang('error_permission'));
        return FALSE;
    }
}