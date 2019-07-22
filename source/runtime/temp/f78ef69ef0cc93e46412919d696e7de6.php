<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:94:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/market/coupon/edit.php";i:1560414033;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;}*/ ?>
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
                <form id="my-form" class="am-form tpl-form-line-form" enctype="multipart/form-data" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">编辑优惠券</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">优惠券名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="coupon[name]"
                                           value="<?= $model['name'] ?>" placeholder="请输入优惠券名称" required>
                                    <small>例如：满100减10</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">优惠券颜色 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="coupon[color]"
                                               value="10" <?= $model['color']['value'] == 10 ? 'checked' : '' ?>
                                               data-am-ucheck>
                                        蓝色
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="coupon[color]" value="20"
                                            <?= $model['color']['value'] == 20 ? 'checked' : '' ?>
                                               data-am-ucheck>
                                        红色
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="coupon[color]" value="30"
                                            <?= $model['color']['value'] == 30 ? 'checked' : '' ?>
                                               data-am-ucheck>
                                        紫色
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="coupon[color]" value="40"
                                            <?= $model['color']['value'] == 40 ? 'checked' : '' ?>
                                               data-am-ucheck>
                                        黄色
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group" data-x-switch>
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">优惠券类型 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="coupon[coupon_type]" value="10"
                                               data-am-ucheck
                                               data-switch-box="switch-coupon_type"
                                               data-switch-item="coupon_type__10"
                                            <?= $model['coupon_type']['value'] == 10 ? 'checked' : '' ?>>
                                        满减券
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="coupon[coupon_type]" value="20"
                                               data-am-ucheck
                                               data-switch-box="switch-coupon_type"
                                               data-switch-item="coupon_type__20"
                                            <?= $model['coupon_type']['value'] == 20 ? 'checked' : '' ?>>
                                        折扣券
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group switch-coupon_type coupon_type__10 <?= $model['coupon_type']['value'] == 10 ? '' : 'hide' ?>">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">减免金额 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" min="0.01" class="tpl-form-input" name="coupon[reduce_price]"
                                           value="<?= $model['reduce_price'] ?>" placeholder="请输入减免金额" required>
                                </div>
                            </div>
                            <div class="am-form-group switch-coupon_type coupon_type__20 <?= $model['coupon_type']['value'] == 20 ? '' : 'hide' ?>">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">折扣率 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" min="0" max="10" class="tpl-form-input"
                                           name="coupon[discount]"
                                           value="<?= $model['discount'] ?>" placeholder="请输入折扣率" required>
                                    <small>折扣率范围0-10，9.5代表9.5折，0代表不折扣</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">最低消费金额 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" min="1" class="tpl-form-input" name="coupon[min_price]"
                                           value="<?= $model['min_price'] ?>" placeholder="请输入最低消费金额" required>
                                </div>
                            </div>
                            <div class="am-form-group" data-x-switch>
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">到期类型 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="coupon[expire_type]" value="10"
                                               data-am-ucheck
                                               data-switch-box="switch-expire_type"
                                               data-switch-item="expire_type__10"
                                            <?= $model['expire_type'] == 10 ? 'checked' : '' ?>>
                                        领取后生效
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="coupon[expire_type]" value="20"
                                               data-am-ucheck
                                               data-switch-box="switch-expire_type"
                                               data-switch-item="expire_type__20"
                                            <?= $model['expire_type'] == 20 ? 'checked' : '' ?>>
                                        固定时间
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group switch-expire_type expire_type__10 <?= $model['expire_type'] == 10 ? '' : 'hide' ?>">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">有效天数 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" min="1" class="tpl-form-input" name="coupon[expire_day]"
                                           value="<?= $model['expire_day'] ?>" placeholder="请输入有效天数" required>
                                </div>
                            </div>
                            <div class="am-form-group switch-expire_type expire_type__20 <?= $model['expire_type'] == 20 ? '' : 'hide' ?>">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">时间范围 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="j-startTime am-form-field am-margin-bottom-sm"
                                           name="coupon[start_time]"
                                           value="<?= $model['start_time']['value'] > 1 ? $model['start_time']['text'] : '' ?>"
                                           placeholder="请选择开始日期"
                                           required>
                                    <input type="text" class="j-endTime am-form-field"
                                           name="coupon[end_time]"
                                           value="<?= $model['end_time']['value'] > 1 ? $model['end_time']['text'] : '' ?>"
                                           placeholder="请选择结束日期" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">发放总数量 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" min="-1" class="tpl-form-input" name="coupon[total_num]"
                                           value="<?= $model['total_num'] ?>" required>
                                    <small>限制领取的优惠券数量，-1为不限制</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">排序 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" min="0" class="tpl-form-input" name="coupon[sort]"
                                           value="<?= $model['sort'] ?>" required>
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
    /**
     * 时间选择
     */
    $(function () {
        var nowTemp = new Date();
        var nowDay = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0).valueOf();
        var nowMoth = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), 1, 0, 0, 0, 0).valueOf();
        var nowYear = new Date(nowTemp.getFullYear(), 0, 1, 0, 0, 0, 0).valueOf();
        var $startTime = $('.j-startTime');
        var $endTime = $('.j-endTime');

        var checkin = $startTime.datepicker({
            onRender: function (date, viewMode) {
                // 默认 days 视图，与当前日期比较
                var viewDate = nowDay;
                switch (viewMode) {
                    // moths 视图，与当前月份比较
                    case 1:
                        viewDate = nowMoth;
                        break;
                    // years 视图，与当前年份比较
                    case 2:
                        viewDate = nowYear;
                        break;
                }
                return date.valueOf() < viewDate ? 'am-disabled' : '';
            }
        }).on('changeDate.datepicker.amui', function (ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
            }
            checkin.close();
            $endTime[0].focus();
        }).data('amui.datepicker');

        var checkout = $endTime.datepicker({
            onRender: function (date, viewMode) {
                var inTime = checkin.date;
                var inDay = inTime.valueOf();
                var inMoth = new Date(inTime.getFullYear(), inTime.getMonth(), 1, 0, 0, 0, 0).valueOf();
                var inYear = new Date(inTime.getFullYear(), 0, 1, 0, 0, 0, 0).valueOf();
                // 默认 days 视图，与当前日期比较
                var viewDate = inDay;
                switch (viewMode) {
                    // moths 视图，与当前月份比较
                    case 1:
                        viewDate = inMoth;
                        break;
                    // years 视图，与当前年份比较
                    case 2:
                        viewDate = inYear;
                        break;
                }
                return date.valueOf() <= viewDate ? 'am-disabled' : '';
            }
        }).on('changeDate.datepicker.amui', function (ev) {
            checkout.close();
        }).data('amui.datepicker');
    });
</script>

<script>
    $(function () {

        // swith切换
        var $mySwitch = $('[data-x-switch]');
        $mySwitch.find('[data-switch-item]').click(function () {
            var $mySwitchBox = $('.' + $(this).data('switch-box'));
            $mySwitchBox.hide().filter('.' + $(this).data('switch-item')).show();
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
