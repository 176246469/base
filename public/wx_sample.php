<?php   
                $signature = $_REQUEST['signature'];
                $timestamp =  $_REQUEST['timestamp'];
                $nonce =  $_REQUEST['nonce'];
                $token = "weixin";
                $tmpArr = array($token, $timestamp, $nonce);
                sort($tmpArr);
                $tmpStr = implode( $tmpArr );
                $tmpStr = sha1( $tmpStr );
                //验证成功
                if( $tmpStr == $signature ){
                        return true;
                }

?>