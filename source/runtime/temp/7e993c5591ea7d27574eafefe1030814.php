<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:95:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/shop/withdraw/index.php";i:1561195706;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;}*/ ?>
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
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">门店提现申请</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form class="toolbar-form" action="">
                            <input type="hidden" name="s" value="/<?= $request->pathinfo() ?>">
                            <input type="hidden" name="user_id" value="<?= $request->get('user_id') ?>">
                            <div class="am-u-sm-12 am-u-md-9 am-u-sm-push-3">
                                <div class="am fr">
                                    <div class="am-form-group am-fl">
                                        <select name="apply_status"
                                                data-am-selected="{btnSize: 'sm', placeholder: '审核状态'}">
                                            <option value=""></option>
                                            <option value="-1" <?= $request->get('apply_status') === '-1' ? 'selected' : '' ?>>
                                                全部
                                            </option>
                                            <option value="10" <?= $request->get('apply_status') == '10' ? 'selected' : '' ?>>
                                                待审核
                                            </option>
                                            <option value="20" <?= $request->get('apply_status') == '20' ? 'selected' : '' ?>>
                                                审核通过
                                            </option>
                                            <option value="40" <?= $request->get('apply_status') == '40' ? 'selected' : '' ?>>
                                                已打款
                                            </option>
                                            <option value="30" <?= $request->get('apply_status') == '30' ? 'selected' : '' ?>>
                                                驳回
                                            </option>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <select name="pay_type"
                                                data-am-selected="{btnSize: 'sm', placeholder: '提现方式'}">
                                            <option value=""></option>
                                            <option value="-1" <?= $request->get('pay_type') == '-1' ? 'selected' : '' ?>>
                                                全部
                                            </option>
                                            <option value="20" <?= $request->get('pay_type') == '20' ? 'selected' : '' ?>>
                                                支付宝
                                            </option>
                                            <option value="30" <?= $request->get('pay_type') == '30' ? 'selected' : '' ?>>
                                                银行卡
                                            </option>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <select name="shop_id"
                                                data-am-selected="{btnSize: 'sm', placeholder: '所属门店'}">
                                            <option value=""></option>
                                            <?php if (isset($shopList)): foreach ($shopList as $shop): ?>
                                                <option value="<?= $shop['shop_id'] ?>"
                                                    <?= $request->get('shop_id') == $shop['shop_id'] ? 'selected' : '' ?>>
                                                    <?= $shop['shop_name'] ?>
                                                </option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl" style="width: 80px;">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
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
                    <div class="am-scrollable-horizontal am-u-sm-12 am-padding-bottom-lg">
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>用户ID</th>
                                <th>门店</th>
                                <th>
                                    <p>姓名</p>
                                    <p>手机</p>
                                </th>
                                <th>提现金额</th>
                                <th>提现方式</th>
                                <th>提现信息</th>
                                <th class="am-text-center">审核状态</th>
                                <th>申请时间</th>
                                <th>审核时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['user_id'] ?></td>
                                    
                                    <td class="am-text-middle">
                                        <p><span><?= $item['shop_name'] ?></span></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <p><?= $item['linkman'] ?: '--' ?></p>
                                        <p><?= $item['phone'] ?: '--' ?></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <p><span><?= $item['money'] ?></span></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <p><span><?= $item['pay_type']['text'] ?></span></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <?php if ($item['pay_type']['value'] == 20) : ?>
                                            <p><span><?= $item['alipay_name'] ?></span></p>
                                            <p><span><?= $item['alipay_account'] ?></span></p>
                                        <?php elseif ($item['pay_type']['value'] == 30) : ?>
                                            <p><span><?= $item['bank_name'] ?></span></p>
                                            <p><span><?= $item['bank_account'] ?></span></p>
                                            <p><span><?= $item['bank_card'] ?></span></p>
                                        <?php else : ?>
                                            <p><span>--</span></p>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle am-text-center">
                                        <?php if ($item['apply_status'] == 10) : ?>
                                            <span class="am-badge">待审核</span>
                                        <?php elseif ($item['apply_status'] == 20) : ?>
                                            <span class="am-badge am-badge-secondary">审核通过</span>
                                        <?php elseif ($item['apply_status'] == 30) : ?>
                                            <p><span class="am-badge am-badge-warning">已驳回</span></p>
                                            <span class="f-12">
                                                <a class="j-show-reason" href="javascript:void(0);"
                                                   data-reason="<?= $item['reject_reason'] ?>">
                                                    查看原因</a>
                                            </span>
                                        <?php elseif ($item['apply_status'] == 40) : ?>
                                            <span class="am-badge am-badge-success">已打款</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle"><?= $item['audit_time'] ?: '--' ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if (in_array($item['apply_status'], [10, 20])) : if (checkPrivilege('shop.withdraw/submit')): ?>
                                                    <a class="j-audit" data-id="<?= $item['id'] ?>"
                                                       href="javascript:void(0);">
                                                        <i class="am-icon-pencil"></i> 审核
                                                    </a>
                                                <?php endif; if ($item['apply_status'] == 20) : if (checkPrivilege('shop.withdraw/money')): ?>
                                                        <a class="j-money tpl-table-black-operation-del"
                                                           data-id="<?= $item['id'] ?>" href="javascript:void(0);">确认打款
                                                        </a>
                                                    <?php endif; endif; if ($item['apply_status'] == 20 && $item['pay_type']['value'] == 10) : if (checkPrivilege('shop.withdraw/wechat_pay')): ?>
                                                        <a class="j-wechat-pay tpl-table-black-operation-green"
                                                           data-id="<?= $item['id'] ?>" href="javascript:void(0);">微信付款
                                                        </a>
                                                    <?php endif; endif; endif; if (in_array($item['apply_status'], [30, 40])) : ?>
                                                <span>---</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="11" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
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
</div>

<!-- 提现审核 -->
<script id="tpl-shop-withdraw" type="text/template">
    <div class="am-padding-top-sm">
        <form class="form-shop-withdraw am-form tpl-form-line-form" method="post"
              action="<?= url('shop.withdraw/submit') ?>">
            <input type="hidden" name="id" value="{{ id }}">
            <div class="am-form-group">
                <label class="am-u-sm-3 am-form-label"> 审核状态 </label>
                <div class="am-u-sm-9">
                    <label class="am-radio-inline">
                        <input type="radio" name="withdraw[apply_status]" value="20" data-am-ucheck
                               checked> 审核通过
                    </label>
                    <label class="am-radio-inline">
                        <input type="radio" name="withdraw[apply_status]" value="30" data-am-ucheck> 驳回
                    </label>
                </div>
            </div>
            <div class="am-form-group">
                <label class="am-u-sm-3 am-form-label"> 驳回原因 </label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" name="withdraw[reject_reason]" placeholder="仅在驳回时填写"
                           value="">
                </div>
            </div>
        </form>
    </div>
</script>

<script>
    $(function () {

        /**
         * 审核操作
         */
        $('.j-audit').click(function () {
            var $this = $(this);
            layer.open({
                type: 1
                , title: '提现审核'
                , area: '340px'
                , offset: 'auto'
                , anim: 1
                , closeBtn: 1
                , shade: 0.3
                , btn: ['确定', '取消']
                , content: template('tpl-shop-withdraw', $this.data())
                , success: function (layero) {
                    // 注册radio组件
                    layero.find('input[type=radio]').uCheck();
                }
                , yes: function (index, layero) {
                    // 表单提交
                    layero.find('.form-shop-withdraw').ajaxSubmit({
                        type: 'post',
                        dataType: 'json',
                        success: function (result) {
                            result.code === 1 ? $.show_success(result.msg, result.url)
                                : $.show_error(result.msg);
                        }
                    });
                    layer.close(index);
                }
            });
        });

        /**
         * 显示驳回原因
         */
        $('.j-show-reason').click(function () {
            var $this = $(this);
            layer.alert($this.data('reason'), {title: '驳回原因'});
        });

        /**
         * 确认打款
         */
        $('.j-money').click(function () {
            var id = $(this).data('id');
            var url = "<?= url('shop.withdraw/money') ?>";
            layer.confirm('确定已打款吗？', {title: '友情提示'}, function (index) {
                $.post(url, {id: id}, function (result) {
                    result.code === 1 ? $.show_success(result.msg, result.url)
                        : $.show_error(result.msg);
                });
                layer.close(index);
            });
        });

        /**
         * 微信付款
         */
        $('.j-wechat-pay').click(function () {
            var id = $(this).data('id');
            var url = "<?= url('shop.withdraw/wechat_pay') ?>";
            layer.confirm('该操作 将使用微信支付企业付款到零钱功能，确定打款吗？', {title: '友情提示'}, function (index) {
                $.post(url, {id: id}, function (result) {
                    result.code === 1 ? $.show_success(result.msg, result.url)
                        : $.show_error(result.msg);
                });
                layer.close(index);
            });
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
