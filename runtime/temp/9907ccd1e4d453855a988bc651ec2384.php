<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"D:\git\base\public/../application/admin\view\menu\update.html";i:1501230329;s:63:"D:\git\base\public/../application/admin\view\public\header.html";i:1501204505;s:63:"D:\git\base\public/../application/admin\view\public\footer.html";i:1501204646;}*/ ?>
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
                        <h5>菜单管理 <small>修改</small></h5>
                    </div>
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal" action="/index.php/admin/group/update">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">地址</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address" value="<?php echo $data['address']; ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">图标</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fa" value="<?php echo $data['fa']; ?>">
                                </div>
                            </div>
                             
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">层级</label>
                                <div class="col-sm-10">
                                       <select class="form-control m-b" name="pid">
                                       <option value="0">---顶级---</option>
                                        <?php if(is_array($data['menu']) || $data['menu'] instanceof \think\Collection || $data['menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $vo['info']['id']; ?>"  <?php if($data['pid'] == $vo['info']['id']): ?> checked="checked" <?php endif; ?>  ><?php echo $vo['info']['name']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                          
                            <div class="hr-line-dashed"></div>
                            <input type="hidden" name='id' value="<?php echo $data['id']; ?>">
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input class="btn btn-primary" type="button" id="submit" value="保存">
                                    <a  class="btn btn-white"  href="/index.php/admin/menu/columns">取消</a>
                                </div>
                            </div>
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
</body>
<!-- Mirrored from www.zi-han.net/theme/hplus/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:15 GMT -->
</html>
