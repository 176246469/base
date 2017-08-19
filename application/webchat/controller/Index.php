<?php
namespace app\webchat\controller;
use think\Request;
use think\Session;
use app\admin\model\MouldModel;
class Index extends   \think\Controller
{
       //首页
        public function main(Request $request){
                //$this->assign('data',$data); 
                return $this->fetch('main');
        }
        //文章
        public function article(Request $request){
                $mould_id=25;
                $data=MouldModel::getInfo($mould_id,$request->get('id'));
                $this->assign('data',$data); 
                return $this->fetch('article');
        }
        //分类
        public function group(Request $request){

                //$this->assign('data',$data); 
                return $this->fetch('group');
        }
        
        public function blind(Request $request){

                //$this->assign('data',$data); 
                return $this->fetch('blind');
        }
        public function paly(Request $request){

                //$this->assign('data',$data); 
                return $this->fetch('paly');
        }
        public function lister(Request $request){
                return $this->fetch('list');
        }
        public function vip(Request $request){
                return $this->fetch('vip');
        }
}
