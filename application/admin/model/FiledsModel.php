<?php
namespace app\admin\model;
use think\Cache;
//use \think\Validate;
use app\admin\model\BaseModel;
class FiledsModel    extends BaseModel
{
   protected $table = 'mould_fileds';

   public static $validate_data  = array(
                                                    '1'=>array('必填','require'),
                                                    '2'=>array('数字','number'),
                                                    '3'=>array('浮点数','float'),
                                                    '4'=>array('邮箱','email'),
                                                    '5'=>array('字母和数字','alphaNum'),
                                                    '6'=>array('字母和数字下划线','alphaDash'),
                                                    '7'=>array('长度','length:4,25'),
                                );


       public static function getValidate($data){
                    foreach ($data as $k => $v) {
                        if(isset(self::$validate_data[$k])){
                          $str= self::$validate_data[$k]['1']."|";                          
                        }
                     }
               return trim($str,'|');
        }
}

?>
