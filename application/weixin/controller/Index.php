<?php
namespace app\weixin\controller;
use think\Request;
use think\Session;


use app\weixin\wechatCallbackapiTest;
class Index extends  BaseController
{

        public function index(Request $request){

            $wechatObj = new wechatCallbackapiTest();
            $wechatObj->valid();
        }

}
