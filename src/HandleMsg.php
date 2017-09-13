<?php
/**
 * Created by PhpStorm.
 * User: yu
 * Date: 2017/9/12
 * Time: 18:13
 * 消息处理方法
 */
namespace WeChat;

class HandleMsg
{
    public $FromeUser;//发送方帐号（一个OpenID）
    public $ToUser;//开发者微信号
    public $CreateTime;//消息创建时间 （整型）
    public $MsgType;//消息类型
    public $Content;//文本消息内容
    public $MsgId;//消息id，64位整型
    public $Event = '';//事件类型
    public $EventKey = '';//事件KEY值，qrscene_为前缀，后面为二维码的参数值
    public $Ticket = '';//二维码的ticket，可用来换取二维码图片
    public $Latitude = '';//地理位置纬度
    public $Longitude = '';//地理位置经度
    public $Precision = '';//地理位置精度

    public function __construct()
    {
        //解析微信发来的XML数据包
        $postArr = file_get_contents('php://input');
        $postObj = simplexml_load_string($postArr);
        if (empty($postObj->MsgType)) {
            exit;
        }
        $this->FromeUser = $postObj->FromUserName;
        $this->ToUser = $postObj->ToUserName;
        $this->CreateTime = $postObj->CreateTime;
        $this->MsgType = $postObj->MsgType;
        $this->Content = $postObj->Content;
        $this->MsgId = $postObj->MsgId;
        if (!empty($postObj->Event)) {
            $this->Event = $postObj->Event;
        }
        if (!empty($postObj->EventKey)) {
            $this->EventKey = $postObj->EventKey;
        }
        if (!empty($postObj->Ticket)) {
            $this->Ticket = $postObj->Ticket;
        }
        if (!empty($postObj->Latitude)) {
            $this->Latitude = $postObj->Latitude;
        }
        if (!empty($postObj->Longitude)) {
            $this->Longitude = $postObj->Longitude;
        }
        if (!empty($postObj->Precision)) {
            $this->Precision = $postObj->Precision;
        }
    }

    //回复文本消息
    public function sendText($content, $toUser = '')
    {
        if (empty($toUser)) {
            $toUser = $this->FromeUser;
        }
        $fromeUser = $this->ToUser;
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

    //回复图片消息
    public function sendImage($media_id, $toUser = '')
    {
        if (empty($toUser)) {
            $toUser = $this->FromeUser;
        }
        $fromeUser = $this->ToUser;
        $createTime = time();
        $template = '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[image]]></MsgType>
                    <Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Image>
                    </xml>';
        echo sprintf($template, $toUser, $fromeUser, $createTime, $media_id);
    }

    //回复语音消息
    public function sendVoice($media_id, $toUser = '')
    {
        if (empty($toUser)) {
            $toUser = $this->FromeUser;
        }
        $fromeUser = $this->ToUser;
        $createTime = time();
        $template = '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[voice]]></MsgType>
                    <Voice>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Voice>
                    </xml>';
        echo sprintf($template, $toUser, $fromeUser, $createTime, $media_id);
    }

    //回复视频消息
    public function sendVideo($media_id, $title = '', $description = '', $toUser = '')
    {
        if (empty($toUser)) {
            $toUser = $this->FromeUser;
        }
        $fromeUser = $this->ToUser;
        $createTime = time();
        $template = '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[video]]></MsgType>
                    <Video>
                    <MediaId><![CDATA[%s]]></MediaId>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    </Video> 
                    </xml>';
        echo sprintf($template, $toUser, $fromeUser, $createTime, $media_id, $title, $description);
    }

    //回复音乐消息
    public function sendMusic($thumb_media_id, $title = '', $description = '', $music_url = '', $hq_music_url = '', $toUser = '')
    {
        if (empty($toUser)) {
            $toUser = $this->FromeUser;
        }
        $fromeUser = $this->ToUser;
        $createTime = time();
        $template = '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[music]]></MsgType>
                    <Music>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <MusicUrl><![CDATA[%s]]></MusicUrl>
                    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                    </Music>
                    </xml>';
        echo sprintf($template, $toUser, $fromeUser, $createTime, $title, $description, $music_url, $hq_music_url, $thumb_media_id);
    }

    //回复图文消息
    public function sendNews($article_count, $articles, $toUser = '')
    {
        if (empty($toUser)) {
            $toUser = $this->FromeUser;
        }
        $fromeUser = $this->ToUser;
        $createTime = time();
        $info = sprintf('<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[news]]></MsgType>
                        <ArticleCount>%s</ArticleCount>
                        <Articles>', $toUser, $fromeUser, $createTime, $article_count);
        foreach ($articles as $value) {
            $info .= sprintf('<item>
                            <Title><![CDATA[%s]]></Title> 
                            <Description><![CDATA[%s]]></Description>
                            <PicUrl><![CDATA[%s]]></PicUrl>
                            <Url><![CDATA[%s]]></Url>
                            </item>', $value[1], $value[2], $value[3], $value[4]);
        }
        $info .= '</Articles>
                  </xml>';
        echo $info;
    }
}