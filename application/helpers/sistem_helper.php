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
if (!function_exists('delCookieMenu')) {
    function delCookieMenu($menu_id)
    {
        $menu_id = str_replace('.', '_', $menu_id);
        $CI = get_instance();
        delete_cookie($menu_id);
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
if (!function_exists('to_date')) {
    function to_date($date = null, $sp = null, $tp = null, $sp2 = null)
    {
        if ($date != '') {
            if ($tp == 'date') {
                $arr_date = explode(' ', $date);
                $date = $arr_date[0];
            } elseif ($tp == 'full_date') {
                $arr_date = explode(' ', $date);
                $date = $arr_date[0];
                $time = $arr_date[1];
            } elseif ($tp == 'time') {
                $arr_date = explode(' ', $date);
                $time = $arr_date[1];
            } elseif ($tp == 'hour_minute') {
                $arr_date = explode(' ', $date);
                $time = $arr_date[1];
                $arr_time = explode(':', $time);
                $hour = @$arr_time[0];
                $minute = @$arr_time[1];
            } elseif ($tp == 'only_day_month_name') {
                $arr_date = explode(' ', $date);
                $date = $arr_date[0];
            } elseif ($tp == 'only_year') {
                $arr_date = explode(' ', $date);
                $date = $arr_date[0];
            }
            $arr = explode('-', $date);
            if ($sp != '') {
                $result = $arr[2] . $sp . $arr[1] . $sp . $arr[0];
            } else {
                $result = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
            }
            if ($tp == 'full_date') {
                if ($sp2 != '') {
                    $result .= $sp2 . $time;
                } else {
                    $result .= ' ' . $time;
                }
            }
            if ($tp == 'time') {
                $result = $time;
            }
            if ($tp == 'hour_minute') {
                $result = $hour . ':' . $minute;
            }
            if ($tp == 'only_year') {
                $result = $arr[0];
            }
            if ($tp == 'only_day_month_name') {
                if ($sp != null) {
                    $result = $arr[2] . $sp . get_bulan($arr[1]);
                } else {
                    $result = $arr[2] . '-' . $arr[1];
                }
            }
        } else {
            $result = '';
        }
        return $result;
    }
}
if (!function_exists('num_id')) {
    function num_id($v, $s = null)
    {
        if ($v != '') {
            if (is_numeric($v)) {
                $res = number_format($v, 0, ",", ".");
                if ($s != null && $v == 0) return $s;
                else return $res;
            } else {
                return $s;
            }
        } else {
            return 0;
        }
    }
}
if (!function_exists('float_id')) {
    function float_id($v, $s = null, $limit = 2)
    {
        $raw = explode('.', $v);
        $fraction = "";
        $fraction = (count($raw) == 2) ? "," . str_pad($raw[1], 2, '0', STR_PAD_RIGHT) : ",00";
        $fraction = substr($fraction, 0, ($limit + 1));
        if ($v != '') {
            if (is_numeric($v)) {
                $res = number_format($raw[0], 0, ",", ".");
                if ($s != null && $raw[0] == 0)
                    return $s;
                else
                    return $res . $fraction;
            } else {
                return $s;
            }
        } else {
            return 0;
        }
    }
}
if (!function_exists('js_autonumeric')) {
    function js_autonumeric()
    {
        $html = '<script>
                 $(function() {
                  $(".autonumeric").autoNumeric({
                    aSep: ".",
                    aDec: ",",
                    vMax: "999999999999999",
                    vMin: "0",
                  });
                 });
                 </script>';
        return $html;
    }
}
