# WeChat
微信方法封装

项目目录：
WeChat
    src （主要代码目录）
        CheckSignature  （接入微信接口）
        HandleMsg  （处理微信推送消息）
        
        
使用方法：
1、接入微信接口
    使用CheckSignature()类验证消息是否来自微信,是返回true，不是返回false，第一次接入直接输出echostr参数内容
    实例：
    if (CheckSignature()) {
        //消息处理代码
        $handleMsg = new HandleMsg();
    }

2、微信消息处理
    1、HandleMsg类接受微信后可用参数：
        $fromeUser;//发送方帐号（一个OpenID）
        $toUser;//开发者微信号
        $createTime;//消息创建时间 （整型）
        $msgType;//消息类型
        $content;//文本消息内容
        $msgId;//消息id，64位整型
    