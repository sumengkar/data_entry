<?php
class User_permission extends Backend_controller
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
            $this->data['subview'] = 'backend/user_permission/index';
        } else {
            $this->session->set_flashdata('error', lang('error_permission'));
            $this->data['subview'] = 'backend/common/error';
        }

    	$this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
		// Fetch a user_group or set a new one
		if ($id) {
			$where = array(
				'md5(user_group_id)' => $id
			);
			$result = $this->user_permission_m->get_by($where, TRUE);

			if ($result) {
				$result['permission'] = is_array(unserialize($result['permission'])) ? unserialize($result['permission']) : array('access' => array(), 'modify' => array(), 'publish' => array());
				$this->data['user_group'] = $result;
			} else {
				$this->data['user_group'] = $this->user_permission_m->get_new_user_group();
			}
		}
		else {
			$this->data['user_group'] = $this->user_permission_m->get_new_user_group();
		}

		// BEGIN GET CONTROLLER FILE LIST
		// Set ignore
		$ignore = array(
			'Index',
			'index',
			'Dashboard',
			'user/User',
			'user/User_permission'
		);

		// Declarate var files
		$files = array();

		// Make path into an array
		$path = array(APPPATH . 'controllers/*');

		// While the path array is still populated keep looping through
		while (count($path) != 0) {
			$next = array_shift($path);

			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}

				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}

		// Sort the file array
		sort($files);

		foreach ($files as $file) {
			$controller = substr($file, strlen(APPPATH . 'controllers/'));

			$permission = substr($controller, 0, strrpos($controller, '.'));

			if (!in_array($permission, $ignore)) {
				$this->data['permissions'][] = $permission;
			}
		}

		// END GET CONTROLLER FILE LIST

		// Set up the rules
		$rules = $this->user_permission_m->rules;
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run() == TRUE && $this->session->userdata['user_privilege'] == (int) 1) {
			$permission = array(
				'access'  => $this->input->post('permission[access]') ? $this->input->post('permission[access]') : array(),
				'modify'  => $this->input->post('permission[modify]') ? $this->input->post('permission[modify]') : array(),
				'publish' => $this->input->post('permission[publish]') ? $this->input->post('permission[publish]') : array()
			);

			$data = array(
				'user_group_id' => $this->input->post('user_group_id'),
				'name'          => $this->input->post('name'),
				'slug'          => get_slug($this->input->post('name')),
				'status'        => $this->input->post('status'),
				'permission'    => serialize($permission)
			);

			$this->user_permission_m->save($data, $id);
			redirect('user_permission');
		}

		// Load the view
        if ($this->session->userdata['user_privilege'] == (int) 1) {
           	$this->data['subview'] = 'backend/user_permission/edit';
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
			'table'         => 'core_user_group',
			'table_key'     => 'user_group_id',
			'select_column' => array('user_group_id', 'name', 'status'),
			'order_column'  => array(NULL, 'name', 'status', NULL)
        );

        $fetch_data = $this->user_permission_m->make_datatables($config);
        $data = array();
        foreach ($fetch_data as $row) {
        	$sub_array = array();
        	$sub_array[] = datatable_checkbox(md5($row->user_group_id));
        	$sub_array[] = $row->name;
        	$sub_array[] = datatable_status(md5($row->user_group_id), $row->status);
        	$sub_array[] = datatable_button('user_permission', md5($row->user_group_id));

        	$data[] = $sub_array;
        }

        $output = array(
			'draw'            => intval($_POST["draw"]),
			'recordsTotal'    => $this->user_permission_m->get_all_data($config),
			'recordsFiltered' => $this->user_permission_m->get_filtered_data($config),
			'data'            => $data
        );

        // $this->output->enable_profiler(TRUE);
        $this->output->set_output(json_encode($output));
    }

    public function status($id, $status)
    {
        // Only ajax
        check_is_ajax();

        if ($this->user_m->hasPermission('publish', 'User_permission')) {
            if ($status == 'true') {
                if ($this->user_permission_m->update_status($id, 1)) {
                    $json['success'] = lang('status_update_success');
                    $this->output->set_output(json_encode($json));
                }
            } elseif ($status == 'false') {
                if ($this->user_permission_m->update_status($id, 0)) {
                    $json['success'] = lang('status_update_success');
                    $this->output->set_output(json_encode($json));
                }
            }
        } else {
            $json['error'] = lang('error_permission');
            $this->output->set_output(json_encode($json));
        }
    }

    public function delete($id = NULL)
    {
		if ($this->session->userdata['user_privilege'] == (int) 1) {
			if ($id) {
				$this->user_permission_m->delete($id);
		    	$this->session->set_flashdata('success', lang('success_single_delete'));
				redirect('user_permission');
			}
			else {
				if ($this->input->post('selected')) {
					foreach ($this->input->post('selected') as $id) {
						$this->user_permission_m->delete($id);
					}
			    	$this->session->set_flashdata('success', lang('success_multiple_delete'));
					redirect('user_permission');
				} else {
			    	$this->session->set_flashdata('error', lang('error_delete'));
			    	redirect('user_permission');
				}
			}
		} else {
	    	$this->session->set_flashdata('error', lang('error_permission'));
	    	redirect('user_permission');
		}
    }
}