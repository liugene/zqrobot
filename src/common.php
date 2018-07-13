<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               应用公共函数文件
// +----------------------------------------------------------------------

if(!function_exists('sub_goods_id')){

    function sub_goods_id($url)
    {
        if(strpos($url, 'id=') === false){
            return false;
        }

        preg_match("/(^|\?|&)id=\d*(&|$)/i", $url, $match);

        if($match[0] == ''){
            return false;
        }

        if(strpos($match[0], '?id') === 0){
            return str_replace('?id=', '', $match[0]);

        }

        return str_replace('&id=', '', $match[0]);
    }

}

if(!function_exists('sub_active_id')){

    function sub_active_id($url)
    {

        if(strpos($url, 'activityId=') === false){
            return false;
        }

        preg_match("/(^|\?|&)activityId=\d*(&|$)/i", $url, $match);

        if($match[0] == ''){
            return false;
        }

        if(strpos($match[0], '?id') === 0){
            return str_replace('?id=', '', $match[0]);
        }

        return str_replace('&activityId=', '', $match[0]);
    }

}

if (!function_exists('substr_text')) {
    function substr_text($str, $start=0, $length, $charset="utf-8", $suffix="")
    {
        if(function_exists("mb_substr")){
            return mb_substr($str, $start, $length, $charset).$suffix;
        }
        elseif(function_exists('iconv_substr')){
            return iconv_substr($str,$start,$length,$charset).$suffix;
        }
        $re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
        return $slice.$suffix;
    }
}