<?php
class Backup extends Backend_controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('tool/backup_m');
    }

    public function index() {

        // Render view
        $this->data['subview'] = 'backend/tool/backup/index';
    	$this->load->view('backend/_layout_main', $this->data);
    }
}