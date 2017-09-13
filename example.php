<?php
/**
 * Created by PhpStorm.
 * User: yu
 * Date: 2017/9/12
 * Time: 20:18
 * 示例文件
 */
require_once __DIR__ . '/vendor/autoload.php';

use WeChat\CheckSignature;
use WeChat\HandleMsg;

if (new CheckSignature('linqiuyu')) {
    $handleMsg = new HandleMsg();
    //事件处理
    if ($handleMsg->MsgType == 'event') {
        switch ($handleMsg->Event) {
            //关注事件
            case 'subscribe':
                $handleMsg->sendText('欢迎关注xxx的微信公众号');
                break;
        }
    }
}