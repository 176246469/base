<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"D:\git\base\public/../application/admin\view\mould\columns.html";i:1502346526;s:63:"D:\git\base\public/../application/admin\view\public\header.html";i:1502174941;s:63:"D:\git\base\public/../application/admin\view\public\footer.html";i:1502174942;}*/ ?>
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
  
    <link href="/static/H+ v4.1/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
</head>
<body class="gray-bg">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>模型管理</h5>
            </div>
            <div class="ibox-content">
                <div class="row row-lg">
                    <div class="col-sm-12">
                        <h4 class="example-title"> <a   class="btn btn-outline btn-default "  href="/index.php/admin/mould/put">新增</a></h4>
                        <div class="example">
                            <table data-toggle="table"  >
                                <thead>
                                    <tr>
                                        <th >ID</th>
                                        <th >名称</th>
                                        <th >表</th>
                                        <th >创建日期</th>
                                        <th class="col-sm-2">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!(empty($data['list']) || (($data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator ) && $data['list']->isEmpty()))): if(is_array($data['list']) || $data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <td><?php echo $vo['id']; ?></td>
                                        <td><?php echo $vo['name']; ?></td>
                                         <td><?php echo $vo['table']; ?></td>
                                         <td><?php echo date("Y-m-d",$vo['ct_time']); ?></td>
                                        <td >
                                            <a  class="btn btn-outline btn-default btn-xs "  href="/index.php/admin/mould/update?id=<?php echo $vo['id']; ?>">管理</a>
                                            <button type="button"  onclick="del('/index.php/admin/mould/del?id=<?php echo $vo['id']; ?>');" class="btn btn-outline btn-default btn-xs ">删除</button>
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
    

 
    <script src="/static/H+ v4.1/js/content.min.js?v=1.0.0"></script>
    <script src="/static/H+ v4.1/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="/static/H+ v4.1/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="/static/H+ v4.1/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
</body>
<!-- Mirrored from www.zi-han.net/theme/hplus/table_bootstrap.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:06 GMT -->
</html>
