<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Form datatable_checkbox helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('datatable_checkbox')) {
function datatable_checkbox($id = NULL) {
        $str    = '<div class="checkbox checkbox-styled">';
        $str   .=     '<label>';
        $str   .=         '<input type="checkbox" name="selected[]" value="' . $id . '" class="iCheck">';
        $str   .=         '<span></span>';
        $str   .=     '</label>';
        $str   .= '</div>';

        return $str;
    }
}

/**
 * Form datatable button helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('datatable_button')) {
function datatable_button($url = NULL, $id = NULL) {
        $str  = '<a href="'. base_url($url . '/' . 'edit' . '/' . $id) .'" class="btn btn-icon-toggle btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon ion-compose"></i></a>';
        $str .= '<a href="'. base_url($url . '/' . 'delete' . '/' . $id) .'" class="btn btn-icon-toggle btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><i class="icon ion-trash-a"></i></a>';

        return $str;
    }
}

/**
 * Form datatable status helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('datatable_status')) {
function datatable_status($id = NULL, $get_status = NULL) {
        if ($get_status === '1') { $active = 'checked'; } else { $active = ''; };

        $str =  '<div class="checkbox">';
        $str .=     '<label>';
        $str .=         '<input type="checkbox" name="status" class="switch-onoff" value="'. $get_status .'" data="'. $id .'" '. $active .'>' ;
        $str .=     '</label>';
        $str .= '</div>';

        return $str;
    }
}

/**
 * Form datatable image helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('datatable_image')) {
function datatable_image($path = 'base_url(THUMBNAIL_FILE)', $class = 'tbl-image-square') {
        $str  = '<img src="'. $path .'" class="'. $class .'">';
        return $str;
    }
}