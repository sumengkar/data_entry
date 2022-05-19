<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Glob_recursive helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('glob_recursive')) {
    function glob_recursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);
        $exclude = array(
            'uploads/images/cache',
            'uploads/images/default'
        );
        foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
            if (!in_array($dir, $exclude)) {
                $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
            }
        }
        return $files;
    }
}

/**
 * Search array helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('search_array')) {
    function search_array($names, $array, $key) {
        $store_all_name = array();
        foreach ($array as $name) {
            array_push($store_all_name, $name[$key]);
        }

        $results = preg_grep('/'. $names .'/i', $store_all_name);

        $files = array();
        foreach ($results as $key => $value) {
            $files[] = $array[$key];
        }

        return $files;
    }
}

/**
 * Sort array helper
 * @author Sumengkar_
 * @version 1.0
 */
if (!function_exists('sort_array')) {
    function sort_array($array, $col, $order = 'asc') {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $col) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case 'asc':
                    asort($sortable_array);
                    break;
                case 'desc':
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}