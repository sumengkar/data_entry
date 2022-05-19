<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Audio Plugin
* @author	Sumengkar_
*/
class Audio_plugin {
    public $_plugin_name        = 'Audio Plugin';
    public $_plugin_desc        = 'Plugin to add audio widget';
    public $_plugin_dir         = 'audio_plugin';
    public $_widget_name        = 'Audio Plugin';
    public $_plugin_widget_name = 'audio_plugin_widget';

	public function index()
	{
		$CI =& get_instance();

        // Widget init
        $this->widget_init();

        // Get data
        $this->get_data();

        // Process the form
        $data[$this->_plugin_dir] = array();
        if ($CI->input->method(TRUE) == 'POST' && $CI->validate_modify('Plugin')) {
            if ($CI->input->post('audio')) {
                $data[$this->_plugin_dir] = $CI->input->post('audio');
                $CI->setting_m->save_setting($data);
                redirect($CI->data['redirect']);
            } else {
                $CI->setting_m->save_setting($data);
                redirect($CI->data['redirect']);
            }
        }
	}

    public function widget($widget_item_id = NULL, $language_code = NULL)
    {
        $CI =& get_instance();

        // Get data
        $this->get_data();

        // Add data form widget
        $widget_data = $CI->widget_m->get_widget_item(array('widget_item_id' => $widget_item_id));
        $CI->data['audio'] = array();
        foreach ($widget_data as $widget) {
            if (array_key_exists($widget['value']['widget_data'], $CI->data['audios'])) {
                if (isset($CI->data['audios'][$widget['value']['widget_data']])) {
                    $CI->data['audio'] = $CI->data['audios'][$widget['value']['widget_data']];
                }

                if (isset($widget['value']['widget_title'][$language_code])) {
                    $CI->data['audio']['widget_title'] = $widget['value']['widget_title'][$language_code];
                }
            }
        }

        if ($CI->data['audio']) {
            $CI->load->ext_view('plugins/audio_plugin/audio_plugin_widget', $CI->data['audio']);
        }
    }

    public function get_data()
    {
        $CI =& get_instance();

        // Get data
        $audio_data = $CI->setting_m->get_setting($this->_plugin_dir);
        if ($audio_data) {
            $CI->data['audios'] = $audio_data;
        } else {
            $CI->data['audios'][] = array(
				'audio_name'  => '',
				'audio_desc'  => '',
				'audio_image' => '',
				'audio_path'  => ''
            );
        }
    }

    public function widget_init()
    {
        $CI =& get_instance();

        // Check widget
        if (! count($CI->setting_m->get_setting($this->_plugin_widget_name)) && is_plugin_active($this->_plugin_dir)) {
            $add_widget = array(
                $this->_plugin_widget_name => array(
                    'widget_name' => $this->_widget_name,
                    'widget_data' => $this->_plugin_dir
                )
            );
            $CI->setting_m->save_setting($add_widget);
        }
    }
}