<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Autoload libraries
spl_autoload_register(function($classname){
	if (strpos($classname, 'CI_') !== 0) {
		$file = APPPATH . 'libraries/' . $classname . '.php';
		if (file_exists($file) && is_file($file)) {
			@include_once($file);
		}
	}
});

// CI Default Config
$config['base_url']                = BASE_URL;
$config['index_page']              = '';
$config['uri_protocol']            = 'REQUEST_URI';
$config['url_suffix']              = '.html';
$config['language']                = 'id';
$config['charset']                 = 'UTF-8';
$config['enable_hooks']            = FALSE;
$config['subclass_prefix']         = 'CORE_';
$config['composer_autoload']       = 'vendor/autoload.php';
$config['permitted_uri_chars']     = 'a-z 0-9~%.:_\-';
$config['enable_query_strings']    = FALSE;
$config['controller_trigger']      = 'c';
$config['function_trigger']        = 'm';
$config['directory_trigger']       = 'd';
$config['allow_get_array']         = TRUE;
$config['log_threshold']           = 0;
$config['log_path']                = '';
$config['log_file_extension']      = '';
$config['log_file_permissions']    = 0644;
$config['log_date_format']         = 'Y-m-d H:i:s';
$config['error_views_path']        = '';
$config['cache_path']              = '';
$config['cache_query_string']      = FALSE;
$config['encryption_key']          = 'VbMGacUK5W390PukengX7oFfHvs4hTrE';
$config['sess_driver']             = 'database';
$config['sess_cookie_name']        = 'core_sessions';
$config['sess_expiration']         = 7200;
$config['sess_save_path']          = 'core_sessions';
$config['sess_match_ip']           = FALSE;
$config['sess_time_to_update']     = 300;
$config['sess_regenerate_destroy'] = FALSE;
$config['cookie_prefix']           = '';
$config['cookie_domain']           = '';
$config['cookie_path']             = '/';
$config['cookie_secure']           = FALSE;
$config['cookie_httponly']         = FALSE;
$config['standardize_newlines']    = FALSE;
$config['global_xss_filtering']    = FALSE;
$config['csrf_protection']         = FALSE;
$config['csrf_token_name']         = 'csrf_test_name';
$config['csrf_cookie_name']        = 'csrf_cookie_name';
$config['csrf_expire']             = 7200;
$config['csrf_regenerate']         = TRUE;
$config['csrf_exclude_uris']       = array();
$config['compress_output']         = FALSE;
$config['time_reference']          = 'local';
$config['rewrite_short_tags']      = FALSE;
$config['proxy_ips']               = '';

// Apps Config
$config['toggle_en_dis']            = ['1' => 'Enable', '0' => 'Disable'];

$config['list_bulan']       = ['1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'];
$config['list_bulan_short'] = ['1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'Mei', '6' => 'Jun', '7' => 'Jul', '8' => 'Agu', '9' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des'];
$config['list_hari']        = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$config['list_hari_short']  = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

// JWT Config
$config['jwt_key'] = 'VbMGacUK5W390PukengX7oFfHvs4hTrE';
// $config['token_timeout'] = 1; // Generated token will expire in 1 minute for sample code

$config['force_https']               = FALSE;
$config['rest_default_format']       = 'json';
$config['rest_supported_formats']    = ['json', 'array', 'csv', 'html', 'jsonp', 'php', 'serialized', 'xml', ]; $config['rest_status_field_name'] = 'status';
$config['rest_message_field_name']   = 'error';
$config['enable_emulate_request']    = TRUE;
$config['rest_realm']                = 'REST API';
$config['rest_auth']                 = FALSE;
$config['auth_source']               = 'ldap';
$config['allow_auth_and_keys']       = TRUE;
$config['auth_library_class']        = '';
$config['auth_library_function']     = '';
$config['rest_valid_logins']         = ['admin' => '1234'];
$config['rest_ip_whitelist_enabled'] = FALSE;
$config['rest_ip_whitelist']         = '';
$config['rest_ip_blacklist_enabled'] = FALSE;
$config['rest_ip_blacklist']         = '';
$config['rest_database_group']       = 'default';
$config['rest_keys_table']           = 'keys';
$config['rest_enable_keys']          = FALSE;
$config['rest_key_column']           = 'key';
$config['rest_limits_method']        = 'ROUTED_URL';
$config['rest_key_length']           = 40;
$config['rest_key_name']             = 'X-API-KEY';
$config['rest_enable_logging']       = FALSE;
$config['rest_logs_table']           = 'logs';
$config['rest_enable_access']        = FALSE;
$config['rest_access_table']         = 'access';
$config['rest_logs_json_params']     = FALSE;
$config['rest_enable_limits']        = FALSE;
$config['rest_limits_table']         = 'limits';
$config['rest_ignore_http_accept']   = FALSE;
$config['rest_ajax_only']            = FALSE;
$config['rest_language']             = 'english';
$config['check_cors']                = FALSE;
$config['allowed_cors_headers']      = ['Origin', 'X-Requested-With', 'Content-Type', 'Accept', 'Access-Control-Request-Method'];
$config['allowed_cors_methods']      = ['GET', 'POST', 'OPTIONS', 'PUT', 'PATCH', 'DELETE'];
$config['allow_any_cors_domain']     = FALSE;
$config['allowed_cors_origins']      = [];
