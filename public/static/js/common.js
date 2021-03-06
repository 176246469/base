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
        cancelButtonText:"取消",
        closeOnConfirm: true
    },e);
}
/*删除******/
function del(url){ 
  var strs1= new Array();
  var strs2= new Array();
  var string_a="";
  strs1=url.split("?");
  strs2=strs1[1].split("&");
  for(var i=0;i<strs2.length;i++){
  string_a= string_a+strs2[i].replace("=",":")+',';
  }
  var json="{"+string_a+"}";//json格式的字符串
  var json=eval("("+json+")");
    boxConfirm('是否删除？',function(){
        $.ajax({
            type: 'GET',
            url:  strs1[0],
            data:  json,
            success: function(result) {
              window.location.reload();
            }
        });
});
}

function status_change(obj,id,filed,status){

      boxConfirm('你确定将当前状态改为'+status+'？',function(){
     });
}
/*******/
$(document).ready(function() {
var jc = {
    api: 'http://'+window.location.host+'/',
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

$('#submit').click(function(event) {
 jc.submit($(this));
});
$('.submit_all').click(function(event) {

 jc.submit($(this));
});
$(".tab-content").on("click",".btn-top",function(){  
  $(this).closest('tr').after($(this).closest('tr').prev().prop("outerHTML") ); 
  $(this).closest('tr').prev().remove();
});
$(".tab-content").on("click",".btn-down",function(){
  $(this).closest('tr').before($(this).closest('tr').next().prop("outerHTML") ); 
  $(this).closest('tr').next().remove();
});
$(".tab-content").on("click",".btn-del",function(){
  $(this).closest('tr').remove();
});
//绑定搜索
$('#sreach').click(function(event) {
    jc.sreach$(this);
});

});