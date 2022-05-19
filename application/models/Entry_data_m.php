<?php
class Entry_data_M extends CORE_Model
{
	protected $_table_name  = 'tb_pelamar';
	protected $_primary_key = 'md5(id_pelamar)';
	protected $_order_by    = 'id_pelamar';
	public $login_rules = array(
		'username' => array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'trim|required'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required'
		)
	);


    public function save_pendidikan($data, $id = NULL)
	{
		// Blog data
		if( isset($data['pelamar']) )
		{
			if( (int) $data['pelamar']['id_pelamar'] > 0)
			{
				$data_pelamar = array();

				$data_pelamar = $data['pelamar'];
				$this->db->set($data_pelamar);
				$this->db->where('id_pelamar', $id);
				$this->db->update($this->_table_name);
			}
			else
			{
				unset($data["pelamar"]['id_pelamar']);
				$data_pelamar = array();

				$data_pelamar = $data['pelamar'];
				$this->db->set($data_pelamar);
				$this->db->insert($this->_table_name);
				$data['data_pelamar']['id_pelamar'] = $this->db->insert_id();
			}
		}

		if( isset($data['pendidikan']) )
		{
			if (count($data['pendidikan'])) {
				// Delete all image by blog_id
				$this->db->where('id_pelamar', $data['data_pelamar']['id_pelamar']);
				$this->db->delete('tb_pendidikan');

				foreach ($data['pendidikan'] as $didik) {
					$didik['pendidikan_terakhir'] = $didik['pendidikan_terakhir'];
					$didik['id_pelamar']          = $data['data_pelamar']['id_pelamar'];
					$didik['nama_instansi']       = $didik['nama_instansi'];
					$didik['jurusan']             = $didik['jurusan'];
					$didik['th_lulus']            = $didik['th_lulus'];
					$didik['ipk']                 = $didik['ipk'];

					// Insert
					$this->db->set($didik);
					$this->db->insert('tb_pendidikan');
				}
			}
		}

		if( isset($data['pelatihan']) )
		{
			if (count($data['pelatihan'])) {
				// Delete all image by blog_id
				$this->db->where('id_pelamar', $data['data_pelamar']['id_pelamar']);
				$this->db->delete('tb_riwayat_pelatihan');

				foreach ($data['pelatihan'] as $latihan) {
					$latihan['nama_pelatihan'] = $latihan['nama_pelatihan'];
					$latihan['id_pelamar']     = $data['data_pelamar']['id_pelamar'];
					$latihan['sertifikat']     = $latihan['sertifikat'];
					$latihan['tahun']          = $latihan['tahun'];

					// Insert
					$this->db->set($latihan);
					$this->db->insert('tb_riwayat_pelatihan');
				}
			}
		}

		if( isset($data['pekerjaan']) )
		{
			if (count($data['pekerjaan'])) {
				// Delete all image by blog_id
				$this->db->where('id_pelamar', $data['data_pelamar']['id_pelamar']);
				$this->db->delete('tb_riwayat_pekerjaan');

				foreach ($data['pekerjaan'] as $kerja) {
					$kerja['nama_perusahaan'] = $kerja['nama_perusahaan'];
					$kerja['id_pelamar']      = $data['data_pelamar']['id_pelamar'];
					$kerja['posisi_terakhir'] = $kerja['posisi_terakhir'];
					$kerja['pendapatan']      = $kerja['pendapatan'];
					$kerja['tahun']           = $kerja['tahun'];

					// Insert
					$this->db->set($kerja);
					$this->db->insert('tb_riwayat_pekerjaan');
				}
			}
		}

	}

	public function get_data($id = NULL)
	{
		if ($id != NULL) {
			$this->db->select('*');
			$this->db->from('tb_pelamar');
			$this->db->where('id_user', $id);
			$results = $this->db->get()->row_array();

			return $results;
		}
		return false;
	}

	public function get_data_chil($id = NULL, $table = NULL)
	{
		if ($id != NULL || $table !=NULL) {
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('id_pelamar', $id);
			$results = $this->db->get()->result_array();

			return $results;
		}
		return false;
	}
}