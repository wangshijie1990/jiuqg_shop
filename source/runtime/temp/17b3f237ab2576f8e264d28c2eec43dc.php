<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:95:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/wxapp/page/category.php";i:1560414054;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title><?= $setting['store']['values']['name'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="assets/common/i/favicon.ico"/>
    <meta name="apple-mobile-web-app-title" content="<?= $setting['store']['values']['name'] ?>"/>
    <link rel="stylesheet" href="assets/common/css/amazeui.min.css"/>
    <link rel="stylesheet" href="assets/store/css/app.css?v=<?= $version ?>"/>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_783249_2lw7e3x57vx.css">
    <script src="assets/common/js/jquery.min.js"></script>
    <script src="//at.alicdn.com/t/font_783249_e5yrsf08rap.js"></script>
    <script>
        BASE_URL = '<?= isset($base_url) ? $base_url : '' ?>';
        STORE_URL = '<?= isset($store_url) ? $store_url : '' ?>';
    </script>
</head>

<body data-type="">
<div class="am-g tpl-g">
    <!-- 头部 -->
    <header class="tpl-header">
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 侧边切换 -->
            <div class="am-fl tpl-header-button switch-button">
                <i class="iconfont icon-menufold"></i>
            </div>
            <!-- 刷新页面 -->
            <div class="am-fl tpl-header-button refresh-button">
                <i class="iconfont icon-refresh"></i>
            </div>
            <!-- 其它功能-->
            <div class="am-fr tpl-header-navbar">
                <ul>
                    <!-- 欢迎语 -->
                    <li class="am-text-sm tpl-header-navbar-welcome">
                        <a href="<?= url('store.user/renew') ?>">欢迎你，<span><?= $store['user']['user_name'] ?></span>
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
    <!-- 侧边导航栏 -->
    <div class="left-sidebar dis-flex">
        <?php $menus = $menus ?: []; $group = $group ?: 0; ?>
        <!-- 一级菜单 -->
        <ul class="sidebar-nav">
            <li class="sidebar-nav-heading"><?= $setting['store']['values']['name'] ?></li>
            <?php foreach ($menus as $key => $item): ?>
                <li class="sidebar-nav-link">
                    <a href="<?= isset($item['index']) ? url($item['index']) : 'javascript:void(0);' ?>"
                       class="<?= $item['active'] ? 'active' : '' ?>">
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
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- 子级菜单-->
        <?php $second = isset($menus[$group]['submenu']) ? $menus[$group]['submenu'] : []; if (!empty($second)) : ?>
            <ul class="left-sidebar-second">
                <li class="sidebar-second-title"><?= $menus[$group]['name'] ?></li>
                <li class="sidebar-second-item">
                    <?php foreach ($second as $item) : if (!isset($item['submenu'])): ?>
                            <!-- 二级菜单-->
                            <a href="<?= url($item['index']) ?>"
                               class="<?= (isset($item['active']) && $item['active']) ? 'active' : '' ?>">
                                <?= $item['name']; ?>
                            </a>
                        <?php else: ?>
                            <!-- 三级菜单-->
                            <div class="sidebar-third-item">
                                <a href="javascript:void(0);"
                                   class="sidebar-nav-sub-title <?= $item['active'] ? 'active' : '' ?>">
                                    <i class="iconfont icon-caret"></i>
                                    <?= $item['name']; ?>
                                </a>
                                <ul class="sidebar-third-nav-sub">
                                    <?php foreach ($item['submenu'] as $third) : ?>
                                        <li>
                                            <a class="<?= $third['active'] ? 'active' : '' ?>"
                                               href="<?= url($third['index']) ?>">
                                                <?= $third['name']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; endforeach; ?>
                </li>
            </ul>
        <?php endif; ?>
    </div>

    <!-- 内容区域 start -->
    <div class="tpl-content-wrapper <?= empty($second) ? 'no-sidebar-second' : '' ?>">
        <style>
    .img__category_style {
        width: 100%;
        box-shadow: 0 3px 10px #dcdcdc;
    }
</style>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">分类页模板</div>
                            </div>
                            <div class="wrapper am-container">
                                <div class="left-style am-u-sm-12 am-u-md-12 am-u-lg-4">
                                    <img class="img__category_style"
                                         src="assets/store/img/category_tpl/<?= $model['category_style'] ?>.png?v=<?= $version ?>">
                                </div>
                                <div class="right-form am-u-sm-12 am-u-md-12 am-u-lg-8">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require"> 分类页样式 </label>
                                        <div class="am-u-sm-9">
                                            <label class="am-radio-inline">
                                                <input type="radio" name="category[category_style]" value="10"
                                                       data-am-ucheck
                                                    <?= $model['category_style'] == 10 ? 'checked' : '' ?>
                                                       required>
                                                一级分类 (大图)
                                            </label>
                                            <label class="am-radio-inline">
                                                <input type="radio" name="category[category_style]" value="11"
                                                       data-am-ucheck
                                                    <?= $model['category_style'] == 11 ? 'checked' : '' ?>>
                                                一级分类 (小图)
                                            </label>
                                            <label class="am-radio-inline">
                                                <input type="radio" name="category[category_style]" value="20"
                                                       data-am-ucheck
                                                    <?= $model['category_style'] == 20 ? 'checked' : '' ?>>
                                                二级分类
                                            </label>
                                            <div class="help__style help-block am-margin-top-xs">
                                                <small class="<?= $model['category_style'] == 10 ? '' : 'hide' ?>"
                                                       data-value="10">分类图尺寸：宽750像素 高度不限
                                                </small>
                                                <small class="<?= $model['category_style'] == 11 ? '' : 'hide' ?>"
                                                       data-value="11">分类图尺寸：宽188像素 高度不限
                                                </small>
                                                <small class="<?= $model['category_style'] == 20 ? '' : 'hide' ?>"
                                                       data-value="20">分类图尺寸：宽150像素 高150像素
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require"> 分享标题 </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" name="category[share_title]"
                                                   value="<?= $model['share_title'] ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                            <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {

        // 当前版本号
        var version = '<?= $version ?>';

        // 切换分类样式图
        var $imgCategorystyle = $('.img__category_style');
        var $helpStyleSmall = $('.help__style').find('small');
        $("input[name='category[category_style]']").change(function (e) {
            var styleValue = e.currentTarget.value;
            $helpStyleSmall.hide().filter('[data-value=' + styleValue + ']').show();
            $imgCategorystyle.attr('src', 'assets/store/img/category_tpl/' + styleValue + '.png?v=' + version);
        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

    });
</script>

    </div>
    <!-- 内容区域 end -->

</div>
<script src="assets/common/plugins/layer/layer.js"></script>
<script src="assets/common/js/jquery.form.min.js"></script>
<script src="assets/common/js/amazeui.min.js"></script>
<script src="assets/common/js/webuploader.html5only.js"></script>
<script src="assets/common/js/art-template.js"></script>
<script src="assets/store/js/app.js?v=<?= $version ?>"></script>
<script src="assets/store/js/file.library.js?v=<?= $version ?>"></script>
</body>

</html>
