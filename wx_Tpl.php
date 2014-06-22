<?php


$subscribeTpl="
           <xml>
           <ToUserName><![CDATA[toUser]]></ToUserName>
           <FromUserName><![CDATA[FromUser]]></FromUserName>
           <CreateTime>%$s</CreateTime>
           <MsgType><![CDATA[event]]></MsgType>
           <Event><![CDATA[subscribe]]></Event>
           </xml>
           ";

$unsubscribeTpl="
           <xml>
           <ToUserName><![CDATA[toUser]]></ToUserName>
           <FromUserName><![CDATA[FromUser]]></FromUserName>
           <CreateTime>%s</CreateTime>
           <MsgType><![CDATA[event]]></MsgType>
           <Event><![CDATA[unsubscribe]]></Event>
           </xml>
           ";

$clickTpl="
           <xml>
           <ToUserName><![CDATA[%s]]></ToUserName>
           <FromUserName><![CDATA[%s]]></FromUserName>
           <CreateTime>%s</CreateTime>
           <MsgType><![CDATA[event]]></MsgType>
           <Event><![CDATA[CLICK]]></Event>
           <EventKey><![CDATA[%s]]></EventKey>
           </xml>
           ";

$viewTpl ="
           <xml>
           <ToUserName><![CDATA[%s]]></ToUserName>
           <FromUserName><![CDATA[%s]]></FromUserName>
           <CreateTime>%s</CreateTime>
           <MsgType><![CDATA[event]]></MsgType>
           <Event><![CDATA[VIEW]]></Event>
           <EventKey><![CDATA[%s]]></EventKey>
           </xml>
           ";

$textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName> 
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <MsgId>123</MsgId>
            </xml>";   
$newsTpl = "<xml>
           <ToUserName><![CDATA[%s]]></ToUserName>
           <FromUserName><![CDATA[%s]]></FromUserName>
           <CreateTime>%s</CreateTime>
           <MsgType><![CDATA[%s]]></MsgType>
           <ArticleCount>%s</ArticleCount>
           <Articles>
           <item>
           <Title><![CDATA[%s]]></Title> 
           <Description><![CDATA[%s]]></Description>
           <PicUrl><![CDATA[%s]]></PicUrl>
           <Url><![CDATA[%s]]></Url>
           </item>
           </Articles>
           <FuncFlag>1</FuncFlag>
           </xml> ";
$musicTpl = "<xml>
             <ToUserName><![CDATA[%s]]></ToUserName>
             <FromUserName><![CDATA[%s]]></FromUserName>
             <CreateTime>%s</CreateTime>
             <MsgType><![CDATA[%s]]></MsgType>
             <Music>
             <Title><![CDATA[%s]]></Title>
             <Description><![CDATA[%s]]></Description>
             <MusicUrl><![CDATA[%s]]></MusicUrl>
             <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
             </Music>
             <FuncFlag>0</FuncFlag>
             </xml>";
?>