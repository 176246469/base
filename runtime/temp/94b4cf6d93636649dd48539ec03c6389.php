<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"D:\git\base\public/../application/admin\view\mould\view_put.html";i:1502435851;s:63:"D:\git\base\public/../application/admin\view\public\header.html";i:1502174941;s:63:"D:\git\base\public/../application/admin\view\public\footer.html";i:1502174942;}*/ ?>
    <!DOCTYPE html>
<html>
<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 后台登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/H+ v4.1/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/H+ v4.1/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/H+ v4.1/css/animate.min.css" rel="stylesheet">
    <link href="/static/H+ v4.1/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/static/H+ v4.1/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="/static/H+ v4.1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/H+ v4.1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/H+ v4.1/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/static/js/common.js"></script>
  
<link rel="stylesheet" href="/static/js/plugins/editor/themes/default/default.css" />
<script src="/static/js/plugins/editor/kindeditor-all.js"></script>
<script src="/static/js/plugins/editor/lang/zh_CN.js"></script>
<link href="/static/H+ v4.1/css/plugins/iCheck/custom.css" rel="stylesheet">
        <script>
            KindEditor.ready(function(K) {
                /**图片*******/
                var editor = K.editor({
                    allowFileManager : true
                });
                /**富文本**/
                var editor_text;
                editor_text = K.create('textarea[name="content"]', {
                    allowFileManager : true
                });

                K('#image3').click(function() {
                    editor.loadPlugin('image', function() {
                        editor.plugin.imageDialog({
                            showRemote : false,
                            imageUrl : K('#url3').val(),
                            clickFn : function(url, title, width, height, border, align) {
                                K('#url3').val(url);
                                editor.hideDialog();
                            }
                        });
                    });
                });
            });
        </script>
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $data['info']['name']; ?>管理 <small>新增</small></h5>
                    </div>
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal" action="/index.php/admin/mould/view_put?mould_id=<?php echo $data['info']['id']; ?>">
                        <?php if(is_array($data['info']['add']) || $data['info']['add'] instanceof \think\Collection || $data['info']['add'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['info']['add'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"  ><?php echo $data['fileds'][$key]['title']; ?></label>
                            <?php switch($data['fileds'][$key]['type']): case "1": ?>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="<?php echo $data['fileds'][$key]['filed']; ?>"  value="<?php echo $data['fileds'][$key]['value']; ?>">
                                            </div>
                                <?php break; case "2": ?>
                                            <div class="col-sm-10">
                                                    <select class="form-control m-b" name="<?php echo $data['fileds'][$key]['filed']; ?>">
                                                     <?php if(is_array($data['fileds'][$key]['value']) || $data['fileds'][$key]['value'] instanceof \think\Collection || $data['fileds'][$key]['value'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['fileds'][$key]['value'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$select_val): $mod = ($i % 2 );++$i;?>
                                                        <option value="<?php echo $select_val; ?>"><?php echo $select_val; ?></option>
                                                     <?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                            </div>
                                 <?php break; case "3": ?>
                                            <div class="col-sm-10">
                                                  
                                                     <?php if(is_array($data['fileds'][$key]['value']) || $data['fileds'][$key]['value'] instanceof \think\Collection || $data['fileds'][$key]['value'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['fileds'][$key]['value'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$select_val): $mod = ($i % 2 );++$i;?>
                                                       <label class="checkbox-inline">
                                                        <input type="checkbox" value="<?php echo $select_val; ?>" ><?php echo $select_val; ?></label>
                                                     <?php endforeach; endif; else: echo "" ;endif; ?>
                                                 
                                            </div>
                                 <?php break; case "4": ?>
                                            <div class="col-sm-10">
                                                <textarea   class="form-control m-b" name="<?php echo $data['fileds'][$key]['filed']; ?>"  ><?php echo $data['fileds'][$key]['value']; ?></textarea >
                                            </div>
                                 <?php break; case "5": ?>
                                            <div class="col-sm-10">
                                                <textarea name="content" name="<?php echo $data['fileds'][$key]['filed']; ?>" style="width:800px;height:400px;visibility:hidden;"><?php echo $data['fileds'][$key]['value']; ?></textarea >
                                            </div>
                                 <?php break; case "6": ?>
                                            <div class="col-sm-10">
                                                    <input type="text" id="url3" name="<?php echo $data['fileds'][$key]['filed']; ?>"  /> <input type="button" id="image3" value="选择图片" />
                                            </div>
                                 <?php break; case "8": ?>
                                            <div class="col-sm-10">
                                                    <input type="text" id="url3" name="<?php echo $data['fileds'][$key]['filed']; ?>" /> <input type="button" id="image3" value="选择图片" />
                                            </div>
                                 <?php break; default: endswitch; ?>
                                        </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        <!---->
                            <div class="hr-line-dashed"></div>
                        <!---->
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input class="btn btn-primary" type="button"  id="submit"  value="保存">
                                    <a  class="btn btn-white"  href="/index.php/admin/mould/view_columns?mould_id=<?php echo $data['info']['id']; ?>">取消</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

 
    <script src="/static/H+ v4.1/js/content.min.js?v=1.0.0"></script>
    <script src="/static/H+ v4.1/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
</body>
<!-- Mirrored from www.zi-han.net/theme/hplus/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:15 GMT -->
</html>
