<?php
namespace app\admin\controller;
use think\Request;
use think\Session;
use app\admin\model\MenuModel;
use app\admin\model\GroupModel;
use app\admin\model\AdminModel;
use app\admin\model\TreeModel;

class Apiarticle extends  BaseController
{

        public function login(){
            return $this->fetch('login');
        }

}
