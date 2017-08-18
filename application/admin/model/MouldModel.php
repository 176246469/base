<?php
namespace app\admin\model;
use think\Cache;
use app\admin\model\BaseModel;
class MouldModel  extends BaseModel  
{
    protected $table = 'mould';
   public static  function Type($key=0){
          $type=[
                      '1'=>'文本 [varchar(255)]',
                      '2'=>'数字 [int(11)]',
                      '3'=>'浮点 [decimal(11,3)]',
                      '4'=>'单选[varchar(1)]',
                      '5'=>'多选[varchar(1)]',
                      '6'=>'多行文本[varchar(255)]',
                      '10'=>'富文本[text(255)]',
                      '11'=>'日期[int(11)]',
                      '12'=>'图片[varchar(255)]',
                      '13'=>'视频[varchar(255)]',
                      '14'=>'文件[varchar(255)]',
            ];
        if(empty($key)){
              return  $type;
        }else{
           return  $type[$key];
        }
   }
    public static  function getList($id,$filed=""){
             $where['status']=1;
             $info= self::find($id);
             if(empty($filed)){
                 $filed_str="'id','status'";
                 $info->list=$this->mb_unserialize($info->list);
                 foreach(FiledsModel::all(['mould_id'=>$id]) as $value){
                      if(isset($info->list[$value->id])){
                        $filed_str.="'".$value->filed."'";
                      }
                 }
             }else{
                $filed_str="'*'";
             }
            $list=Db::table($mould->table)->field($filed_str)->where($where)->paginate(15);
            $data['list']=$list;
            $data['page'] = $list->render();
            return  $data;
     }

      public static function getInfo($mould_id,$id){
             $where['status']=1;
             $where['id']=$id;
             $info= self::find($mould_id);
             $data=Db::table($mould->table)->where($where)->find();
             return  $data;
     }

      public static function updateInfo($mould_id,$id,$data){
             $where['id']=$id;
             $info= self::find($mould_id);
             return  Db::table($mould->table)->where($where)->update($data);
     }
         public static  function delInfo($mould_id,$id){
            return  self::updateInfo($mould_id,$id,['status' => '-1']);
     }

    function mb_unserialize($serial_str) { 
        $serial_str = preg_replace_callback('!s:(\d+):"(.*?)";!s', create_function('$math',"return 's:'.strlen(\$math[2]).':\"'.\$math[2].'\";';"), $serial_str); 
        return unserialize($serial_str);
    }
}

?>
