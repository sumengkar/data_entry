<?php
class User_permission_m extends CORE_Model
{
	protected $_table_name  = 'core_user_group';
	protected $_primary_key = 'md5(user_group_id)';
	protected $_order_by    = 'user_group_id';
	public $rules = array(
		'name' => array(
			'field' => 'name',
			'label' => 'name',
			'rules' => 'trim|required'
		)
	);

	function __construct ()
	{
		parent::__construct();
	}

	public function get_new_user_group()
	{
		$result = array(
			'user_group_id' => '',
			'name'          => set_value('name'),
			'status'        => set_value('status')
	    );

		$result['permission']['access']  = array();
		$result['permission']['modify']  = array();
		$result['permission']['publish'] = array();

		return $result;
	}

	public function get_user_group_slug()
	{
		foreach (unserialize($this->session->userdata['user_group_id']) as $key => $value) {
			$result[$key] = $this->get_by(array('user_group_id' => $value), TRUE)['slug'];
		}

		return $result;
	}
}