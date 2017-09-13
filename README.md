# WeChat
微信方法封装
github地址：https://github.com/linqiuyu/WeChat

项目目录：

WeChat

    src （主要代码目录）
        CheckSignature  （接入微信接口）
        HandleMsg  （处理微信推送消息）
        
        
使用方法：

1、接入微信接口

    使用CheckSignature()类验证消息是否来自微信,是返回true，不是返回false，第一次接入直接输出echostr参数内容
    实例：
    if (new CheckSignature('yourToken')) {
        //消息处理代码
        $handleMsg = new HandleMsg();
    }

2、微信消息处理

    1、HandleMsg类接受微信后可用参数：
        $handleMsg = new HandleMsg();
        $handleMsg->FromeUser;//发送方帐号（一个OpenID）
        $handleMsg->ToUser;//开发者微信号
        $handleMsg->CreateTime;//消息创建时间 （整型）
        $handleMsg->MsgType;//消息类型
        $handleMsg->Content;//文本消息内容
        $handleMsg->MsgId;//消息id，64位整型
        扫描带参数二维码事件时以下参数不为空
        $handleMsg->Event = '';//事件类型
        $handleMsg->EventKey = '';//事件KEY值，qrscene_为前缀，后面为二维码的参数值
        $handleMsg->Ticket = '';//二维码的ticket，可用来换取二维码图片
        上报地理位置事件时以下参数不为空
        $handleMsg->Latitude = '';//地理位置纬度
        $handleMsg->Longitude = '';//地理位置经度
        $handleMsg->Precision = '';//地理位置精度
     
    2、回复文本消息：
        $handleMsg->sendText($content(消息), $toUser = ''（需要发送的人，默认为发送方帐号）)
        
    3、回复图片消息
        $handleMsg->sendText($media_id(通过素材管理中的接口上传多媒体文件，得到的id), $toUser = ''（需要发送的人，默认为发送方帐号）)
    
    4、回复图片消息
            $handleMsg->sendVoice($media_id(通过素材管理中的接口上传多媒体文件，得到的id), $toUser = ''（需要发送的人，默认为发送方帐号）)
            
    5、回复视频消息
            $handleMsg->sendVideo($media_id(通过素材管理中的接口上传多媒体文件，得到的id), $title = ''(视频消息的标题,非必填), $description = ''（视频消息的描述，非必填）, $toUser = ''（需要发送的人，默认为发送方帐号）)
            
    6、回复视频消息
            $handleMsg->sendMusic($thumb_media_id(缩略图的媒体id，通过素材管理中的接口上传多媒体文件，得到的id), $title = ''(音乐标题，非必填), $description = ''（	音乐描述，非必填）, $music_url = ''（音乐链接，非必填）, $hq_music_url = ''（高质量音乐链接，WIFI环境优先使用该链接播放音乐，非必填）, $toUser = ''（需要发送的人，默认为发送方帐号）)
            
    7、回复图文消息
            $handleMsg->sendNews($article_count（int，图文消息个数，限制为8条以内）, $articles (array，示例$article=array(array('标题1', '描述1', '图片链接1', '点击图文消息跳转链接1'), array('标题2', '描述2', '图片链接2', '点击图文消息跳转链接2'))), $toUser = ''（需要发送的人，默认为发送方帐号））