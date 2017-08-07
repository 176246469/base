$(document).ready(function() {

/*基于sweetalert消息提示框*/
function boxMsg(status,content){
    //成功
    if(status==0){
       swal({title:content,text:content,type:"success"});
    }else{
       swal({title:content,text:content,type:"error"});
    }
}
/*基于sweetalert确认提示*/
function boxConfirm(content,e){
    swal({
       title: content,
       text: "删除后将无法恢复，请谨慎操作！",
        //type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "删除",
        closeOnConfirm: false
    },e);
}
  //boxMsg(1,777);
/*验证*******************/
/*
function fcheck(obj){
var form=$(obj).closest('form');
form.find('.targe-check').each(function(index, el) {
   var type= $(this).attr('targe-check-type');
    var strs= new Array();  
    strs=type.split("|"); //字符分割 
    for (i=0;i<strs.length ;i++ ) { 
        switch(strs[i])
        {
        case 'number':
          
          break;
        case 2:
           
          break;
        default:
         
        }
    } 

});
*/

}
/********************/
/*删除******/
function del(url){ 
alert(url);
/*
    boxConfirm('是否删除？',function(){
          window.location.href=url;
    });*/
}
/*******/
var jc = {
    api: 'http://www.tp.com/',
    init: function() {
        _this = this;
    },
    //表单提交
    submit: function(obj) {
        var form=$(obj).closest('form');
        $.ajax({
            type: 'POST',
            url:  _this.api+form.attr('action'),
            data:  form.serialize(),
            dataType: "JSON",
            success: function(result) {
                    if(result.status==0){
                        if(result.message!=''){
                            _this.alert(result.status,result.message);
                        }
                        if(result.data!=''){
                            window.location.href=result.data;
                        }
                    }else if( result.status<0){
                        _this.alert(result.status,result.message);
                    }
            }
        });
    } ,
    //搜索
    search: function(obj) {
        var form=$(obj).closest('form');
        form.submit();
    },
    //提示
    alert: function(status,message) {
      
            boxMsg(status,message);
    }
}
  jc.init();
//模型动态绑定添加
$("#mould-check-box").on("click",".check-box",function(){  
  var check='';
  $(this).parent().parent().find('input[class=check-box]').each(function(index, el) {
    if($(this).is(':checked')) {
       check+=$(this).val()+',';
    }
  });
  $(this).parent().parent().find('input[class=box-check]').val(check);  
});  
$('.change-status').click(function(event) {
 /*
      var targe-url=$(this).attr('targe-url'); 
      var targe-tag=$(this).attr('targe-tag');
      var targe-id=$(this).attr('targe-id');
      var targe-status=$(this).attr('targe-status');
      
      boxConfirm('确定要'+targe-tag+'?',function(){
          window.location.href=targe-url+'?id='+targe-id+'&targe-status='+targe-status;
      });*/
});

$('#submit').click(function(event) {
 jc.submit($(this));
});

//绑定搜索
$('#sreach').click(function(event) {
    jc.sreach$(this);
});

});