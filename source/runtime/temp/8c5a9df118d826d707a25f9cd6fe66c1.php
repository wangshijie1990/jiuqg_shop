<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:92:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/wxapp/page/links.php";i:1560414054;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;}*/ ?>
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
            <div class="widget am-cf">
                <div class="widget-body">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">页面链接</div>
                    </div>
                    <div class="link-list">
                        <ul class="">
                            <li class="link-item">
                                <div class="row page-name">商城首页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/index/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">自定义页面</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/custom/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">page_id</span>
                                            <span>页面ID</span>
                                            <span class="x-color-red">　--必填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/custom/index?page_id=10001</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">商品分类页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/category/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">商品列表页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/category/list</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">category_id</span>
                                            <span>商品分类ID</span>
                                            <span class="">　--选填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/category/list?category_id=10001</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">商品详情页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/goods/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">goods_id</span>
                                            <span>商品ID</span>
                                            <span class="x-color-red">　--必填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/goods/index?goods_id=10001</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">商品搜索页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/search/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">购物车页面</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/flow/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">个人中心页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/user/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">订单列表页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/order/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">dataType</span>
                                            <span>订单类型 ( </span>
                                            <span class="x-color-green">all</span>
                                            <span>全部，</span>
                                            <span class="x-color-green">payment</span>
                                            <span>已付款，</span>
                                            <span class="x-color-green">delivery</span>
                                            <span>待发货，</span>
                                            <span class="x-color-green">received</span>
                                            <span>待收货</span>
                                            <span>)</span>
                                            <span class="">　--选填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/order/index?dataType=all</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">分销中心页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/dealer/index/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">领券中心页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/coupon/coupon</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">我的优惠券页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/user/coupon/coupon</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">拼团 - 拼团首页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/sharing/index/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">拼团 - 商品详情页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/sharing/goods/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">goods_id</span>
                                            <span>拼团商品ID</span>
                                            <span class="x-color-red">　--必填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/sharing/goods/index?goods_id=10001</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">拼团 - 拼单详情页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/sharing/active/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">active_id</span>
                                            <span>拼单ID</span>
                                            <span class="x-color-red">　--必填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/sharing/active/index?active_id=10001</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">文章列表页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/article/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">文章详情</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/article/detail/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">article_id</span>
                                            <span>文章ID</span>
                                            <span class="x-color-red">　--必填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/article/detail/index?article_id=10001</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">门店详情页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/shop/detail/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">shop_id</span>
                                            <span>门店ID</span>
                                            <span class="x-color-red">　--必填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/shop/detail/index?shop_id=10001</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">砍价活动 - 首页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/bargain/index/index</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">砍价活动 - 我的砍价</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/bargain/index/index?tab=1</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">砍价活动 - 活动商品页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/bargain/goods/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">active_id</span>
                                            <span>活动ID</span>
                                            <span class="x-color-red">　--必填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/bargain/goods/index?active_id=10001</span>
                                    </div>
                                </div>
                            </li>
                            <li class="link-item">
                                <div class="row page-name">砍价活动 - 砍价记录详情页</div>
                                <div class="row am-cf">
                                    <div class="am-fl">地址：</div>
                                    <div class="am-fl">
                                        <span class="x-color-green">pages/bargain/task/index</span>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">参数：</div>
                                    <div class="am-fl">
                                        <p class="param">
                                            <span class="x-color-green">task_id</span>
                                            <span>砍价记录ID</span>
                                            <span class="x-color-red">　--必填</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row am-cf">
                                    <div class="am-fl">例如：</div>
                                    <div class="am-fl">
                                        <span class="x-color-c-gray-5f">pages/bargain/task/index?task_id=10001</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
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
