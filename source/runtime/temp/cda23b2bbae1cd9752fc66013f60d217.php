<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:95:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/admin/view/setting/cache/clear.php";i:1560413922;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/admin/view/layouts/layout.php";i:1560413921;}*/ ?>
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
            <form id="my-form" class="am-form tpl-form-line-form" enctype="multipart/form-data" method="post">
                <div class="widget-body">
                    <fieldset>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">清理缓存</div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label form-require">
                                缓存项
                            </label>
                            <div class="am-u-sm-9">
                                <label class="am-checkbox-inline">
                                    <input type="checkbox" name="cache[item][]" value="data"
                                           data-am-ucheck checked required>
                                    数据缓存
                                </label>
                                <label class="am-checkbox-inline">
                                    <input type="checkbox" name="cache[item][]" value="temp"
                                           data-am-ucheck checked required>
                                    临时图片
                                </label>
                            </div>
                        </div>
                        <?php if (isset($isForce) && $isForce === true): ?>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 强制模式 </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="cache[isForce]" value="0" checked
                                               data-am-ucheck>
                                        否
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="cache[isForce]" value="1" data-am-ucheck>
                                        是
                                    </label>
                                    <div class="help-block">
                                        <small class="x-color-red">此操作将会强制清空所有缓存文件，包含用户授权登录状态、用户购物车数据，仅允许在开发环境中使用
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <small>
                                        <a href="<?= url('', ['isForce' => true]) ?>">
                                            进入强制模式</a>
                                    </small>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

    });
</script>

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
