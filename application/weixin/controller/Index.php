<?php
namespace app\weixin\controller;
use think\Request;
use think\Session;
use app\admin\model\MouldModel;
class Index extends   \think\Controller
{


//public  $mould=array('')
        public function main(Request $request){

                //$this->assign('data',$data); 
                return $this->fetch('main');
        }
        public function article(Request $request){
                $mould_id=25;
                $data=MouldModel::getInfo($mould_id,$request->get('id'));
                $this->assign('data',$data); 
                return $this->fetch('article');
        }
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
