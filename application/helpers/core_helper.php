<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Print_r helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('printr')) {
    function printr($var, $echo = TRUE) {
        $output = '<pre style="position:absolute; z-index: 10001;">' . print_r($var, TRUE) . '</pre>';
        echo $output;
        return;
    }
}

/**
 * Get Gravatar helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('get_gravatar')) {
    function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() )
    {
        $CI =& get_instance();

        if ($CI->session->userdata['image']) {
            $txt = base_url($CI->session->userdata['image']);

            return $txt;
        } else {
            $url = '//www.gravatar.com/avatar/';
            $url .= md5( strtolower( trim( $email ) ) );
            $url .= "?s=$s&d=$d&r=$r";
            if ( $img ) {
                $url = '<img src="' . $url . '"';
                foreach ( $atts as $key => $val )
                    $url .= ' ' . $key . '="' . $val . '"';
                $url .= ' />';
            }
            return $url;
        }

        return false;
    }
}

/**
 * Slug helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('get_slug')) {
    function get_slug($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
}

/**
 * Konversi Tanggal
 * @author Sumengkar_
 * @version 1.0
 * example : short_date('D, j M Y', 2016-12-13) result : Wed, 13 Dec 2016
 */
if (!function_exists('long_date')) {
    function long_date($format, $date="now", $language_id=NULL) {
        $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        $lang = explode(',', lang('lang_date'));
        return str_replace($en,$lang,date($format,strtotime($date)));
    }
}

if (!function_exists('short_date')) {
    function short_date($format, $date="now", $language_id=NULL) {
        $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        $lang = explode(',', lang('lang_date_short'));
        return str_replace($en,$lang,date($format,strtotime($date)));
    }
}

/**
 * Paginating helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('paginating')) {
    function paginating($base_url, $total_rows, $limit, $uri_segment) {
        $CI =& get_instance();
        $CI->load->model( 'frontend/frontend_m' );
        $CI->load->library('pagination');

        $config['base_url']            = $base_url;
        $config['uri_segment']         = $uri_segment;
        // $config['use_page_numbers']    = TRUE;
        $config['total_rows']          = $total_rows;
        $config['per_page']            = $limit;

        // Atur bootstrap pagination
        $config['full_tag_open']       = '<div class="pagination list-unstyled">';
        $config['full_tag_close']      = '</div>';
        $config['num_tag_open']        = '<span class="page-numbers">';
        $config['num_tag_close']       = '</span>';
        $config['cur_tag_open']        = '<span class="page-numbers current">';
        $config['cur_tag_close']       = '</span>';
        $config['next_tag_open']       = '<span class="page-numbers">';
        $config['next_tagl_close']     = '</span>';
        $config['prev_tag_open']       = '<span class="page-numbers">';
        $config['prev_tagl_close']     = '</span>';
        $config['first_tag_open']      = '<span class="page-numbers">';
        $config['first_tagl_close']    = '</span>';
        $config['last_tag_open']       = '<span class="page-numbers">';
        $config['last_tagl_close']     = '</span>';

        $CI->pagination->initialize($config);

        return $CI->pagination->create_links();
    }
}

/**
 * Is_plugin_active helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('is_plugin_active')) {
    function is_plugin_active($plugin_name = NULL) {
        $CI =& get_instance();
        $CI->load->model( 'plugin/plugin_m' );

        $result = $CI->plugin_m->get_installed($plugin_name);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * Clean output helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('clean_output')) {
    function clean_output($str = NULL) {
        // return $str;
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Get language date format helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('get_language_date_format')) {
    function get_language_date_format($language_code = NULL, $format= 'lite') {
        $CI =& get_instance();
        $CI->load->model( 'localisation/language_m' );

        $language = $CI->language_m->get_by(array('language_code' => $language_code), TRUE);

        if ($language) {
            return get_slug($language['date_format_' . $format]);
        }
    }
}

/**
 * Alert helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('alert')) {
function alert($type = NULL, $message = NULL) {
        $str = '';
        switch ($type) {
            case 'success':
                $str  .= '<div class="alert alert-success alert-dismissable" role="alert">' . $message . '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>';
                break;

            case 'error':
                $str  .= '<div class="alert alert-warning alert-dismissable" role="alert">' . $message . '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>';
                break;

            default:
                $str  .= '<div class="alert alert-success alert-dismissable" role="alert">' . $message . '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>';
                break;
        }
        return $str;
    }
}

/**
 * Check_is_ajax helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('check_is_ajax')) {
function check_is_ajax($redirect = 'dashboard') {
        define('AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
        if(!AJAX_REQUEST)
        {
            redirect('admin/' . $redirect);
        }
        return false;
    }
}

/**
 * Membuat titlecase judul/string
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('make_titlecase')) {
    function make_titlecase($title = NULL) {
        $str = ucwords($title);     
        $exclude = 'ala,atau,bagi,buat,dan,dari,daripada,dengan,di,karena,ke,kepada,oleh,pada,per,pun,sampai,sebelum,setelah,tanpa,tapi,tentang,tetapi,untuk,yang';        
        $excluded = explode(",",$exclude);
        foreach($excluded as $noCap){$str = str_replace(ucwords($noCap),strtolower($noCap),$str);}      
        return ucfirst($str);
    }
}

if (!function_exists('check_group_permission')) {
    function check_group_permission($granted_group= array())//1|2|3
    {
        $CI =& get_instance();
        $CI->load->model('user/user_permission_m');
        $group_array = $CI->user_permission_m->get_user_group_slug();
        foreach ($granted_group as $key => $value) {
            if(in_array($value, $group_array)){
                return true;
            }
        }
        
        return false;
    }
}
