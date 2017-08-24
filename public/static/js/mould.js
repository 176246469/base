
function js_method(obj,i){
    if(i==1){
      $(obj).closest('tr').after( $(obj).closest('tr').prop("outerHTML")); 
    }else{
      if($('tbody tr').length>1){
         $(obj).closest('tr').remove();     
      }
    }
  }
function js_method_set(obj,i){
    if(i==1){
      $(obj).closest('tr').after( $("#add_set").html()); 
    }else{
      if($('tbody tr').length>1){
         $(obj).closest('tr').remove();     
      }
    }
  }
  $(document).ready(function() {
    $(".input-group.date").datepicker({
        todayBtn: "linked",
        keyboardNavigation: !1,
        forceParse: !1,
        calendarWeeks: !0,
        autoclose: !0
    });
    $("#oop").click();
 });

