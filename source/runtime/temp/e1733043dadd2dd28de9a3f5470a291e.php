<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:95:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/order/refund/detail.php";i:1560414039;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;}*/ ?>
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
                <div class="widget__order-detail widget-body am-margin-bottom-lg">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">售后单信息</div>
                    </div>
                    <div class="am-scrollable-horizontal">
                        <table class="regional-table am-table am-table-bordered am-table-centered
                            am-text-nowrap am-margin-bottom-xs">
                            <tbody>
                            <tr>
                                <th>订单号</th>
                                <th>买家</th>
                                <th>售后类型</th>
                                <th>处理状态</th>
                                <th>操作</th>
                            </tr>
                            <tr>
                                <td><?= $order['order_no'] ?></td>
                                <td>
                                    <p><?= $order['user']['nickName'] ?></p>
                                    <p class="am-link-muted">(用户id：<?= $order['user']['user_id'] ?>)</p>
                                </td>
                                <td class="">
                                    <span class="am-badge am-badge-secondary"> <?= $detail['type']['text'] ?> </span>
                                </td>
                                <td>
                                    <?php if ($detail['status']['value'] == 0): ?>
                                        <!-- 审核状态-->
                                        <p>
                                            <span>商家审核：</span>
                                            <?php if ($detail['is_agree']['value'] == 0): ?>
                                                <span class="am-badge"> <?= $detail['is_agree']['text'] ?> </span>
                                            <?php elseif ($detail['is_agree']['value'] == 10): ?>
                                                <span class="am-badge am-badge-success"> <?= $detail['is_agree']['text'] ?> </span>
                                            <?php elseif ($detail['is_agree']['value'] == 20): ?>
                                                <span class="am-badge am-badge-warning"> <?= $detail['is_agree']['text'] ?> </span>
                                            <?php endif; ?>
                                        </p>
                                        <!-- 发货状态-->
                                        <?php if ($detail['type']['value'] == 10 && $detail['is_agree']['value'] == 10): ?>
                                            <p>
                                                <span>用户发货：</span>
                                                <?php if ($detail['is_user_send'] == 0): ?>
                                                    <span class="am-badge"> 待发货 </span>
                                                <?php else: ?>
                                                    <span class="am-badge am-badge-success"> 已发货 </span>
                                                <?php endif; ?>
                                            </p>
                                        <?php endif; ?>
                                        <!-- 商家收货状态-->
                                        <?php if (
                                            $detail['type']['value'] == 10
                                            && $detail['is_agree']['value'] == 10
                                            && $detail['is_user_send'] == 1
                                            && $detail['is_receipt'] == 0
                                        ): ?>
                                            <p><span>商家收货：</span> <span class="am-badge">待收货</span></p>
                                        <?php endif; elseif ($detail['status']['value'] == 20): ?>
                                        <span class="am-badge am-badge-success"> <?= $detail['status']['text'] ?> </span>
                                    <?php elseif ($detail['status']['value'] == 10 || $detail['status']['value'] == 30): ?>
                                        <span class="am-badge am-badge-warning"> <?= $detail['status']['text'] ?> </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (checkPrivilege('order/detail')): ?>
                                        <a class="x-f-13" target="_blank"
                                           href="<?= url('order/detail', ['order_id' => $detail['order_id']]) ?>">订单详情</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">售后商品信息</div>
                    </div>
                    <div class="am-scrollable-horizontal">
                        <table class="regional-table am-table am-table-bordered am-table-centered
                            am-text-nowrap am-margin-bottom-xs">
                            <tbody>
                            <tr>
                                <th width="25%">商品名称</th>
                                <th>商品编码</th>
                                <th>重量(Kg)</th>
                                <th>单价</th>
                                <th>购买数量</th>
                                <th>付款价</th>
                            </tr>
                            <tr>
                                <td class="goods-detail am-text-middle">
                                    <div class="goods-image">
                                        <img src="<?= $detail['order_goods']['image']['file_path'] ?>" alt="">
                                    </div>
                                    <div class="goods-info">
                                        <p class="goods-title"><?= $detail['order_goods']['goods_name'] ?></p>
                                        <p class="goods-spec am-link-muted">
                                            <?= $detail['order_goods']['goods_attr'] ?>
                                        </p>
                                    </div>
                                </td>
                                <td><?= $detail['order_goods']['goods_no'] ?: '--' ?></td>
                                <td><?= $detail['order_goods']['goods_weight'] ?: '--' ?></td>
                                <td>￥<?= $detail['order_goods']['goods_price'] ?></td>
                                <td>×<?= $detail['order_goods']['total_num'] ?></td>
                                <td><span class="x-color-red">￥<?= $detail['order_goods']['total_pay_price'] ?></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">用户申请原因</div>
                    </div>
                    <div class="apply_desc am-padding-left">
                        <div class="content x-f-13">
                            <span><?= $detail['apply_desc'] ?></span>
                        </div>
                        <div class="images">
                            <div class="uploader-list am-cf">
                                <?php if (!empty($detail['image'])): foreach ($detail['image'] as $image): ?>
                                    <div class="file-item x-mt-10">
                                        <a href="<?= $image['file_path'] ?>"
                                           title="点击查看大图" target="_blank">
                                            <img src="<?= $image['file_path'] ?>">
                                        </a>
                                    </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- 商家审核 -->
                    <?php if (checkPrivilege('order.refund/audit')): if ($detail['is_agree']['value'] == 0): ?>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">商家审核</div>
                            </div>
                            <!-- 去审核 -->
                            <form id="audit" class="my-form am-form tpl-form-line-form" method="post"
                                  action="<?= url('order.refund/audit', ['order_refund_id' => $detail['order_refund_id']]) ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">售后类型 </label>
                                    <div class="am-u-sm-9 am-u-end am-padding-top-xs">
                                        <span class="am-badge am-badge-secondary"> <?= $detail['type']['text'] ?> </span>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">审核状态 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <label class="am-radio-inline">
                                            <input type="radio" name="refund[is_agree]"
                                                   value="10"
                                                   data-am-ucheck
                                                   checked
                                                   required>
                                            同意
                                        </label>
                                        <label class="am-radio-inline">
                                            <input type="radio" name="refund[is_agree]"
                                                   value="20"
                                                   data-am-ucheck>
                                            拒绝
                                        </label>
                                    </div>
                                </div>
                                <div class="item-agree-10 form-tab-group am-form-group active">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">退货地址 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <select name="refund[address_id]"
                                                data-am-selected="{btnSize: 'sm', placeholder:'请选择退货地址', maxHeight: 400}">
                                            <option value=""></option>
                                            <?php if (!empty($address)): foreach ($address as $item): ?>
                                                <option value="<?= $item['address_id'] ?>"><?= $item['name'] ?> <?= $item['phone'] ?> <?= $item['detail'] ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <small class="am-margin-left-xs">
                                            <a href="<?= url('setting.address/index') ?>" target="_blank">去添加</a>
                                        </small>
                                    </div>
                                </div>
                                <div class="item-agree-20 form-tab-group am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">拒绝原因 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                <textarea class="am-field-valid" rows="4" placeholder="请输入拒绝原因"
                                          name="refund[refuse_desc]"></textarea>
                                        <small>如审核状态为拒绝，则需要输入拒绝原因</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <div class="am-u-sm-10 am-u-sm-push-2 am-margin-top-lg">
                                        <button type="submit" class="j-submit am-btn am-btn-sm am-btn-secondary">
                                            确认审核
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php endif; endif; ?>

                    <!-- 退货地址 -->
                    <?php if ($detail['is_agree']['value'] == 10): ?>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">退货地址</div>
                        </div>
                        <div class="am-scrollable-horizontal">
                            <table class="regional-table am-table am-table-bordered am-table-centered
                            am-text-nowrap am-margin-bottom-xs">
                                <tbody>
                                <tr>
                                    <th>收货人</th>
                                    <th>收货电话</th>
                                    <th>收货地址</th>
                                </tr>
                                <tr>
                                    <td><?= $detail['address']['name'] ?></td>
                                    <td><?= $detail['address']['phone'] ?></td>
                                    <td><?= $detail['address']['detail'] ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <!-- 商家拒绝原因 -->
                    <?php if ($detail['is_agree']['value'] == 20): ?>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">商家拒绝原因</div>
                        </div>
                        <div class="apply_desc am-padding-left">
                            <div class="content x-f-13">
                                <span><?= $detail['refuse_desc'] ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 用户发货信息 -->
                    <?php if (
                        $detail['type']['value'] == 10
                        && $detail['is_agree']['value'] == 10
                        && $detail['is_user_send'] == 1
                    ): ?>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">用户发货信息</div>
                        </div>
                        <div class="am-scrollable-horizontal">
                            <table class="am-table am-table-bordered am-table-centered
                                am-text-nowrap am-margin-bottom-xs">
                                <tbody>
                                <tr>
                                    <th>物流公司</th>
                                    <th>物流单号</th>
                                    <th>用户发货状态</th>
                                    <th>发货时间</th>
                                    <th>商家收货状态</th>
                                </tr>
                                <tr>
                                    <td><?= $detail['express']['express_name'] ?></td>
                                    <td><?= $detail['express_no'] ?></td>
                                    <td>
                                        <span class="am-badge am-badge-success">已发货</span>
                                    </td>
                                    <td><?= date('Y-m-d H:i:s', $detail['send_time']) ?></td>
                                    <td>
                                        <?php if ($detail['is_receipt'] == 1): ?>
                                            <span class="am-badge am-badge-success">已收货</span>
                                        <?php else: ?>
                                            <span class="am-badge">待收货</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <!-- 确认收货并退款 -->
                    <?php if (checkPrivilege('order.refund/receipt')): if (
                            $detail['type']['value'] == 10
                            && $detail['is_agree']['value'] == 10
                            && $detail['is_user_send'] == 1
                            && $detail['is_receipt'] == 0
                        ): ?>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">确认收货并退款</div>
                            </div>
                            <div class="tips am-margin-bottom-sm am-u-sm-12">
                                <div class="pre">
                                    <p class="">注：该操作将执行订单原路退款 并关闭当前售后单，请确认并填写退款的金额（不能大于订单实付款）</p>
                                    <?php if ($order['update_price']['value'] != 0): ?>
                                        <p class="x-color-red">
                                            注：当前订单存在后台改价记录，退款金额请参考订单实付款金额</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <form id="receipt" class="my-form am-form tpl-form-line-form" method="post"
                                  action="<?= url('order.refund/receipt', ['order_refund_id' => $detail['order_refund_id']]) ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">售后类型 </label>
                                    <div class="am-u-sm-9 am-u-end am-padding-top-xs">
                                        <span class="am-badge am-badge-secondary"> <?= $detail['type']['text'] ?> </span>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">退款金额 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="number" min="0.01" class="tpl-form-input"
                                               name="refund[refund_money]"
                                               value="<?= min($order['pay_price'], $detail['order_goods']['total_pay_price']) ?>"
                                               required>
                                        <small>
                                            请输入退款金额，最多<?= min($order['pay_price'], $detail['order_goods']['total_pay_price']) ?>
                                            元
                                        </small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <div class="am-u-sm-10 am-u-sm-push-2 am-margin-top-lg">
                                        <button type="submit" class="j-submit am-btn am-btn-sm am-btn-secondary">
                                            确认收货并退款
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php endif; endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        // 切换审核状态
        $("input:radio[name='refund[is_agree]']").change(function (e) {
            $('.form-tab-group')
                .removeClass('active')
                .filter('.item-agree-' + e.currentTarget.value)
                .addClass('active');
        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('.my-form').superForm();

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
