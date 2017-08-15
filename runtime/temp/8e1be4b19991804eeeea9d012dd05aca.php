<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"D:\git\base\public/../application/admin\view\mould\set.html";i:1502787795;s:63:"D:\git\base\public/../application/admin\view\public\header.html";i:1502696081;s:63:"D:\git\base\public/../application/admin\view\public\footer.html";i:1502174942;}*/ ?>
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
    <link href="/static/H+ v4.1/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <script src="/static/H+ v4.1/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/H+ v4.1/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/H+ v4.1/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/static/js/common.js"></script>
 
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> 新增</a>
                        </li>
                        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">修改</a>
                        </li>
                        <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="true"> 列表</a>
                        </li>
                        <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">搜索</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th>顺序</th>
                                        <th>名称</th>
                                        <th>字段</th>
                                        <th>类型</th>
                                        <th>值</th>
                                        <th>验证</th>
                                        <th>显示</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php if(is_array($data['info']['add']) || $data['info']['add'] instanceof \think\Collection || $data['info']['add'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['info']['add'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <td><?php echo $key; ?></td>
                                        <td><?php echo $data["fileds"][$key]['title']; ?></td>
                                         <td><?php echo $data["fileds"][$key]['filed']; ?></td>
                                         <td><?php echo $data["fileds"][$key]['type']; ?></td>
                                         <td><?php echo $data["fileds"][$key]['value']; ?></td>
                                        <td>
                                            <div class="col-sm-10">
                                             <?php if(is_array($validate) || $validate instanceof \think\Collection || $validate instanceof \think\Paginator): $i = 0; $__LIST__ = $validate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?>
                                            <label class="checkbox-inline">
                                            <input type="checkbox" value="option1" id="inlineCheckbox1" value="<?php echo $key; ?>"><?php echo $vo2[0]; ?></label>
                                             <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                        <select class="m-b" name="">
                                        <option value="1">是</option>
                                        <option value="2">否</option>
                                        </select>
                                        </td>
                                        <td>
                                            <a  class="btn btn-outline btn-default btn-xs "  href="">移除</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">





                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <strong>修改</strong>
                                <p>在 Bootstrap 2 中，我们对框架中的某些关键部分增加了对移动设备友好的样式。而在 Bootstrap 3 中，我们重写了整个框架，使其一开始就是对移动设备友好的。这次不是简单的增加一些可选的针对移动设备的样式，而是直接融合进了框架的内核中。也就是说，Bootstrap 是移动设备优先的。针对移动设备的样式融合进了框架的每个角落，而不是增加一个额外的文件。</p>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">
                                <strong>修改</strong>
                                <p>在 Bootstrap 2 中，我们对框架中的某些关键部分增加了对移动设备友好的样式。而在 Bootstrap 3 中，我们重写了整个框架，使其一开始就是对移动设备友好的。这次不是简单的增加一些可选的针对移动设备的样式，而是直接融合进了框架的内核中。也就是说，Bootstrap 是移动设备优先的。针对移动设备的样式融合进了框架的每个角落，而不是增加一个额外的文件。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

 
    <script src="/static/H+ v4.1/js/content.min.js?v=1.0.0"></script>
</body>
<!-- Mirrored from www.zi-han.net/theme/hplus/tabs_panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:53 GMT -->
</html>
