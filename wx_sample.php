<?php

//装载模板文件
include_once("wx_Tpl.php");

//获取微信发送数据
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

  //返回回复数据
if (!empty($postStr)){
          
    	//解析数据
          $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    	//发送消息方ID
          $fromUsername = $postObj->FromUserName;
    	//接收消息方ID
          $toUsername = $postObj->ToUserName;
   	    //消息类型
          $form_MsgType = $postObj->MsgType;
        
    	//事件消息
          if($form_MsgType=="event")
          {
            //获取事件类型
            $form_Event = $postObj->Event;
            $form_Eventkey=$postObj->EventKey;
              
            //首次关注回复图文消息
              if($form_Event=="subscribe")
            {
                
           $resultStr = "<xml> \n
           <ToUserName><![CDATA[$fromUsername]]></ToUserName> \n
           <FromUserName><![CDATA[$toUsername]]></FromUserName> \n
           <CreateTime>.time().</CreateTime> \n
           <MsgType><![CDATA[news]]></MsgType> \n
           <ArticleCount>4</ArticleCount> \n
           <Articles> \n";
           
           
           //添加首次关注第一张图文
           $resultStr.="<item> \n
           <Title><![CDATA[欢迎关注指尖南信]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/201405252113120512.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200314601&idx=1&sn=7882d867558ca243a666c6f3ddf8f0f6&scene=1&from=singlemessage&isappinstalled=0#rd]]></Url> \n
           </item> \n";
               
           $resultStr.="<item> \n
           <Title><![CDATA[点赞就送可乐！]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/first/kele.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://wx.wsq.qq.com/243113113/v/70/t/71]]></Url> \n
           </item> \n";
                  
           $resultStr.="<item> \n
           <Title><![CDATA[影魔方活动]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/first/yingfomang.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200464832&idx=1&sn=3e4086b2e43c1f437e421373dfc0c555&key=0cbeb7802f7d2a1ee292f4ed910e04570af177e3e7f3d14fcd418c4829baf200a2a8b464d390f8f6427069fe0a71c348&ascene=1&uin=MjgyNzYwMjM1]]></Url> \n
           </item> \n";
                  
           $resultStr.="<item> \n
           <Title><![CDATA[大转盘抽奖]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/first/dazhuanpan.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://www.wechat58.com/wxcore/shoper/pan.php]]></Url> \n
           </item> \n";
               
           $resultStr.="</Articles> \n
           <FuncFlag>1</FuncFlag> \n
           </xml> "; 
              echo $resultStr; 
              exit;
            }
              
              
              
           //自定义菜单点击回复  
           if($form_Event=="CLICK")
            {
              
               switch($form_Eventkey)
                           {
                      case "V1001":
                           require_once 'simple_html_dom.php';
                           $ab=array();
                           $html = file_get_html("http://www.nuist.edu.cn/bulletin/(S(v0aw44v2ol10fy554x4po23p))/default.aspx");
                           foreach ($html->find("tr") as $element){
                              foreach ($element->find("td") as $td){
                                  foreach ($td->find("a[class='listcoco']") as $a){
                                           $ab[]=$a;
                                         }
                                      }
                                  }
                           $ad=array_slice($ab,0,8);

                        
                  $resultStr="<xml>\n
                  <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                  <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                  <CreateTime>".time()."</CreateTime>\n
                  <MsgType><![CDATA[news]]></MsgType>\n
                  <ArticleCount>9</ArticleCount>\n
                  <Articles>\n";
                        
                  $resultStr.="<item> \n
                  <Title><![CDATA[信息公告]]></Title> \n
                  <Description><![CDATA[思想与技术的平台]]></Description> \n
                  <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/title/notice.jpg]]></PicUrl>   \n
                  <Url><![CDATA[]]></Url> \n
                  </item> \n";
                        
                   //数组循环
                  foreach($ad as $value){
                            $bc=$value->innertext;
                            $bd='http://www.nuist.edu.cn/bulletin/(S(3hv2fs554pjooo45gtuqbm55))/'.$value->href;
                    $resultStr.=
                    "<item>\n
                    <Title><![CDATA[".$bc."]]></Title> \n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[]]></PicUrl>\n
                    <Url><![CDATA[".$bd."]]></Url>\n
                    </item>\n";
                        }
                    $resultStr.="</Articles>\n
                    <FuncFlag>0</FuncFlag>\n
                    </xml>";
                    echo $resultStr;
                    break;
                    
                   
                    case "V1002":
                    $msgType = "text";
                    $contentStr = "教务信息系统正在完善中......";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);                         
                    echo $resultStr;
                             break;
                    
                   
                    case "V1003":$msgType = "text";
                    require_once 'simple_html_dom.php';
                    $html = file_get_html("http://jyb.nuist.edu.cn/(S(xb5y5b55p01ent45dy5b2kul))/Class.aspx?ci=94");
                    foreach ($html->find("tr[class='gridline']") as $tr){
                           foreach ($tr->find("td") as $td){
                                 foreach ($td->find("a[class='Title']") as $a){
                                          $job[]=$a;
                                           }
                                        }
                                    }
                     $ad=array_slice($job,0,12);
                  $resultStr="<xml>\n
                  <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                  <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                  <CreateTime>".time()."</CreateTime>\n
                  <MsgType><![CDATA[news]]></MsgType>\n
                  <ArticleCount>10</ArticleCount>\n
                  <Articles>\n";
                        
           $resultStr.="<item> \n
           <Title><![CDATA[招聘信息]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/title/recruit.jpg]]></PicUrl>   \n
           <Url><![CDATA[]]></Url> \n
           </item> \n";
           //数组循环
        foreach($ad as $value){
        $a=$value->innertext;
        $b='http://jyb.nuist.edu.cn/(S(xb5y5b55p01ent45dy5b2kul))/'.$value->href;
        $resultStr.="<item>\n
                    <Title><![CDATA[".$a."]]></Title> \n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[]]></PicUrl>\n
                    <Url><![CDATA[".$b."]]></Url>\n
                    </item>\n";
              }
        $resultStr.="</Articles>\n
                  <FuncFlag>0</FuncFlag>\n
                  </xml>";
        echo $resultStr;
                             break;
                   
                   
                        case "V1004":$msgType = "text";
                             $contentStr = "请回复  查#书名  ，即可查询，\n例如发送  查#红楼梦 ";
                             $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
                             echo $resultStr;
                             break;
                   
                   
            //回复校园活动
                        case "V1005": 
    $resultStr = "<xml> \n
           <ToUserName><![CDATA[$fromUsername]]></ToUserName> \n
           <FromUserName><![CDATA[$toUsername]]></FromUserName> \n
           <CreateTime>.time().</CreateTime> \n
           <MsgType><![CDATA[news]]></MsgType> \n
           <ArticleCount>5</ArticleCount> \n
           <Articles> \n";


             //校园活动图文第一张
    $resultStr.="<item> \n
           <Title><![CDATA[校园活动]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/huodong/huodong.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200314401&idx=1&sn=e1f1c4e32b7c27f483f8637baece2a25#rd]]></Url> \n
           </item> \n";

    $resultStr.="<item> \n
           <Title><![CDATA[6.6【see you 毕业专场】]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/seeyou.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200314401&idx=4&sn=010bde0bc3523b5e70c646b6bff9e833#rd]]></Url> \n
           </item> \n";

    $resultStr.="<item> \n
           <Title><![CDATA[6.7梦回经夏经管院毕业晚会]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/huodong/jingguanyuan.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200314401&idx=5&sn=9465331981bd065eafd313e8c5d07e3a#rd]]></Url> \n
           </item> \n";
                   
    $resultStr.="<item> \n
           <Title><![CDATA[6.9公管院毕业晚会]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/huodong/gongguanyuan.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200314401&idx=2&sn=ee9b121ce2f9033009888d3106aa991d#rd]]></Url> \n
           </item> \n";

    $resultStr.="<item> \n
           <Title><![CDATA[6.7tnt专场活动]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/huodong/tnt.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200314401&idx=3&sn=2bd992d7056716c3683b35cb6bbbf487#rd]]></Url> \n
           </item> \n";

    $resultStr.="</Articles> \n
           <FuncFlag>1</FuncFlag> \n
           </xml> ";
    echo $resultStr;
    break;             
      //回复校园活动结束
                        
                   
                   
      //回复“去哪儿”住
                        case "V2004":
                               $resultStr = "<xml> \n
           <ToUserName><![CDATA[$fromUsername]]></ToUserName> \n
           <FromUserName><![CDATA[$toUsername]]></FromUserName> \n
           <CreateTime>.time().</CreateTime> \n
           <MsgType><![CDATA[news]]></MsgType> \n
           <ArticleCount>5</ArticleCount> \n
           <Articles> \n";

    $resultStr.="<item> \n
           <Title><![CDATA[去哪住]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/binguan/qunaer.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://www.wechat58.com/wxcore/details.php?id=6181]]></Url> \n
           </item> \n";

    $resultStr.="<item> \n
           <Title><![CDATA[苑都宾馆（13915926829)]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/binguan/yuandu.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://www.wechat58.com/wxcore/details.php?id=6182]]></Url> \n
           </item> \n";

    $resultStr.="<item> \n
           <Title><![CDATA[阿想宾馆（13912920997)]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/binguan/axiang.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://www.wechat58.com/wxcore/details.php?id=6183]]></Url> \n
           </item> \n";

    $resultStr.="<item> \n
           <Title><![CDATA[可乐小屋（15195824344)]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/binguan/kele.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://www.wechat58.com/wxcore/details.php?id=6184]]></Url> \n
           </item> \n";

    $resultStr.="<item> \n
           <Title><![CDATA[栀子花旅馆(15358119056)]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/binguan/zhizihua.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://www.wechat58.com/wxcore/details.php?id=6185]]></Url> \n
           </item> \n";


    $resultStr.="</Articles> \n
           <FuncFlag>1</FuncFlag> \n
           </xml> ";
    echo $resultStr;
    break;
    // 回复去哪儿住结束
                   
                   
                   
           //回复点击我要投票
                         case "V3003":
           $resultStr = "<xml> \n
           <ToUserName><![CDATA[$fromUsername]]></ToUserName> \n
           <FromUserName><![CDATA[$toUsername]]></FromUserName> \n
           <CreateTime>.time().</CreateTime> \n
           <MsgType><![CDATA[news]]></MsgType> \n
           <ArticleCount>7</ArticleCount> \n
           <Articles> \n";
           
           $resultStr.="<item> \n
           <Title><![CDATA[6.5环保时装秀]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[http://zjnx-zjnx.stor.sinaapp.com/huodong/huanbao.jpg]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200314401&idx=2&sn=ee9b121ce2f9033009888d3106aa991d#rd]]></Url> \n
           </item> \n";

           $resultStr.="<item> \n
           <Title><![CDATA[女生一组]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200354476&idx=1&sn=3d861c0dd3e4a83f63d4916ddeade9b6#rd]]></Url> \n
           </item> \n";
           $resultStr.="<item> \n
           <Title><![CDATA[女生二组]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200354510&idx=1&sn=96320434ec7e2738ce037ea39da9f0cb#rd]]></Url> \n
           </item> \n";
                 
           $resultStr.="<item> \n
           <Title><![CDATA[女生三组]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200354535&idx=1&sn=e69e25a55514f234e7b82b08459c6b37#rd]]></Url> \n
           </item> \n";
           $resultStr.="<item> \n
           <Title><![CDATA[男生一组]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200354576&idx=1&sn=290d5b9b629c9282f55ae64c605fe47e#rd]]></Url> \n
           </item> \n";
                   
           $resultStr.="<item> \n
           <Title><![CDATA[男生二组]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200354625&idx=1&sn=b236d47ef4c99480db024ff8dcf3c7eb#rd]]></Url> \n
           </item> \n";
           $resultStr.="<item> \n
           <Title><![CDATA[男生三组]]></Title> \n
           <Description><![CDATA[思想与技术的平台]]></Description> \n
           <PicUrl><![CDATA[]]></PicUrl>   \n
           <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA4NjQwMTIzOA==&mid=200354645&idx=1&sn=19cd5532493c1b3eea91b9a50d31aac4#rd]]></Url> \n
           </item> \n";

           $resultStr.="</Articles> \n
           <FuncFlag>1</FuncFlag> \n
           </xml> ";
           echo $resultStr;
           break;              
           //回复“我要投票”结束
                   
                   
                   
                         case "V3004":$msgType = "text";
                             $contentStr = "回复 签到 即有机会获赠话费";
                             $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
                             echo $resultStr;
                             break;
                        
                         default : echo "nothing";
                             break;
                            }
                            
                    exit;
                
            }
          }
    
    
    
    
         //回复文字信息  
        if($form_MsgType=="text")
        {
            //获取用户发送的文字内容
            $form_Content = trim($postObj->Content);
            //如果发送内容不是空白回复用户相同的文字内容
            if(!empty($form_Content))
            {

                //回复外卖
                if(preg_match('/查#/', $form_Content))
                {
                    
                 //   $form_Content="查#红楼梦";
                    $name=substr($form_Content,4);
                    require_once 'simple_html_dom.php';
                    function getLibrary($keyword) {
                        $book=array();
                        $html = file_get_html("http://lib2.nuist.edu.cn/opac/openlink.php?strSearchType=title&match_flag=forward&historyCount=1&strText=$keyword&doctype=ALL&displaypg=20&showmode=list&sort=CATA_DATE&orderby=desc&dept=ALL");
                        foreach ($html->find('li[class=book_list_info]') as $element){
                            foreach ($element->find('h3') as $h3){
                                foreach ($h3->find('a') as $a){
                                    $book[]=$a;
                                    //http://lib2.nuist.edu.cn/opac/'.$a->href.'<br>';
                                }
                            }
                        }
                        return $book;
                    }

                    $abc=getLibrary($name);
                    $abcd=array_slice($abc,0,8);
                    
    $resultStr="<xml>\n
                  <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                  <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                  <CreateTime>".time()."</CreateTime>\n
                  <MsgType><![CDATA[news]]></MsgType>\n
                  <ArticleCount>8</ArticleCount>\n
                  <Articles>\n";
                   //数组循环
                    foreach($abcd as $value){
                        $ah=mb_convert_encoding ("$value->innertext", "UTF-8", "HTML-ENTITIES");      
                        $bh='http://lib2.nuist.edu.cn/opac/'.mb_convert_encoding ("$value->href", "UTF-8", "HTML-ENTITIES");
                        
                            $resultStr.="<item>\n
                    <Title><![CDATA[".$ah."]]></Title> \n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[]]></PicUrl>\n
                    <Url><![CDATA[".$bh."]]></Url>\n
                    </item>\n";
                        }
                    $resultStr.="</Articles>\n
                  <FuncFlag>0</FuncFlag>\n
                  </xml>";
                    echo $resultStr;
                    exit;

                }

                //回复公交
                if($form_Content=="公交")
                {
                    $return_str="南信大周边公交线路：\n";
                    $return_arr=array("D2：扬子乙烯-->鼓楼\n","D3：扬子乙烯-->大桥南路\n","江扬：扬子乙烯-->浦口公园\n","636\n","汉六：\n","中六：\n","古平岗：");
                    $return_str.=implode("",$return_arr);
                    $msgType = "text";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $return_str);
                    echo $resultStr;
                    exit;

                }
                
                //回复签到
                if($form_Content=="签到")
                {
                    
                    $return_str="恭喜你今日签到成功，有机会获赠话费";
                    $msgType = "text";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $return_str);
                    echo $resultStr;
                    exit;

                }
                
            }
        }
        
          
          
  }
  else 
  {
          echo "";
          exit;
  }

?> 