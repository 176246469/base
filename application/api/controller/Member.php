<?php
namespace app\api\controller;
use think\Request;
use think\Session;
use app\api\model\MemberModel;


class Member extends  BaseController
{

        public function quit(){
            Session::delete('admin');
            $this->check_session();
        }

        public function login(Request $request){
            $option['name']=$request->post('name');
            $option['password']=$request->post('password'); 
            $member=new  MemberModel();
            $member= $member->login($option);
            if(empty($member)){
                    $this->returnInfo(-1,'','密码错误');
            }else{
                    //Session::set('member',$member);
                    $this->returnInfo(0,$member,'登录成功');
            }    
        }
        public function register(Request $request){
            $member=new  MemberModel();
            $option=$request->post();
            $member->name=$option['name'];
            $member->password=$option['password'];
            $member->token=md5($member->name+time());
            if($member->save()){
                $data=$member->toarry();
                $this->returnInfo(0,$data,'注册成功');
            }else{
                 $this->returnInfo(-1,'','注册失败');
            }
        }
}
