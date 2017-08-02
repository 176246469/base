<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"D:\otherWeb\base\public/../application/admin\view\mould\put.html";i:1501577993;s:68:"D:\otherWeb\base\public/../application/admin\view\public\header.html";i:1501204505;s:68:"D:\otherWeb\base\public/../application/admin\view\public\footer.html";i:1501204646;}*/ ?>
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
  
<link href="/static/H+ v4.1/css/plugins/iCheck/custom.css" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>模型管理 <small>新增</small></h5>
                    </div>
                    <div class="ibox-content">
                            <div  class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="sr-only">模型名称</label>
                                    <input type="email" placeholder="模型名称" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="sr-only">表名称</label>
                                    <input type="email" placeholder="表名称" class="form-control">
                                </div>
                             </div>
                    </div>
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal" action="/index.php/admin/mould/put">
                            <div  class="form-inline">
                                <div class="form-group">
                                    <input type="email" placeholder="请输入标题" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="请输入字段"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="默认值" class="form-control">
                                </div>
                                <div class="form-group">
                                       <select class="form-control  " name="type">
                                        <?php if(is_array($data['type']) || $data['type'] instanceof \think\Collection || $data['type'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['type'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-control">
                                            <label>
                                            <input type="checkbox" value="1"> 新增 </label>
                                            <label>
                                            <input type="checkbox" value="2"> 编辑 </label>
                                            <label>
                                            <input type="checkbox" value="3"> 列表 </label>
                                            <label>
                                            <input type="checkbox" value="4"> 搜索 </label>
                                    </div>
                                </div>
                            </div> <!--
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input class="btn btn-primary" type="button"  id="submit"  value="保存">
                                    <a  class="btn btn-white"  href="/index.php/admin/mould/columns">取消</a>
                                </div>
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <script src="/static/H+ v4.1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/H+ v4.1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/H+ v4.1/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/static/js/common.js"></script>
 
    <script src="/static/H+ v4.1/js/content.min.js?v=1.0.0"></script>
    <script src="/static/H+ v4.1/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
</body>
<!-- Mirrored from www.zi-han.net/theme/hplus/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:15 GMT -->
</html>
