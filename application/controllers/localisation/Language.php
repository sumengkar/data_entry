<?php
class Language extends Backend_controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('file');
    }

    public function index() {
        if ($this->validate_access('localisation/Language')) {
            $this->data['subview'] = 'backend/localisation/language/index';
        } else {
            $this->session->set_flashdata('error', lang('error_permission'));
            $this->data['subview'] = 'backend/common/error';
        }
    	$this->load->view('backend/_layout_main', $this->data);
    }

    public function fetch_data()
    {
        // Ajax only
        check_is_ajax();

        $config = array(
            'table'         => 'core_language',
            'table_key'     => 'language_id',
            'select_column' => array('language_id', 'name', 'language_code', 'image', 'sort_order', 'status'),
            'order_column'  => array(NULL, 'name', 'language_code', 'image', 'sort_order', 'status')
        );

        $fetch_data = $this->language_m->make_datatables($config);
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = datatable_checkbox($row->language_id);
            $sub_array[] = $row->name;
            $sub_array[] = $row->language_code;
            $sub_array[] = '<img src="'. ADMIN_ASSETS_URL .'images/flags/'. $row->image .'" alt="">';
            $sub_array[] = $row->sort_order;
            $sub_array[] = datatable_status(md5($row->language_id), $row->status);
            $sub_array[] = datatable_button('localisation/language', md5($row->language_id));

            $data[] = $sub_array;
        }

        $output = array(
            'draw'            => intval($_POST["draw"]),
            'recordsTotal'    => $this->language_m->get_all_data($config),
            'recordsFiltered' => $this->language_m->get_filtered_data($config),
            'data'            => $data
        );

        $this->output->set_output(json_encode($output));
    }

    public function edit($id = NULL)
    {
        // Get language image
        $flags_result = glob_recursive(VIEWPATH . 'backend/assets/images/flags/' . '*', GLOB_BRACE);
        $this->data['flags'] = array();
        foreach ($flags_result as $image) {
            if (is_file($image)) {
                $result = get_file_info($image);

                if ($result) {
                    $this->data['flags'][] = $result['name'];
                }
            }
        }

        // Fetch a language or set a new one
        $where = array(
            'md5(language_id)' => $id
        );
        $result = $this->language_m->get_by($where, TRUE);

        if ($result) {
            $this->data['languages'] = $result;
        }
        else {
            $this->data['languages'] = $this->language_m->get_new_language();
        }

        // Validate the form
        $rules = $this->language_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE && $this->validate_modify('localisation/Language')) {
            $data = $this->input->post();
            if ($this->language_m->save($data, $id)) {
                $this->session->set_flashdata('success', lang('success_update_data'));
                redirect('localisation/language');
            }
        }

        // Load the view
        if ($this->validate_access('localisation/Language')) {
            $this->data['subview'] = 'backend/localisation/language/edit';
        } else {
            $this->session->set_flashdata('error', lang('error_permission'));
            $this->data['subview'] = 'backend/common/error';
        }

        $this->load->view('backend/_layout_main', $this->data);
    }

    public function _unique_code($str)
    {
        // Do NOT validate if language code already exists
        // UNLESS it's the code for the current user
        $id = $this->uri->segment(5);
        $this->db->where('language_code', $this->input->post('language_code'));
        !$id || $this->db->where('md5(language_id) !=', $id);
        $language = $this->language_m->get();

        if (count($language)) {
            $this->form_validation->set_message('_unique_code', '%s sudah terdaftar!');
            return FALSE;
        }

        return TRUE;
    }

    public function status($id, $status)
    {
        if ($this->validate_modify('localisation/Language')) {
            if ($this->setting_m->get_setting('language_id') != $id) {
                if ($status == 'true') {
                    if ($this->language_m->update_status($id, 1)) {
                        $json['success'] = lang('status_update_success');
                        $this->output->set_output(json_encode($json));
                    }

                } elseif ($status == 'false') {
                    if ($this->language_m->update_status($id, 0)) {
                        $json['success'] = lang('status_update_success');
                        $this->output->set_output(json_encode($json));
                    }
                }
            } else {
                $this->output->set_output('error');
            }
        } else {
            $json['error'] = lang('error_permission');
            $this->output->set_output(json_encode($json));
        }
    }

    public function delete($id = NULL)
    {
        if ($this->validate_modify('localisation/Language')) {
            if ($id) {
                $this->language_m->delete($id);
                $this->session->set_flashdata('success', lang('success_single_delete'));
                redirect('localisation/language');
            }
            else {
                if ($this->input->post('selected')) {
                    foreach ($this->input->post('selected') as $id) {
                        $this->language_m->delete($id);
                    }

                    $this->session->set_flashdata('success', lang('success_multiple_delete'));
                    redirect('localisation/language');
                } else {
                    $this->session->set_flashdata('error', lang('error_delete'));
                    redirect('localisation/language');
                }
            }
        }
    }

}