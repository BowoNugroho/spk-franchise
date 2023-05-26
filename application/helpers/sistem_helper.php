<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('getCookieMenu')) {
    function getCookieMenu($menu_id)
    {
        $menu_id = str_replace('.', '_', $menu_id);
        $CI = get_instance();
        if (is_null(get_cookie($menu_id))) {
            $val = array(
                'search' => null,
                'per_page' => null,
                'cur_page' => null,
                'total_rows' => null,
                'order' => null
            );
            $cookie = array(
                'name'   => $menu_id,
                'value'  => json_encode($val),
                // 'expire' => '120'
                'expire' => '600'
            );
            $CI->input->set_cookie($cookie);
            return $val;
        } else {
            return json_decode(get_cookie($menu_id), TRUE);
        }
    }
}

if (!function_exists('setCookieMenu')) {
    function setCookieMenu($menu_id, $cookie_val)
    {
        $menu_id = str_replace('.', '_', $menu_id);
        $CI = get_instance();
        $cookie = array(
            'name'   => $menu_id,
            'value'  => json_encode($cookie_val),
            // 'expire' => '120'
            'expire' => '600'
        );
        $CI->input->set_cookie($cookie);
    }
}

if (!function_exists('point_to_under')) {
    function point_to_under($id = null)
    {
        $result = str_replace('.', '_', $id);
        return $result;
    }
}
if (!function_exists('point')) {
    function point($id = null)
    {
        $result = str_replace('.', '', $id);
        return $result;
    }
}

if (!function_exists('under_to_point')) {
    function under_to_point($id = null)
    {
        $result = str_replace('_', '.', $id);
        return $result;
    }
}
