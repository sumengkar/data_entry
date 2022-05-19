<?php
class User_M extends CORE_Model
{
	protected $_table_name  = 'core_users';
	protected $_primary_key = 'md5(user_id)';
	protected $_order_by    = 'user_id';
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

	public $rules_admin = array(
		'username' => array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'trim|required'
		),
		'email' => array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|callback__unique_email'
		)
	);


	public $register_rules = array(
		'password' => array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|min_length[5]|max_length[75]'
		),
		'email' => array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|callback__unique_email'
		)
	);

	function __construct ()
	{
		parent::__construct();
	}

	// Get new user
	public function get_new_user()
	{
		$result = array(
			'user_id'          => '',
			'user_group_id'    => array(),
			'username'         => set_value('username'),
			'email'            => set_value('email'),
			'firstname'        => set_value('firstname'),
			'lastname'         => set_value('lastname'),
			'password'         => set_value('password'),
			'password_confirm' => set_value('password_confirm'),
			'status'           => set_value('status'),
			'image'            => set_value('image'),
			'image_path'       => base_url(THUMBNAIL_IMAGE),
			'date_added'       => set_value('date_added'),
			'loket_name'       => set_value('loket_name')
	    );

		$result['description'] = '';
		$result['social']      = array();

		return $result;
	}

	// Login
	public function login()
	{
		$user = $this->get_by(array(
			'username' => $this->input->post('username'),
			'password' => $this->hash($this->input->post('password'))
		), TRUE);

		if ($user) {
            if ($this->input->post('remember')) {
                $key = random_string('alnum', 64);
                set_cookie($this->config->item('sess_cookie_name'), $key, 3600*24*30); // set expired 30 hari kedepan

                // simpan key di database
                $update_key = array(
                    'cookie' => $key
                );
                $this->save($update_key, $user['user_id']);
			}

			$this->register_session($user);

			return TRUE;
		}

		return FALSE;
	}

	// Register session
	public function register_session($user)
	{
		if (count($user)) {
			$data_login = array(
				'user_id'        => md5($user['user_id']),
				'id_log' => $user['user_id'],
				'username'       => $user['username'],
				'firstname'      => $user['firstname'],
				'lastname'       => $user['lastname'],
				'email'          => $user['email'],
				'user_group_id'  => $user['user_group_id'],
				'user_privilege' => (int) $user['user_privilege'],
				'language_code'  => $user['language_code'],
				'image'          => $user['image'],
				'loggedin'       => TRUE
			);

			$this->session->set_userdata($data_login);
		}
	}

	public function logout()
	{
		delete_cookie($this->config->item('sess_cookie_name'));
		$this->session->sess_destroy();
	}

    // Get user by cookie
    public function get_by_cookie($cookie)
    {
		$where = array(
			'cookie' => $cookie
		);

        return $this->get_by($where, TRUE);
    }

	// Check if loggedin
	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin');
	}

	// Hashing password
	public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}

	// Manage user permission
	public function hasPermission($key = NULL, $controller = NULL)
	{
		$this->load->model('user/user_permission_m');
			$permissions = NULL;

		foreach (unserialize($this->session->userdata['user_group_id']) as $user_group_id) {
			$where = array(
				'user_group_id' => $user_group_id
			);
			$result = $this->user_permission_m->get_by($where, TRUE);
			if (is_array(unserialize($result['permission']))) {
				$permissions = unserialize($result['permission']);
			}

			if (is_array($permissions[$key])) {
				if (in_array($controller, $permissions[$key])) {
					return TRUE;
				}
			}
		}

		return FALSE;
	}


}