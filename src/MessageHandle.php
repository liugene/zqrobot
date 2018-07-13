<?php

namespace zqrobot;

use Hanson\Vbot\Message\Text;
use Hanson\Vbot\Extension\AbstractMessageHandler;
use Illuminate\Support\Collection;

class MessageHandle extends AbstractMessageHandler
{

    public $name = 'zq_robot';

    public $zhName = '钻群微信淘客机器人';

    public $author = 'zuanqun';

    public $version = '1.0.0';

    private $robot_name;

    private $type = [
        'text' => ['class' => \zqrobot\robot\action\Text::class, 'action' => 'doHandle'],
        'voice' => ['class' => '', 'action' => ''],
        'image' => ['class' => '', 'action' => ''],
        'video' => ['class' => '', 'action' => ''],
        'emoticon' => ['class' => '', 'action' => ''],
        'file' => ['class' => '', 'action' => ''],
        'recall' => ['class' => '', 'action' => ''],
        'location' => ['class' => '', 'action' => ''],
        'card' => ['class' => '', 'action' => ''],
        'red_packet' => ['class' => '', 'action' => ''],
        'request_friend' => ['class' => '', 'action' => ''],
        'share' => ['class' => '', 'action' => ''],
        'official' => ['class' => '', 'action' => ''],
        'touch' => ['class' => '', 'action' => ''],
        'transfer' => ['class' => '', 'action' => ''],
        'new_friend' => ['class' => '', 'action' => ''],
        'group_change' => ['class' => '', 'action' => ''],
        'mina' => ['class' => '', 'action' => ''],
    ];

    public function register()
    {
        // TODO: Implement register() method.
    }

    public function handler(Collection $collection)
    {
        if(isset($this->type[$message['type']])){

            $type = $this->type[$collection['type']];

            $res = (new $type['class'])->$type['action']($collection);

            $this->send($collection['from']['UserName'], $res);
        } else {
            $this->send($collection['from']['UserName'], '啊哟喂~' . $this->robot_name . '不知道你在说什么');
        }
    }

    public function setRobotName($name)
    {
        $this->robot_name = $name;
        return $this;
    }

    public function send($to, $message)
    {
        Text::send($to, $message);
    }

}