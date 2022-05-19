<?php
class User extends Backend_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/user_permission_m');
		$this->load->helper(array('Cookie', 'String'));
        $this->load->helper('directory');
        $this->load->helper('file');
	}

    public function index()
    {
		// Load view
        if ($this->session->userdata['user_privilege'] == (int) 1) {
            $this->data['subview'] = 'backend/user/index';
        } else {
            $this->session->set_flashdata('error', lang('error_permission'));
            $this->data['subview'] = 'backend/common/error';
        }

    	$this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id=NULL)
    {
        // Get user grups
        $this->data['user_groups'] = $this->user_permission_m->get();

        // Get languages from database
        $langs_data = $this->language_m->get_active();

        // Get languages from language dir
        $langs_dir = glob(APPPATH . 'language/*', GLOB_ONLYDIR);

        // Filter array $langs_data based on array $langs_dir
        foreach ($langs_dir as $key => $dir) {
            $filterBy = basename($dir);
            $results[] = array_filter($langs_data, function ($var) use ($filterBy) {
                return ($var['language_code'] == $filterBy);
            });
        }

        // Store results to languages property
        $this->data['languages'] = array();
        foreach ($results as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $v) {
                    $this->data['languages'][$key] = $v;
                }
            }
        }

        if ($id) {
            $where = array(
                'md5(user_id)' => $id
            );
            $result = $this->user_m->get_by($where, TRUE);
            if ($result) {
                $setting                             = $this->setting_m->get_setting($result['username']);
                $this->data['user']                  = $result;
                $this->data['user']['user_group_id'] = unserialize($result['user_group_id']);
                $this->data['user']['image_path']    = $result['image'] ? base_url($result['image']) : base_url('uploads/images/default/default-thumbnail-image.png');
                $this->data['user']['description']   = isset($setting['description']) ? $setting['description'] : NULL;
                $this->data['user']['social']        = isset($setting['social']) ? $setting['social'] : array();

            } else {
                $this->data['user'] = $this->user_m->get_new_user();
            }
        }
        else {
            $this->data['user'] = $this->user_m->get_new_user();
        }

        // Validate the form
        $rules = $this->user_m->rules_admin;

        if ($id) {
            $this->form_validation->set_rules("password", 'Password', 'trim|matches[password_confirm]');
            $this->form_validation->set_rules("password_confirm", 'Komfirmasi Password', 'trim|matches[password]');
        } else {
            $this->form_validation->set_rules("password", 'Password', 'trim|required|matches[password_confirm]');
            $this->form_validation->set_rules("password_confirm", 'Komfirmasi Password', 'trim|matches[password]');
        }
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE && $this->validate_user_permission($id)) {

            $data = array(
                'email'         => $this->input->post('email'),
                'firstname'     => $this->input->post('firstname'),
                'lastname'      => $this->input->post('lastname'),
                'ip_address'    => $_SERVER['REMOTE_ADDR'],
                'status'        => $this->input->post('status'),
                'image'         => $this->input->post('image'),
                'date_added'    => date('Y-m-d'),
                'language_code' => $this->input->post('language_code')
            );

            if ($this->input->post('user_group_id') != '') {
                $data['user_group_id'] = serialize($this->input->post('user_group_id'));
            }

            if (!$id) {
                $data['username'] = $this->input->post('username');
            }

            if ($this->input->post('password') != '') {
                $data['password'] = $this->user_m->hash($this->input->post('password'));
            }

            if ($this->input->post('usermeta')) {
                $setting[$this->input->post('username')] = $this->input->post('usermeta');
                $this->setting_m->save_setting($setting);
            }

            if ($this->user_m->save($data, $id)) {
                $this->session->set_flashdata('success', lang('success_update_data'));

                if ($id) {
                    redirect('user/edit/' . $id);
                } else {
                    redirect('user');
                }
            }
        }

		// Load the view
        if ($this->validate_user_permission($id)) {
            $this->data['subview'] = 'backend/user/edit';
        } else {
            $this->session->set_flashdata('error', lang('error_permission'));
            $this->data['subview'] = 'backend/common/error';
        }

		$this->load->view('backend/_layout_main', $this->data);
    }

    public function fetch_data()
    {
        // Only ajax
        check_is_ajax();

        $config = array(
			'table'         => 'core_users',
            'table_key'     => 'user_id',
			'select_column' => array('user_id', 'username', 'email', 'user_group_id'),
			'order_column'  => array(NULL, 'username', 'email', 'user_group_id')
        );

        $fetch_data = $this->user_m->make_datatables($config);
        $data = array();
        foreach ($fetch_data as $row) {
        	$sub_array = array();
        	$sub_array[] = datatable_checkbox($row->user_id);
        	$sub_array[] = $row->username;
        	$sub_array[] = $row->email;
        	$sub_array[] = $this->get_group_name($row->user_group_id);
        	$sub_array[] = datatable_button('user', md5($row->user_id));

        	$data[] = $sub_array;
        }

        $output = array(
			'draw'            => intval($_POST["draw"]),
			'recordsTotal'    => $this->user_m->get_all_data($config),
			'recordsFiltered' => $this->user_m->get_filtered_data($config),
			'data'            => $data
        );

        $this->output->set_output(json_encode($output));
    }

	public function login()
	{
		// Redirect a user if he's already logged in
		$cookie = get_cookie($this->config->item('sess_cookie_name'));

		// Check if have cokie and validate
		if ($cookie <> '') {
            $user = $this->user_m->get_by_cookie($cookie);
            if ($user) {
                $this->user_m->register_session($user);
            }
		}

		// Check if have session
		if (! $this->user_m->loggedin() == FALSE) {
			redirect('entry_data');
		}

		// Set form validation
		$login_rules = $this->user_m->login_rules;
		$this->form_validation->set_rules($login_rules);


		// Process form
		if ($this->form_validation->run() == TRUE) {
			// We can login and redirect
			if ($this->user_m->login() == TRUE) {
				redirect('entry_data', 'refresh');
			}
			else {
                $this->session->set_flashdata('error', lang('error_login'));
				redirect('user/login');
			}
		}

		// Load view
		$this->load->view('backend/user/login', $this->data);
	}

    public function register()
    {
        if ($this->user_m->login() == TRUE) {
            redirect('dashboard', 'refresh');
        }
         // Set form
         $register_rules = $this->user_m->register_rules;
         $this->form_validation->set_rules($register_rules);
 
         // Process form
         if ($this->form_validation->run() == true) {

            $user_group_id [] = 31;
            $data = array(
                'username' => $this->input->post('email'),
                'password' => $this->user_m->hash($this->input->post('password')),
                'user_privilege' => 0,
                'user_group_id' => serialize($user_group_id),
                
            );
            if ($this->user_m->save($data) == true) {
                $this->session->set_flashdata('success', 'pendaftaran berhasil Silahkan Login');
                    redirect('user/login');
            }

         }
        // Load view
        $this->load->view('backend/user/register', $this->data);
    }

    // LOGOUT - DESTROY SESSION
    public function logout()
    {
        $this->user_m->logout();
        redirect('user/login');
    }

    public function delete($id = NULL)
    {
        if ($this->session->userdata['user_privilege'] == (int) 1) {
            if ($id) {
                if ($id !== $this->session->userdata['user_id']) {
                    $this->user_m->delete($id);
                    $this->session->set_flashdata('success', lang('success_single_delete'));
                    redirect('user');
                } else {
                    $this->session->set_flashdata('error', lang('error_self_account_delete'));
                    redirect('user');
                }
            }
            else {
                if ($this->input->post('selected')) {
                    foreach ($this->input->post('selected') as $id) {
                        if ($id !== $this->session->userdata['user_id']) {
                            $this->user_m->delete($id);
                            $this->session->set_flashdata('success', lang('success_multiple_delete'));
                            redirect('user');
                        } else {
                            $this->session->set_flashdata('error', lang('error_self_account_delete'));
                            redirect('user');
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', lang('error_delete'));
                    redirect('user');
                }
            }
        } else {
            $this->session->set_flashdata('error', lang('error_permission'));
            redirect('user');
        }
    }

    public function get_group_name($user_group_id=NULL)
    {
        $result = [];
        foreach (unserialize($user_group_id) as $key => $user_group_id) {
            $where = array(
                'user_group_id' => $user_group_id
            );
            $results[] = $this->user_permission_m->get_by($where, TRUE)['name'];
        }

        return implode(', ', $results);
    }

    // Callback Unique Email Form
    public function _unique_email($str)
    {
        // Do NOT validate if email already exists
        // UNLESS it's the email for the current user
        $id = $this->uri->segment(3);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('md5(user_id) !=', $id);
        $user = $this->user_m->get();

        if (count($user)) {
            $this->form_validation->set_message('_unique_email', '%s sudah terdaftar!');
            return FALSE;
        }

        return TRUE;
    }

    // VALIDATE
    protected function validate_user_permission($user_id = NULL) {
		$user_session_data   = $this->session->userdata['user_id'] === $user_id;
		$user_privilege_data = $this->session->userdata['user_privilege'] == (int) 1;

        if ($user_session_data === TRUE OR $user_privilege_data === TRUE) {
            return TRUE;
        }

        return FALSE;
    }
}