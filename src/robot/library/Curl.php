<?php

namespace zqrobot\robot\library;

class Curl
{

    private $app_id;

    private $app_key;

    private $url;

    public function __construct($url, $app_id, $app_key)
    {
        $this->app_id = $app_id;
        $this->app_key = $app_key;
        $this->url = $url;
    }

    public function getResponse($param = [], $userAgent = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        empty($refer) && $refer = @$_SERVER['HTTP_REFERER'];
        $ua = $userAgent;
        empty($ua) && $ua = @$_SERVER['HTTP_USER_AGENT'];
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_REFERER, $refer);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $header = [
            'APP-ID: ' . $this->app_id,
            'APP-KEY: ' . $this->app_key,
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $res = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = mb_substr($res, 0, $header_size);
        $res = mb_substr($res, $header_size);
        curl_close($ch);
        unset($ch);
        $headers = explode("\r\n", $header);
        return $res;
    }

}