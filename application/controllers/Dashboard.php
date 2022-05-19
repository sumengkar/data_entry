<?php
class Dashboard extends Backend_controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('dashboard/dashboard_m');
        $this->load->model('user/user_permission_m');
    }

    public function index() {
    	// if (in_array('loket-kgb', $this->user_permission_m->get_user_group_slug())) {
    	// 	echo('Hanya tampil pada user dengan hak akses user-kgb');
    	// }

    	// if (in_array('administrator', $this->user_permission_m->get_user_group_slug())) {
    	// 	echo('Hanya tampil pada user dengan hak akses administrator');
    	// }
        // Render view
        $this->data['subview'] = 'backend/dashboard/index';
    	$this->load->view('backend/_layout_main', $this->data);
    }
}