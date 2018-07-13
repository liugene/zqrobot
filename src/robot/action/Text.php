<?php

namespace zqrobot\robot\action;

use zqrobot\robot\library\Curl;

class Text
{

    public function doHandle($message, $config)
    {

        if($message['fromType'] = 'Friend' && strpos($message['message'], '搜索')){
            $query = substr_text($message['message'], 2);

            $response = new Curl($config['url'], $config['app_id'], $config['app_key']);

            return $response->getResponse(['query' => $query]);

        }

        return '请加搜索';

    }

}