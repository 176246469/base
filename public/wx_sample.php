<?php
                $signature = $_GET["signature"];
                $timestamp = $_GET["timestamp"];
                $nonce = $_GET["nonce"];    
                $token = "weixin";
                $tmpArr = array($token, $timestamp, $nonce);
                sort($tmpArr);
                $tmpStr = implode( $tmpArr );
                $tmpStr = sha1( $tmpStr );
                //验证成功
                if( $tmpStr == $signature ){
                        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
                        if (!empty($postStr)){
                                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                                $fromUsername = $postObj->FromUserName;
                                $toUsername = $postObj->ToUserName;
                                $keyword = trim($postObj->Content);
                                $time = time();
                                $textTpl = "<xml>
                                            <ToUserName><![CDATA[%s]]></ToUserName>
                                            <FromUserName><![CDATA[%s]]></FromUserName>
                                            <CreateTime>%s</CreateTime>
                                            <MsgType><![CDATA[%s]]></MsgType>
                                            <Content><![CDATA[%s]]></Content>
                                            <FuncFlag>0</FuncFlag>
                                            </xml>";             
                                if(!empty($keyword )){
                                    $msgType = "text";
                                    $contentStr = "Welcome to wechat world!";
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                    echo $resultStr;
                                }
                         }
                }

?>