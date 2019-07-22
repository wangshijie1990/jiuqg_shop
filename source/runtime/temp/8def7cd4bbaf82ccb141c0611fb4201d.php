<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:97:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/admin/view/setting/science/index.php";i:1560413922;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/admin/view/layouts/layout.php";i:1560413921;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>运营管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="assets/common/i/favicon.ico"/>
    <meta name="apple-mobile-web-app-title" content="运营管理系统"/>
    <link rel="stylesheet" href="assets/common/css/amazeui.min.css"/>
    <link rel="stylesheet" href="assets/admin/css/app.css"/>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_783249_c9du3u6ahxp.css">
    <script src="assets/common/js/jquery.min.js"></script>
    <script>
        BASE_URL = '<?= isset($base_url) ? $base_url : '' ?>';
        ADMIN_URL = '<?= isset($admin_url) ? $admin_url : '' ?>';
    </script>
</head>

<body data-type="">
<div class="am-g tpl-g">
    <!-- 头部 -->
    <header class="tpl-header">
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 其它功能-->
            <div class="am-fr tpl-header-navbar">
                <ul>
                    <!-- 欢迎语 -->
                    <li class="am-text-sm tpl-header-navbar-welcome">
                        <a href="<?= url('admin.user/renew') ?>">欢迎你，<span><?= $admin['user']['user_name'] ?></span>
                        </a>
                    </li>
                    <!-- 退出 -->
                    <li class="am-text-sm">
                        <a href="<?= url('passport/logout') ?>">
                            <i class="iconfont icon-tuichu"></i> 退出
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- 内容区域 start -->
    <div class="tpl-content-wrapper dis-flex">
        <!-- 左侧菜单 -->
        <?php $menus = $menus ?: []; $group = $group ?: 0; ?>
        <div class="left-sidebar">
            <ul class="sidebar-nav">
                <?php foreach ($menus as $key => $item): ?>
                    <li class="sidebar-nav-link">
                        <a href="<?= isset($item['index']) ? url($item['index']) : 'javascript:void(0);' ?>"
                           class="sidebar-nav-link-disabled">
                            <?php if (isset($item['is_svg']) && $item['is_svg'] == true): ?>
                                <svg class="icon sidebar-nav-link-logo" aria-hidden="true">
                                    <use xlink:href="#<?= $item['icon'] ?>"></use>
                                </svg>
                            <?php else: ?>
                                <i class="iconfont sidebar-nav-link-logo <?= $item['icon'] ?>"
                                   style="<?= isset($item['color']) ? "color:{$item['color']};" : '' ?>"></i>
                            <?php endif; ?>
                            <?= $item['name'] ?>
                        </a>
                        <!-- 子级菜单-->
                        <?php if (isset($item['submenu']) && !empty($item['submenu'])) : ?>
                            <ul class="sidebar-third-nav-sub">
                                <?php foreach ($item['submenu'] as $second) : ?>
                                    <li class="sidebar-nav-link <?= $second['active'] ? 'active' : '' ?>">
                                        <a class="" href="<?= url($second['index']) ?>">
                                            <?= $second['name'] ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- 内容区域 -->
        <div class="row-content am-cf">
            <div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <form class="am-form tpl-form-line-form">
                <div class="widget-body">
                    <fieldset>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">服务器信息</div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-scrollable-horizontal">
                                <table class="am-table am-table-centered">
                                    <tbody>
                                    <tr>
                                        <th width="30%">参数</th>
                                        <th>值</th>
                                        <th></th>
                                    </tr>
                                    <?php if (isset($server)): foreach ($server as $item): ?>
                                        <tr class="<?= isset($statusClass) ? $statusClass[$item['status']] : '' ?>">
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['value'] ?> </td>
                                            <td><?= $item['status'] !== 'normal' ? $item['remark'] : '' ?> </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">PHP环境要求</div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-scrollable-horizontal">
                                <table class="am-table am-table-centered">
                                    <tbody>
                                    <tr>
                                        <th width="30%">选项</th>
                                        <th>要求</th>
                                        <th>状态</th>
                                        <th></th>
                                    </tr>
                                    <?php if (isset($phpinfo)): foreach ($phpinfo as $item): ?>
                                        <tr class="<?= isset($statusClass) ? $statusClass[$item['status']] : '' ?>">
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['value'] ?> </td>
                                            <td>
                                                <?php if ($item['status'] !== 'danger'): ?>
                                                    <i class="am-icon-check x-color-green"></i>
                                                <?php else: ?>
                                                    <i class="am-icon-times x-color-red"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $item['status'] !== 'normal' ? $item['remark'] : '' ?> </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">目录权限监测</div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-scrollable-horizontal">
                                <table class="am-table am-table-centered">
                                    <tbody>
                                    <tr>
                                        <th width="30%">名称</th>
                                        <th class="am-text-left">路径</th>
                                        <th>状态</th>
                                        <th></th>
                                    </tr>
                                    <?php if (isset($writeable)): foreach ($writeable as $item): ?>
                                        <tr class="<?= isset($statusClass) ? $statusClass[$item['status']] : '' ?>">
                                            <td><?= $item['name'] ?></td>
                                            <td class="am-text-left"><?= $item['value'] ?> </td>
                                            <td>
                                                <?php if ($item['status'] !== 'danger'): ?>
                                                    <i class="am-icon-check x-color-green"></i>
                                                <?php else: ?>
                                                    <i class="am-icon-times x-color-red"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $item['status'] !== 'normal' ? $item['remark'] : '' ?> </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
        </div>

    </div>
    <!-- 内容区域 end -->

    <div class="help-block am-text-center am-padding-sm">
        <small>当前系统版本号：v<?= $version ?></small>
    </div>
</div>
<script src="assets/common/plugins/layer/layer.js"></script>
<script src="assets/common/js/jquery.form.min.js"></script>
<script src="assets/common/js/amazeui.min.js"></script>
<script src="assets/common/js/webuploader.html5only.js"></script>
<script src="assets/common/js/art-template.js"></script>
<script src="assets/admin/js/app.js"></script>
</body>

</html>
