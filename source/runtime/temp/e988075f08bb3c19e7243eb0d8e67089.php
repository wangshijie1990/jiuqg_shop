<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:100:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/apps/sharing/order/index.php";i:1561430090;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;}*/ ?>
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
        <?php

use app\common\enum\DeliveryType as DeliveryTypeEnum;

?>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">拼团订单列表</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form id="form-search" class="toolbar-form" action="">
                            <input type="hidden" name="s" value="/<?= $request->pathinfo() ?>">
                            <input type="hidden" name="active_id" value="<?= $request->param('active_id') ?>">
                            <div class="am-u-sm-12 am-u-md-3">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <?php if (checkPrivilege('apps.sharing.order.operate/export')): ?>
                                                <a class="j-export am-btn am-btn-success am-radius"
                                                   href="javascript:void(0);">
                                                    <i class="iconfont icon-daochu am-margin-right-xs"></i>订单导出
                                                </a>
                                            <?php endif; if (checkPrivilege('apps.sharing.order.operate/batchdelivery')): ?>
                                                <a class="j-export am-btn am-btn-secondary am-radius"
                                                   href="<?= url('apps.sharing.order.operate/batchdelivery') ?>">
                                                    <i class="iconfont icon-daoru am-margin-right-xs"></i>批量发货
                                                </a>
                                            <?php endif; if (checkPrivilege('apps.sharing.order.operate/batchtransfer')): ?>
                                                <a class="j-export am-btn am-btn-secondary am-radius"
                                                   href="<?= url('apps.sharing.order.operate/batchtransfer') ?>">
                                                    <i class="iconfont icon-daoru am-margin-right-xs"></i>批量配送
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="am-u-sm-12 am-u-md-9">
                                <div class="am fr">
                                    <div class="am-form-group am-fl">
                                        <?php $dataType = $request->get('dataType'); ?>
                                        <select name="dataType"
                                                data-am-selected="{btnSize: 'sm', placeholder: '订单状态'}">
                                            <option value=""></option>
                                            <option value="all"
                                                <?= $dataType === 'all' ? 'selected' : '' ?>>全部
                                            </option>
                                            <option value="pay"
                                                <?= $dataType === 'pay' ? 'selected' : '' ?>>待付款
                                            </option>
                                            <option value="sharing"
                                                <?= $dataType === 'sharing' ? 'selected' : '' ?>>拼团中
                                            </option>
                                            <option value="sharing_succeed"
                                                <?= $dataType === 'sharing_succeed' ? 'selected' : '' ?>>拼团成功
                                            </option>
                                            <option value="sharing_fail"
                                                <?= $dataType === 'sharing_fail' ? 'selected' : '' ?>>拼团失败
                                            </option>
                                            <option value="delivery"
                                                <?= $dataType === 'delivery' ? 'selected' : '' ?>>待发货
                                            </option>
                                            <option value="transfer"
                                                <?= $dataType === 'transfer' ? 'selected' : '' ?>>未配送
                                            </option>
                                            <option value="receipt"
                                                <?= $dataType === 'receipt' ? 'selected' : '' ?>>待收货
                                            </option>
                                            <option value="complete"
                                                <?= $dataType === 'complete' ? 'selected' : '' ?>>已完成
                                            </option>
                                            <option value="cancel"
                                                <?= $dataType === 'cancel' ? 'selected' : '' ?>>已取消
                                            </option>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <?php $deliveryType = $request->get('delivery_type'); ?>
                                        <select name="delivery_type"
                                                data-am-selected="{btnSize: 'sm', placeholder: '配送方式'}">
                                            <option value=""></option>
                                            <option value="-1"
                                                <?= $deliveryType === '-1' ? 'selected' : '' ?>>全部
                                            </option>
                                            <?php foreach (DeliveryTypeEnum::data() as $item): ?>
                                                <option value="<?= $item['value'] ?>"
                                                    <?= $item['value'] == $deliveryType ? 'selected' : '' ?>><?= $item['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <?php $extractShopId = $request->get('extract_shop_id'); ?>
                                        <select name="extract_shop_id"
                                                data-am-selected="{btnSize: 'sm', placeholder: '自提门店名称'}">
                                            <option value=""></option>
                                            <option value="-1"
                                                <?= $extractShopId === '-1' ? 'selected' : '' ?>>全部
                                            </option>
                                            <?php if (isset($shopList)): foreach ($shopList as $item): ?>
                                                <option value="<?= $item['shop_id'] ?>"
                                                    <?= $item['shop_id'] == $extractShopId ? 'selected' : '' ?>><?= $item['shop_name'] ?>
                                                </option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                    <div class="am-form-group tpl-form-border-form am-fl">
                                        <input type="text" name="start_time"
                                               class="am-form-field"
                                               value="<?= $request->get('start_time') ?>" placeholder="请选择起始日期"
                                               data-am-datepicker>
                                    </div>
                                    <div class="am-form-group tpl-form-border-form am-fl">
                                        <input type="text" name="end_time"
                                               class="am-form-field"
                                               value="<?= $request->get('end_time') ?>" placeholder="请选择截止日期"
                                               data-am-datepicker>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                            <input type="text" class="am-form-field" name="search"
                                                   placeholder="请输入订单号/用户昵称" value="<?= $request->get('search') ?>">
                                            <div class="am-input-group-btn">
                                                <button class="am-btn am-btn-default am-icon-search"
                                                        type="submit"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="order-list am-scrollable-horizontal am-u-sm-12 am-margin-top-xs">
                        <table width="100%" class="am-table am-table-centered
                        am-text-nowrap am-margin-bottom-xs">
                            <thead>
                            <tr>
                                <th width="20%" class="goods-detail">商品信息</th>
                                <th>订单类型</th>
                                <th width="10%">单价/数量</th>
                                <th width="10%">实付款</th>
                                <th>买家</th>
                                <th>支付方式</th>
                                <th>配送方式</th>
                                <th>交易状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $colspan = 9; if (!$list->isEmpty()): foreach ($list as $order): ?>
                                <tr class="order-empty">
                                    <td colspan="<?= $colspan ?>"></td>
                                </tr>
                                <tr>
                                    <td class="am-text-middle am-text-left" colspan="<?= $colspan ?>">
                                        <span class="am-margin-right-lg"> <?= $order['create_time'] ?></span>
                                        <span class="am-margin-right-lg">订单号：<?= $order['order_no'] ?></span>
                                    </td>
                                </tr>
                                <?php $i = 0;
                                foreach ($order['goods'] as $goods): $i++; ?>
                                    <tr>
                                        <td class="goods-detail am-text-middle">
                                            <div class="goods-image">
                                                <img src="<?= $goods['image']['file_path'] ?>" alt="">
                                            </div>
                                            <div class="goods-info">
                                                <p class="goods-title"><?= $goods['goods_name'] ?></p>
                                                <p class="goods-spec am-link-muted"><?= $goods['goods_attr'] ?></p>
                                            </div>
                                        </td>
                                        <td class="am-text-middle">
                                            <?php if ($order['order_type']['value'] == 10): ?>
                                                <span class="am-badge am-badge-secondary">
                                                <?= $order['order_type']['text'] ?>
                                            </span>
                                            <?php else: ?>
                                                <span class="am-badge am-badge-success">
                                                <?= $order['order_type']['text'] ?>
                                            </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="am-text-middle">
                                            <p>￥<?= $goods['goods_price'] ?></p>
                                            <p>×<?= $goods['total_num'] ?></p>
                                        </td>
                                        <?php if ($i === 1) : $goodsCount = count($order['goods']); ?>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <p>￥<?= $order['pay_price'] ?></p>
                                                <p class="am-link-muted">(含运费：￥<?= $order['express_price'] ?>)</p>
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <p><?= $order['user']['nickName'] ?></p>
                                                <p class="am-link-muted">(用户id：<?= $order['user']['user_id'] ?>)</p>
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <span class="am-badge am-badge-secondary"><?= $order['pay_type']['text'] ?></span>
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <span class="am-badge am-badge-secondary"><?= $order['delivery_type']['text'] ?></span>
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <p>付款状态：
                                                    <span class="am-badge
                                                <?= $order['pay_status']['value'] == 20 ? 'am-badge-success' : '' ?>">
                                                        <?= $order['pay_status']['text'] ?></span>
                                                </p>
                                                <?php if (
                                                    $order['pay_status']['value'] == 20
                                                    && $order['order_type']['value'] == 20
                                                ): ?>
                                                    <p>拼单状态：
                                                        <?php if (
                                                            $order['active']['status']['value'] == 0
                                                            || $order['active']['status']['value'] == 10
                                                        ): ?>
                                                            <span class="am-badge"><?= $order['active']['status']['text'] ?></span>
                                                        <?php elseif ($order['active']['status']['value'] == 20): ?>
                                                            <span class="am-badge am-badge-success"><?= $order['active']['status']['text'] ?></span>
                                                        <?php elseif ($order['active']['status']['value'] == 30): ?>
                                                            <span class="am-badge am-badge-danger"><?= $order['active']['status']['text'] ?></span>
                                                        <?php endif; ?>
                                                    </p>
                                                    <!--拼团失败：退款设置-->
                                                    <?php if ($order['active']['status']['value'] == 30): ?>
                                                        <p>退款状态：
                                                            <?php if (!$order['is_refund']): ?>
                                                                <span class="am-badge">待退款</span>
                                                            <?php else: ?>
                                                                <span class="am-badge am-badge-success">已退款</span>
                                                            <?php endif; ?>
                                                        </p>
                                                    <?php endif; endif; ?>
                                                <!-- 拼单不成功不显示发货和收货状态 -->
                                                <?php if (
                                                    $order['order_type']['value'] == 10
                                                    || (
                                                        $order['order_type']['value'] == 20
                                                        && $order['active']['status']['value'] == 20
                                                    )
                                                ): if($order['extract_shop_id']==0):?>
                                                    <p>发货状态：
                                                        <span class="am-badge
                                                <?= $order['delivery_status']['value'] == 20 ? 'am-badge-success' : '' ?>">
                                                        <?= $order['delivery_status']['text'] ?></span>
                                                    </p>
                                                <?php endif; if($order['extract_shop_id']>0):?>
                                                    <p>配送状态：
                                                        <span class="am-badge
                                                <?= $order['transfer_status'] == 20 ? 'am-badge-success' : '' ?>">
                                                        <?= $order['transfer_status'] == 20?'已配送':'未配送' ?></span>
                                                    </p>
                                                <?php endif; ?>
                                                    <p>收货状态：
                                                        <span class="am-badge
                                                <?= $order['receipt_status']['value'] == 20 ? 'am-badge-success' : '' ?>">
                                                        <?= $order['receipt_status']['text'] ?></span>
                                                    </p>
                                                <?php endif; if ($order['order_status']['value'] == 20 || $order['order_status']['value'] == 21): ?>
                                                    <p>订单状态：
                                                        <span class="am-badge am-badge-warning"><?= $order['order_status']['text'] ?></span>
                                                    </p>
                                                <?php endif; ?>
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <div class="tpl-table-black-operation">
                                                    <!-- 拼团信息-->
                                                    <?php if (
                                                        $order['order_type']['value'] == 20
                                                        && $order['pay_status']['value']
                                                        && $order['active_id'] > 0
                                                    ): if (checkPrivilege('apps.sharing.active/index')): ?>
                                                            <a class="tpl-table-black-operation-default"
                                                               href="<?= url('apps.sharing.active/index', ['active_id' => $order['active_id']]) ?>">
                                                                拼团信息</a>
                                                        <?php endif; endif; ?>
                                                    <!-- 订单详情-->
                                                    <?php if (checkPrivilege('apps.sharing.order/detail')): ?>
                                                        <a class="tpl-table-black-operation-default"
                                                           href="<?= url('apps.sharing.order/detail', ['order_id' => $order['order_id']]) ?>">
                                                            订单详情</a>
                                                    <?php endif; ?>
                                                    <!-- 去发货-->
                                                    <?php if (checkPrivilege(['apps.sharing.order/detail', 'apps.sharing.order/delivery'])): if (
                                                            // 判断订单状态是否满足发货条件
                                                            $order['extract_shop_id']==0
                                                            && $order['pay_status']['value'] == 20
                                                            && $order['order_status']['value'] != 20
                                                            && $order['order_status']['value'] != 21
                                                            && $order['delivery_status']['value'] == 10
                                                            // 拼团订单验证拼单状态
                                                            && ($order['order_type']['value'] == 20 ? $order['active']['status']['value'] == 20 : true)
                                                        ): ?>
                                                            <a class="tpl-table-black-operation"
                                                               href="<?= url('apps.sharing.order/detail#delivery',
                                                                   ['order_id' => $order['order_id']]) ?>">去发货</a>
                                                        <?php endif; endif; ?>
                                                    <!-- 去配送-->
                                                    <?php if (checkPrivilege(['apps.sharing.order/detail', 'apps.sharing.order/transfer'])): if (
                                                            // 判断订单状态是否满足配送条件
                                                            $order['extract_shop_id']>0
                                                            && $order['transfer_status']==10
                                                            && $order['pay_status']['value'] == 20
                                                            && $order['order_status']['value'] != 20
                                                            && $order['order_status']['value'] != 21
                                                            && $order['delivery_status']['value'] == 10
                                                            // 拼团订单验证拼单状态
                                                            && ($order['order_type']['value'] == 20 ? $order['active']['status']['value'] == 20 : true)
                                                        ): ?>
                                                            <a class="tpl-table-black-operation"
                                                               href="<?= url('apps.sharing.order/detail#transfer',
                                                                   ['order_id' => $order['order_id']]) ?>">去配送</a>
                                                        <?php endif; endif; ?>
                                                    <!-- 审核用户申请取消订单-->
                                                    <?php if (checkPrivilege(['apps.sharing.order/detail', 'apps.sharing.order.operate/confirmcancel'])): if ($order['order_status']['value'] == 21): ?>
                                                            <a class="tpl-table-black-operation-del"
                                                               href="<?= url('apps.sharing.order/detail#cancel',
                                                                   ['order_id' => $order['order_id']]) ?>">去审核</a>
                                                        <?php endif; endif; ?>
                                                    <!-- 拼团失败手动退款-->
                                                    <?php if (checkPrivilege('apps.sharing.order.operate/refund')): if (
                                                            $order['order_type']['value'] == 20
                                                            && $order['pay_status']['value'] == 20
                                                            && $order['active']['status']['value'] == 30
                                                            && $order['is_refund'] == 0
                                                        ): ?>
                                                            <a class="tpl-table-black-operation-del"
                                                               href="<?= url('apps.sharing.order/detail#refund',
                                                                   ['order_id' => $order['order_id']]) ?>">去退款</a>
                                                        <?php endif; endif; ?>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; endforeach; else: ?>
                                <tr>
                                    <td colspan="<?= $colspan ?>" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr"><?= $list->render() ?> </div>
                        <div class="am-fr pagination-total am-margin-right">
                            <div class="am-vertical-align-middle">总记录：<?= $list->total() ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(function () {

        /**
         * 订单导出
         */
        $('.j-export').click(function () {
            var data = {};
            var formData = $('#form-search').serializeArray();
            $.each(formData, function () {
                this.name !== 's' && (data[this.name] = this.value);
            });
            window.location = "<?= url('apps.sharing.order.operate/export') ?>" + '&' + $.urlEncode(data);
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
