<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class CORE_Model
 * @author	Sumengkar_
 */
class CORE_Model extends CI_Model
{
	protected $_table_name     = '';
	protected $_primary_key    = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by       = '';
	public $rules              = array();
	protected $_timestamps     = FALSE;

	function __construct()
	{
		parent::__construct();
	}

	// Get record
	public function get($id = NULL, $single = FALSE){
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row_array';
		}
		elseif($single == TRUE) {
			$method = 'row_array';
		}
		else {
			$method = 'result_array';
		}

		$this->db->order_by($this->_order_by);
		return $this->db->get($this->_table_name)->$method();
	}

	// Get active record
	public function get_active($id = NULL, $single = FALSE){
		if ($id != NULL) {

			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row_array';
		}
		elseif($single == TRUE) {
			$method = 'row_array';
		}
		else {
			$method = 'result_array';
		}

		$this->db->order_by($this->_order_by);
		$this->db->where('status', 1);

		return $this->db->get($this->_table_name)->$method();
	}

	// Get record by
	public function get_by($where, $single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single);
	}

	// Save record
	public function save($data, $id = NULL){
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data['date_added'] = $now;
			$data['date_modified'] = $now;
		}

		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}

		return $id;
	}

	// Delete record
	public function delete($id){
		// $filter = $this->_primary_filter;
		// $id = $filter($id);

		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}

    // Count table row
    public function count_totals($table_name = NULL, $where = NULL) {
    	if ($where) {
	    	foreach ($where as $key => $value) {
	    		$this->db->where($key, $value);
	    	}
    	}

    	return $this->db->count_all_results($table_name);
    }

    // DATATABLE
    public function datatable_query($config=array())
    {
    	$this->db->select($config['select_column']);
    	$this->db->from($config['table']);

 		// Where
        if (! empty($config['where'])) {
            $this->db->where($config['where']);
        }

 		// Search
 		if (!empty($_POST["search"]["value"])) {
 			$array_filtered = array_filter($config['order_column'], 'strlen');

 			if (count($array_filtered) <= 1) {
 				foreach ($array_filtered as $v) {
 					$this->db->like($v, $_POST["search"]["value"]);
 				}
 			} else {
 				$this->db->group_start();
 				foreach ($array_filtered as $key => $v) {
 					if ($key == 0) {
 						$this->db->like($v, $_POST["search"]["value"]);
 					}
 					$this->db->or_like($v, $_POST["search"]["value"]);
 				}
 				$this->db->group_end();
 			}
 		}

 		// Order
 		if (isset($_POST["order"])) {
 			$this->db->order_by($config['order_column'][$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}
 		else {
 			$this->db->order_by($config['table_key'], "DESC");
 		}
    }

    public function make_datatables($config=array())
    {
    	$this->datatable_query($config);
 		if ($_POST["length"] != -1) {
 			$this->db->limit($_POST["length"], $_POST["start"]);
 		}
 		$query = $this->db->get();
 		// printr($this->db->last_query()); die();
 		return $query->result();
    }

    public function get_filtered_data($config=array())
    {
    	$this->datatable_query($config);
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    public function get_all_data($config=array())
    {
    	$this->db->select("*");
    	$this->db->from($config['table']);

        if (! empty($config['where'])) {
            $this->db->where($config['where']);
        }

    	return $this->db->count_all_results();
    }
    // END DATATABLE

	// Update status
	public function update_status($id, $status)
	{
		$data['status'] = $status;

		$this->db->set($data);
		$this->db->where($this->_primary_key, $id);
		$this->db->update($this->_table_name);

		return TRUE;
	}
}