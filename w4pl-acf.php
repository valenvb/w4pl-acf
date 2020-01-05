<?php
/**
 * Plugin Name: W4 Post List - Advanced Custom Fields
 * Plugin URI: https://github.com/valenvb/w4pl-acf
 * Description: Provides access to ACF data in W4 Post List
 * Author: Valen Varangu-Booth
 * Version: 1.0.1
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */


if( !function_exists("w4pl_acf_load_shortcode") ){
    function w4pl_acf_load_shortcode($codes){
        $acf_code = array(
            'acf' => array(
                'group' => 'Post',
                'callback' => 'w4pl_acf_data_callback',
                'desc' => '<strong>'. __('Output', 'w4pl') .'</strong>: ACF field data. Usage: accepts field name as first attribute or with field=name. <br /> Nested fields can be accessed using dot (.) notation. eg: field=group.subfield',
                'code' => '[acf field_name]'
            )
        );

        return array_merge($codes, $acf_code);
    }
}

if( !function_exists('w4pl_acf_data_callback') ){
    function w4pl_acf_data_callback($attr, $cont){
        if( !is_string($attr[0]) && !isset($attr['field']) ){
            error_log("w4pl_acf: no ACF field name given");
            return "";
        }
        if( is_string($attr[0]) ){
            $acf_key = $attr[0];
        } else {
            $acf_key = $attr['field'];
        }

        $acf_key = preg_split("/\./", $acf_key);
        
        $acf_data = get_fields();

        $result = array_reduce($acf_key, 'w4pl_acf_util_keyReduce', $acf_data);

        return $result;
    }
}

if( !function_exists('w4pl_acf_util_keyReduce') ){
    function w4pl_acf_util_keyReduce(array $arr, $idx){
        return array_key_exists($idx, $arr) ? $arr[$idx] : null;        
    }
}

//register shortcode with W4PL
add_filter('w4pl/get_shortcodes', 'w4pl_acf_load_shortcode');