<?php
namespace app\api\controller;
use think\Request;
use think\Session;
use app\api\model\MemberModel;


class Article extends  BaseController
{

       public function getlist(Request $request){


           $data=MouldModel::getList($request->post('id'));
           
       }
}
