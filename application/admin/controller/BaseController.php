<?php
namespace app\admin\controller;
use think\Request;
class BaseController extends \think\Controller
{
   protected function initialize(){
        parent::initialize();
       /*
        $lang['put']='提交';
        $lang['update']='修改';
        $lang['update']='修改';*/
   }
   protected function sns($msg,$telephone){
       $url='http://118.190.89.77:9001/sms.aspx?action=send&userid=588&account=503505944&password=503505944&mobile='.$telephone.'&content=【域御良品】'.$msg;
       //var_dump(file_get_contents($url));
       file_get_contents($url);
   }
  public function check_session(){
          if(empty(Session::get('admin'))){
               $this->redirect('/index.php/admin/admin/login');
          }
  }
    public function returnInfo($status=0,$data,$msg='',$type='json'){
        $rs['status']=$status;
        $rs['data']=$data;
        $rs['message']=$msg;
        switch ($type) {
                case 'json':
                    if (isset($_GET['debug'])) {
                        echo '<pre>' . json_encode($rs, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</pre>';
                    } else {
                        die(json_encode($rs, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                    }
                    break;
                default:
                    break;
        }
    }

    public function changStatus(Request $request){

    }
}
