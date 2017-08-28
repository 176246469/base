<?php
namespace app\admin\model;
use think\Cache;
use think\Db;
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
                      '7'=>'富文本[text(255)]',
                      '11'=>'日期[int(11)]',
                      '12'=>'时间[int(11)]',
                      '13'=>'图片[varchar(255)]',
                      '14'=>'视频[varchar(255)]',
                      '15'=>'文件[varchar(255)]',
            ];
        if(empty($key)){
              return  $type;
        }else{
           return  $type[$key];
        }
   }
    public static  function getList($id,$param,$filed=""){
            if(!empty($param)){
              foreach($param as $key=>$val){
                 $where[$key]=['=',trim($val)];
              }            
            }
            $where['status']=['>',0];
             $info= self::find($id)->toarray();
             if(empty($filed)){
                 $filed_str="id,status";
                 $info['list']=self::mb_unserialize($info['list']);
                 foreach(FiledsModel::all(['mould_id'=>$id]) as $value){
                      if(isset($info['list'][$value->id])){
                        $filed_str.=",".$value->filed;
                      }
                 }
             }else{
                $filed_str="'*'";
             }  
            $list=Db::table($info['table'])->field($filed_str)->where($where)->paginate(15);
            $data['list']=$list;
            $data['page'] = $list->render();
            return  $data;
     }
      public static function getInfo($mould_id,$id){
             $info= self::find($mould_id)->toarray();
             $data=Db::table($info['table'])->find($id);
             return  $data;
     }

      public static function updateInfo($mould_id,$id,$data){
             $where['id']=$id;
             $info= self::find($mould_id)->toarray();
             return  Db::table($info['table'])->where($where)->update($data);
     }
         public static  function delInfo($mould_id,$id){
            return  self::updateInfo($mould_id,$id,['status' => '-1']);
     }

    public static function mb_unserialize($serial_str) { 
        $serial_str = preg_replace_callback('!s:(\d+):"(.*?)";!s', create_function('$math',"return 's:'.strlen(\$math[2]).':\"'.\$math[2].'\";';"), $serial_str); 
        return unserialize($serial_str);
    }
    
   //单选数据表生产
    public static  function is_from_tab($select){
      $result = array();
      preg_match_all("/(?:\{)(.*)(?:\})/i",$select, $result);
      if(isset($result[1][0])&&!empty($result[1][0])){
              $str=explode('|',$result[1][0]);
              $tab=$str[0];
              $str=explode(':',$str[1]);
              $key=$str[0];
              $value=$str[1];
              $rs=array();
              foreach(Db::table($tab)->distinct(true)->field($key.','.$value)->select() as $k=>$v){
                  $rs[$k]=$v;

              }
      return $rs;
      }else{
        return $select;
      }
    }
  }
?>
