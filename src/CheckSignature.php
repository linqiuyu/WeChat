<?php
/**
 * Created by PhpStorm.
 * User: yu
 * Date: 2017/9/12
 * Time: 17:28
 * 微信接入
 */
namespace WeChat;

class CheckSignature
{
    public function __construct($token)
    {
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $signature = $_GET['signature'];
        if (!empty($_GET['echostr'])) {
            $echostr = $_GET['echostr'];
        } else {
            $echostr = false;
        }
        //将token、timestamp、nonce三个参数进行字典序排序
        $arr = array($timestamp, $nonce, $token);
        sort($arr);
        //将三个参数字符串拼接成一个字符串进行sha1加密
        $temstr = implode('', $arr);
        $temstr = sha1($temstr);
        if ($temstr == $signature) {
            if ($echostr) {
                echo $echostr;
                return false;
            }
            else {
                return true;
            }
        }
        else {
            return false;
        }
    }
}