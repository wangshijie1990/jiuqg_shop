<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:92:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/market/push/send.php";i:1560414034;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;}*/ ?>
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
        <div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div id="app" class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">发送推送消息</div>
                            </div>
                            <div class="tips am-margin-bottom am-u-sm-12">
                                <div class="pre">
                                    <p>
                                        注：模板消息只能发送给活跃用户，<a href="<?= url('market.push/user') ?>" target="_blank">查看活跃用户列表</a>，建议每次发送不超过10人。
                                    </p>
                                    <p>注：根据腾讯官方规定，滥用模板消息接口有被封号的风险，请谨慎使用！</p>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-3 am-form-label form-require">用户ID </label>
                                <div class="am-u-sm-8 am-u-end">
                                    <input type="text" class="tpl-form-input" name="send[user_id]"
                                           value="" placeholder="请输入用户ID" required>
                                    <small>如需发送多个用户，请使用英文逗号 <code>,</code> 隔开；例如：10001,10002</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-3 am-form-label form-require">
                                    模板消息ID <span class="tpl-form-line-small-title">Template ID</span>
                                </label>
                                <div class="am-u-sm-8 am-u-end">
                                    <input type="text" class="tpl-form-input" name="send[template_id]"
                                           value="" placeholder="请输入模板消息ID" required>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= url('store/setting.help/tplmsg') ?>"
                                           target="_blank">如何获取模板消息ID？</a>
                                    </small>
                                </div>
                            </div>
                            <div class="am-form-group am-padding-top">
                                <label class="am-u-sm-3 am-u-lg-3 am-form-label"> 模板内容1 </label>
                                <div class="am-u-sm-8 am-u-end">
                                    <input type="text" class="tpl-form-input" name="send[content][]"
                                           value="" placeholder="请输入模板消息第1行的内容" required>
                                </div>
                            </div>

                            <?php $limit = !!$request->param('more') ? 10 : 5; for ($i = 2; $i <= $limit; $i++): ?>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-3 am-form-label"> 模板内容<?= $i ?> </label>
                                    <div class="am-u-sm-8 am-u-end">
                                        <input type="text" class="tpl-form-input" name="send[content][]"
                                               value="" placeholder="请输入模板消息第<?= $i ?>行的内容（没有则不填）">
                                    </div>
                                </div>
                            <?php endfor; ?>

                            <div class="am-form-group am-padding-top">
                                <label class="am-u-sm-3 am-u-lg-3 am-form-label form-require"> 跳转的页面</label>
                                <div class="am-u-sm-8 am-u-end">
                                    <input type="text" class="tpl-form-input" name="send[page]"
                                           value="pages/index/index" placeholder="请输入小程序页面地址" required>
                                    <small class="am-margin-left-xs">
                                        <span>用户点击消息进入的<a href="<?= url('store/wxapp.page/links') ?>" target="_blank">小程序页面</a>，例如：<code>pages/index/index</code></span>
                                    </small>
                                </div>
                            </div>

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
</div>

<script>
    $(function () {

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
            success: function (result) {
                var content = '';
                result.data['stateSet'].forEach(function (value) {
                    content += '<p>' + value + '</p>';
                });
                $.showModal({
                    title: '发送状态'
                    , closeBtn: 0
                    , area: '440px'
                    , btn: ['确定']
                    , btnAlign: 'c'
                    , content: '<div class="am-padding x-f-13">' + content + '</div>'
                    , yes: function () {
                        // window.location.reload();
                        return true;
                    }
                });


            }
        });

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
