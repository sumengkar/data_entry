<?php
class Entry_data extends Backend_Controller {

    public function __construct(){
        parent :: __construct();
        $this->load->model('entry_data_m');

    }

    
    public function index() {

        $this->data['jenis_kelamin'] = array(
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
        );
        $this->data['agama'] = array(
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Budha' => 'Budha',
            'Hindu' => 'Hindu',
        );
        $this->data['gol_darah'] = array(
            'A' => 'A',
            'B' => 'B',
            'AB' => 'AB',
            'O' => 'O',
        );
        $this->data['status'] = array(
            'Kawin' => 'Kawin',
            'Belum Kawin' => 'Belum Kawin',
        );

        $this->data['bk'] = array(
            'YA' => 'YA',
            'TIDAK' => 'TIDAK',
        );

        $this->data['pendidikans'] = array();
        $this->data['pelatihan'] = array();
        $this->data['pekerjaan'] = array();

        // Render view
        if (check_group_permission(['user'])) {
            $this->data['subview'] = 'backend/entry_data/form';
        }else{
            $this->data['subview'] = 'backend/entry_data/index';
        }

        	// Process form
		if ($this->input->post() == TRUE) {
			// printr($this->input->post()); die;

            $data['pelamar'] = array(
             'posisi_dilamar'         => $this->input->post('posisi'),
             'id_user' => $this->session->userdata['id_log'],
             'nama' => $this->input->post('nama'),
             'no_ktp' => $this->input->post('no_ktp'),
             'ttl' => $this->input->post('ttl'),
             'jk' => $this->input->post('jk'),
             'agama' => $this->input->post('agama'),
             'gol_darah' => $this->input->post('gol_darah'),
             'status' => $this->input->post('status'),
             'alamat_ktp' => $this->input->post('alamat_ktp'),
             'alamat_tinggal' => $this->input->post('alamat_tinggal'),
             'email' => $this->input->post('email'),
             'no_tlp' => $this->input->post('no_tlp'),
             'no_darurat' => $this->input->post('ot'),
             'skill' => $this->input->post('skill'),
             'bersedia' => $this->input->post('bk'),
             'salary' => $this->input->post('gaji'),
            );

            
            $data['pendidikan'] = $this->input->post('item');
            $data['pelatihan'] = $this->input->post('pelatihan');
            $data['pekerjaan'] = $this->input->post('pekerjaan');

            // printr($data); die;
            $this->entry_data_m->save_pendidikan($data); 
            $this->session->set_flashdata('success', 'DATA BERHASIL DI SIMPAN');
            redirect('entry_data/note');
            

        }
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function note(){
        $this->data['subview'] = 'backend/entry_data/note';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function lihat_data(){
        $this->data['jenis_kelamin'] = array(
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
        );
        $this->data['agama'] = array(
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Budha' => 'Budha',
            'Hindu' => 'Hindu',
        );
        $this->data['gol_darah'] = array(
            'A' => 'A',
            'B' => 'B',
            'AB' => 'AB',
            'O' => 'O',
        );
        $this->data['status'] = array(
            'Kawin' => 'Kawin',
            'Belum Kawin' => 'Belum Kawin',
        );

        $this->data['bk'] = array(
            'YA' => 'YA',
            'TIDAK' => 'TIDAK',
        );
      $id = $this->session->userdata['id_log'];
      if($id){
        $result = $this->entry_data_m->get_data($id);
        if($result){
            $this->data['pelamar'] = $result;
            $this->data['pendidikan'] = $this->entry_data_m->get_data_chil($result['id_pelamar'], 'tb_pendidikan' );
            $this->data['pelatihan'] = $this->entry_data_m->get_data_chil($result['id_pelamar'], 'tb_riwayat_pelatihan' );
            $this->data['pekerjaan'] = $this->entry_data_m->get_data_chil($result['id_pelamar'], 'tb_riwayat_pekerjaan');
            // printr($this->data); die;
        }else{
            redirect('entry_data');
        }
        
      }else{
        redirect('entry_data');
        }
        $this->data['subview'] = 'backend/entry_data/lihat_data';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function fetch_data()
    {
        // Only ajax
        check_is_ajax();

        $config = array(
			'table'         => 'tb_pelamar',
            'table_key'     => 'id_pelamar',
			'select_column' => array('id_pelamar','nama', 'ttl', 'posisi_dilamar'),
			'order_column'  => array(NULL,'nama', 'ttl', 'posisi_dilamar')
        );

        $fetch_data = $this->user_m->make_datatables($config);
        $data = array();
        foreach ($fetch_data as $row) {
        	$sub_array = array();
        	$sub_array[] = datatable_checkbox($row->id_pelamar);
        	$sub_array[] = $row->nama;
        	$sub_array[] = $row->ttl;
        	$sub_array[] = $row->posisi_dilamar;

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
}
