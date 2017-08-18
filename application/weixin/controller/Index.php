<?php
namespace app\weixin\controller;
use think\Request;
use think\Session;
class Index extends   \think\Controller
{

        public function main(Request $request){

                //$this->assign('data',$data); 
                return $this->fetch('main');
        }
        public function article(Request $request){

                //$this->assign('data',$data); 
                return $this->fetch('article');
        }
        public function group(Request $request){

                //$this->assign('data',$data); 
                return $this->fetch('group');
        }
}
