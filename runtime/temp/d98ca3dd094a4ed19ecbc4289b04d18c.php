<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"D:\otherWeb\base\public/../application/admin\view\menu\columns.html";i:1501234679;s:68:"D:\otherWeb\base\public/../application/admin\view\public\header.html";i:1501204505;s:68:"D:\otherWeb\base\public/../application/admin\view\public\footer.html";i:1501204646;}*/ ?>
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
  
    <link href="/static/H+ v4.1/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
</head>
<body class="gray-bg">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>菜单管理</h5>
            </div>
            <div class="ibox-content">
                <div class="row row-lg">
                    <div class="col-sm-12">
                        <h4 class="example-title"> <a   class="btn btn-outline btn-default "  href="/index.php/admin/menu/put">新增</a></h4>
                        <div class="example">
                            <table data-toggle="table"  >
                                <thead>
                                    <tr>
                                        <th >ID</th>
                                        <th >名称</th>
                                        <th >地址</th>
                                        <th >图标</th>
                                        <th class="col-sm-1">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!(empty($data['list']) || (($data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator ) && $data['list']->isEmpty()))): if(is_array($data['list']) || $data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <td><?php echo $vo['id']; ?></td>
                                        <td><?php echo $vo['name']; ?></td>
                                         <td><?php echo $vo['address']; ?></td>
                                         <td><?php echo $vo['fa']; ?></td>
                                        <td >
                                            <a   class="btn btn-outline btn-default btn-xs "  href="/index.php/admin/menu/update?id=<?php echo $vo['id']; ?>">修改</a>
                                            <button type="button" class="btn btn-outline btn-default btn-xs ">删除</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Panel Basic -->
       <script src="/static/H+ v4.1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/H+ v4.1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/H+ v4.1/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/static/js/common.js"></script>
 
    <script src="/static/H+ v4.1/js/content.min.js?v=1.0.0"></script>
    <script src="/static/H+ v4.1/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="/static/H+ v4.1/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="/static/H+ v4.1/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>


</body>
<!-- Mirrored from www.zi-han.net/theme/hplus/table_bootstrap.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:06 GMT -->
</html>
