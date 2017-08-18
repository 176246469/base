<?php
/*  
        if(strtolower($_SERVER['REQUEST_METHOD']) == 'get') {
            file_put_contents('weixin_log.txt', "IP=".$_SERVER['REMOTE_ADDR'].PHP_EOL,FILE_APPEND); //记录访问IP到log日志
            file_put_contents('weixin_log.txt', "QUERY_STRING=".$_SERVER['QUERY_STRING'].PHP_EOL,FILE_APPEND);//记录请求字符串到log日志
            file_put_contents('weixin_log.txt', '$_GET[echostr])='.htmlspecialchars($_GET['echostr']).PHP_EOL,FILE_APPEND); //记录是否获取到echostr参数
            exit(htmlspecialchars($_GET['echostr']));      //把echostr参数返回给微信开发者后台
}*/
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
                     exit(htmlspecialchars($_GET['echostr'])); 
                }

?>