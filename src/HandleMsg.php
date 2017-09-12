<?php
/**
 * Created by PhpStorm.
 * User: yu
 * Date: 2017/9/12
 * Time: 18:13
 */
namespace WeChat;

class HandleMsg
{
    public $fromeUser;//发送方帐号（一个OpenID）
    public $toUser;//开发者微信号
    public $createTime;//消息创建时间 （整型）
    public $msgType;//消息类型
    public $content;//文本消息内容
    public $msgId;//消息id，64位整型

    public function __construct()
    {
        //解析微信发来的XML数据包
        $postArr = file_get_contents('php://input');
        $postObj = simplexml_load_string($postArr);
        if (empty($postObj->MsgType)) {
            exit;
        }
        $this->fromeUser = $postObj->FromUserName;
        $this->toUser = $postObj->ToUserName;
        $this->createTime = $postObj->CreateTime;
        $this->msgType = $postObj->MsgType;
        $this->content = $postObj->Content;
        $this->msgId = $postObj->MsgId;
    }

    //回复文本消息
    public function sendText($content, $toUser = '')
    {
        if (empty($toUser)) {
            $toUser = $this->fromeUser;
        }
        $fromeUser = $toUser;
        $createTime = time();
        $template = '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    </xml>';
        echo sprintf($template, $toUser, $fromeUser, $createTime, $content);
    }
}