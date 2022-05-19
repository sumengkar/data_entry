<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('image_thumb')) {
    function image_thumb( $image_path, $size = 'medium') {
        // Get the CodeIgniter super object
        $CI =& get_instance();
        $CI->load->model( 'setting/setting_m' );
        $media_setting = $CI->setting_m->get_setting('media_setting');

        // Set size
        if ($size === 'larger')
        {
            $width  = isset($media_setting['image_lg_width']) ? $media_setting['image_lg_width'] :  '100px';
            $height = isset($media_setting['image_lg_height']) ? $media_setting['image_lg_height'] : '100px';
        }
        elseif ($size === 'medium')
        {
            $width  = isset($media_setting['image_md_width']) ?  $media_setting['image_md_width'] : '100px';
            $height = isset($media_setting['image_md_height']) ? $media_setting['image_md_height'] : '100px';
        }
        elseif ($size === 'small')
        {
            $width  = isset($media_setting['image_sm_width']) ? $media_setting['image_sm_width'] :  '100px';
            $height = isset($media_setting['image_sm_height']) ? $media_setting['image_sm_height'] : '100px';
        }
        else
        {
            $width  = isset($media_setting['image_lg_width']) ? $media_setting['image_lg_width'] :  '100px';
            $height = isset($media_setting['image_lg_height']) ? $media_setting['image_lg_height'] : '100px';
        }

        // Path to image thumbnail
        $cache_path  = 'uploads/images/cache/'; //dirname( $image_path ) . '/cache/';
        $image_thumb =  $cache_path . $width . 'x' . $height . '_' . basename($image_path);

        if (!is_dir($cache_path))
        {
            mkdir($cache_path, 0755, TRUE);
        }

        if ( !file_exists( $image_thumb ) ) {
            // LOAD LIBRARY
            $CI->load->library( 'image_lib' );

            // CONFIGURE IMAGE LIBRARY
            $config['image_library']    = 'gd2';
            $config['source_image']     = $image_path;
            $config['new_image']        = $image_thumb;
            $config['maintain_ratio']   = FALSE;
            $config['height']           = $height;
            $config['width']            = $width;
            $CI->image_lib->initialize( $config );
            $CI->image_lib->resize();
            $CI->image_lib->clear();
        }

        return base_url($image_thumb);
    }
}