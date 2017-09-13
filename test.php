<?php
/**
 * Created by PhpStorm.
 * User: yu
 * Date: 2017/9/12
 * Time: 20:28
 */
$timestamp = 1;
$nonce = 1;
$signature = 1;
$echostr = 1;
$token = 'linqiuyu';
//将token、timestamp、nonce三个参数进行字典序排序
$arr = array($timestamp, $nonce, $token);
sort($arr);
//将三个参数字符串拼接成一个字符串进行sha1加密
$temstr = implode('', $arr);
$temstr = sha1($temstr);
echo $temstr;