
function js_method(obj,i){
    if(i==1){
     
      $(obj).closest('.form-inline').after( $(obj).closest('.form-inline').prop("outerHTML")); 
    }else{
      if($('.glyphicon-minus').length>1){
         $(obj).closest('.form-inline').remove();     
      }
    }
  }

  $(document).ready(function() {



 });

