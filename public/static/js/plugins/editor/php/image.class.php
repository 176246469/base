<?php  

   class Image{  
         
       private $src;  
       private $imageinfo;  
       private $image;  
       public  $percent = 0.1;  
       public function __construct($src){  
             
           $this->src = $src;  
             
       }  

       public function openImage(){  
             
           list($width, $height, $type, $attr) = getimagesize($this->src);  
           $this->imageinfo = array(  
                  
                'width'=>$width,  
                'height'=>$height,  
                'type'=>image_type_to_extension($type,false),  
                'attr'=>$attr  
           );  
           $fun = "imagecreatefrom".$this->imageinfo['type'];  
           $this->image = $fun($this->src);  
       }  

       public function thumpImage(){  
             
            $new_width = $this->imageinfo['width'] * $this->percent;  
            $new_height = $this->imageinfo['height'] * $this->percent;  
            $image_thump = imagecreatetruecolor($new_width,$new_height);  
            //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度  
            imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);  
            imagedestroy($this->image);    
            $this->image =   $image_thump;  
       }  

       public function showImage(){  
             
            header('Content-Type: image/'.$this->imageinfo['type']);  
            $funcs = "image".$this->imageinfo['type'];  
            $funcs($this->image);  
             
       }  

       public function saveImage($name){  
             
            $funcs = "image".$this->imageinfo['type'];  
            $funcs($this->image,$name.'.'.$this->imageinfo['type']);  
             
       }  
  
       public function __destruct(){  
             
           imagedestroy($this->image);  
       }  
         
   }  
   
  
?>  