<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:88:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/shop/setting.php";i:1561880723;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;s:99:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/_template/file_library.php";i:1560414032;}*/ ?>
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
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <div class="am-tabs am-margin-top" data-am-tabs="{noSwipe: 1}">
                            <ul class="am-tabs-nav am-nav am-nav-tabs">
                                <li class="am-active"><a href="#tab1">基础设置</a></li>
                                <li><a href="#tab2">门店条件</a></li>
                                <li><a href="#tab3">佣金设置</a></li>
                                <li><a href="#tab4">结算</a></li>
                                <li><a href="#tab5">自定义文字</a></li>
                                <li><a href="#tab6">申请协议</a></li>
                                <li><a href="#tab7">页面背景图</a></li>
                                <li><a href="#tab8">模板消息</a></li>
                            </ul>
                            <div class="am-tabs-bd">
                                <div class="am-tab-panel am-active am-margin-top-lg" id="tab1">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require"> 是否开启门店功能 </label>
                                        <div class="am-u-sm-9">
                                            <label class="am-radio-inline">
                                                <input type="radio" name="setting[basic][is_open]"
                                                       value="1" data-am-ucheck
                                                    <?= $data['basic']['values']['is_open'] == '1' ? 'checked' : '' ?>>
                                                开启
                                            </label>
                                            <label class="am-radio-inline">
                                                <input type="radio" name="setting[basic][is_open]"
                                                       value="0" data-am-ucheck
                                                    <?= $data['basic']['values']['is_open'] == '0' ? 'checked' : '' ?>>
                                                关闭
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="am-tab-panel am-margin-top-lg" id="tab2">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require"> 成为门店条件 </label>
                                        <div class="am-u-sm-9">
                                            <label class="am-radio-inline">
                                                <input type="radio" name="setting[condition][become]"
                                                       value="10" data-am-ucheck
                                                    <?= $data['condition']['values']['become'] == '10' ? 'checked' : '' ?>>
                                                需后台审核
                                            </label>
                                            <label class="am-radio-inline">
                                                <input type="radio" name="setting[condition][become]"
                                                       value="20" data-am-ucheck
                                                    <?= $data['condition']['values']['become'] == '20' ? 'checked' : '' ?>>
                                                无需审核
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-tab-panel am-margin-top-lg" id="tab3">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            一级佣金比例
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="number" min="0" max="100" class="tpl-form-input"
                                                   name="setting[commission][first_money]"
                                                   value="<?= $data['commission']['values']['first_money'] ?>" required>
                                            <small>佣金比例范围 0% - 100%</small>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            二级佣金比例
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="number" min="0" max="100" class="tpl-form-input"
                                                   name="setting[commission][second_money]"
                                                   value="<?= $data['commission']['values']['second_money'] ?>"
                                                   required>
                                            <small>佣金比例范围 0% - 100%</small>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="am-tab-panel am-margin-top-lg" id="tab4">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require"> 提现方式 </label>
                                        <div class="am-u-sm-9">
                                            <label class="am-checkbox-inline">
                                                <input type="checkbox" name="setting[settlement][pay_type][]" value="10"
                                                       data-am-ucheck
                                                    <?= in_array('10', $data['settlement']['values']['pay_type']) ? 'checked' : '' ?>>
                                                微信支付
                                            </label>
                                            <label class="am-checkbox-inline">
                                                <input type="checkbox" name="setting[settlement][pay_type][]" value="20"
                                                       data-am-ucheck
                                                    <?= in_array('20', $data['settlement']['values']['pay_type']) ? 'checked' : '' ?>>
                                                支付宝
                                            </label>
                                            <label class="am-checkbox-inline">
                                                <input type="checkbox" name="setting[settlement][pay_type][]" value="30"
                                                       data-am-ucheck
                                                    <?= in_array('30', $data['settlement']['values']['pay_type']) ? 'checked' : '' ?>>
                                                银行卡
                                            </label>
                                            <div class="help-block">
                                                <small>注：如使用微信支付，则需申请微信支付企业付款到零钱功能</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            最低提现额度
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="number" min="0" class="tpl-form-input"
                                                   name="setting[settlement][min_money]"
                                                   value="<?= $data['settlement']['values']['min_money'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group am-padding-top">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            佣金结算天数
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="number" min="0" class="tpl-form-input"
                                                   name="setting[settlement][settle_days]"
                                                   value="<?= $data['settlement']['values']['settle_days'] ?>"
                                                   required>
                                            <div class="help-block">
                                                <small>当订单完成n天后，该订单的分销佣金才会结算到分销商余额，如果设置为0天 则订单完成时就结算</small>
                                            </div>
                                            <div class="help-block">
                                                <small>注：建议佣金结算天数大于允许发起售后申请天数，如果用户申请退款退货 则不结算佣金</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-tab-panel" id="tab5">
                                    <div class="widget-head am-cf">
                                        <div class="widget-title am-fl">门店中心页面</div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            页面标题
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][index][title][value]"
                                                   value="<?= $data['words']['values']['index']['title']['value'] ?>"
                                                   required>
                                            <small>
                                                默认：<?= $data['words']['values']['index']['title']['default'] ?></small>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            非门店提示
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][index][words][not_shop][value]"
                                                   value="<?= $data['words']['values']['index']['words']['not_shop']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            申请成为门店
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][index][words][apply_now][value]"
                                                   value="<?= $data['words']['values']['index']['words']['apply_now']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            推荐人
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][index][words][referee][value]"
                                                   value="<?= $data['words']['values']['index']['words']['referee']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            可提现佣金
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][index][words][money][value]"
                                                   value="<?= $data['words']['values']['index']['words']['money']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            待提现佣金
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][index][words][freeze_money][value]"
                                                   value="<?= $data['words']['values']['index']['words']['freeze_money']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            已提现金额
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][index][words][total_money][value]"
                                                   value="<?= $data['words']['values']['index']['words']['total_money']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            去提现
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][index][words][withdraw][value]"
                                                   value="<?= $data['words']['values']['index']['words']['withdraw']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="widget-head am-cf">
                                        <div class="widget-title am-fl">申请成为门店页面</div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            页面标题
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][apply][title][value]"
                                                   value="<?= $data['words']['values']['apply']['title']['value'] ?>"
                                                   required>
                                            <small>
                                                默认：<?= $data['words']['values']['apply']['title']['default'] ?></small>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            请填写申请信息
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][apply][words][title][value]"
                                                   value="<?= $data['words']['values']['apply']['words']['title']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            门店申请协议
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][apply][words][license][value]"
                                                   value="<?= $data['words']['values']['apply']['words']['license']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            申请成为门店
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][apply][words][submit][value]"
                                                   value="<?= $data['words']['values']['apply']['words']['submit']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            审核中提示信息
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][apply][words][wait_audit][value]"
                                                   value="<?= $data['words']['values']['apply']['words']['wait_audit']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            去商城逛逛
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][apply][words][goto_mall][value]"
                                                   value="<?= $data['words']['values']['apply']['words']['goto_mall']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="widget-head am-cf">
                                        <div class="widget-title am-fl">门店订单页面</div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            页面标题
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][order][title][value]"
                                                   value="<?= $data['words']['values']['order']['title']['value'] ?>"
                                                   required>
                                            <small>
                                                默认：<?= $data['words']['values']['order']['title']['default'] ?></small>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            全部
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][order][words][all][value]"
                                                   value="<?= $data['words']['values']['order']['words']['all']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            未结算
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][order][words][unsettled][value]"
                                                   value="<?= $data['words']['values']['order']['words']['unsettled']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            已结算
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][order][words][settled][value]"
                                                   value="<?= $data['words']['values']['order']['words']['settled']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>

                                    
                                   
                                    
                                    
                                    

                                    <div class="widget-head am-cf">
                                        <div class="widget-title am-fl">提现明细页面</div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            页面标题
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_list][title][value]"
                                                   value="<?= $data['words']['values']['withdraw_list']['title']['value'] ?>"
                                                   required>
                                            <small>
                                                默认：<?= $data['words']['values']['withdraw_list']['title']['default'] ?></small>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            全部
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_list][words][all][value]"
                                                   value="<?= $data['words']['values']['withdraw_list']['words']['all']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            审核中
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_list][words][apply_10][value]"
                                                   value="<?= $data['words']['values']['withdraw_list']['words']['apply_10']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            审核通过
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_list][words][apply_20][value]"
                                                   value="<?= $data['words']['values']['withdraw_list']['words']['apply_20']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            已打款
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_list][words][apply_40][value]"
                                                   value="<?= $data['words']['values']['withdraw_list']['words']['apply_40']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            驳回
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_list][words][apply_30][value]"
                                                   value="<?= $data['words']['values']['withdraw_list']['words']['apply_30']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="widget-head am-cf">
                                        <div class="widget-title am-fl">申请提现页面</div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            页面标题
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_apply][title][value]"
                                                   value="<?= $data['words']['values']['withdraw_apply']['title']['value'] ?>"
                                                   required>
                                            <small>
                                                默认：<?= $data['words']['values']['withdraw_apply']['title']['default'] ?></small>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            可提现佣金
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_apply][words][capital][value]"
                                                   value="<?= $data['words']['values']['withdraw_apply']['words']['capital']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            提现金额
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_apply][words][money][value]"
                                                   value="<?= $data['words']['values']['withdraw_apply']['words']['money']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            请输入要提取的金额
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_apply][words][money_placeholder][value]"
                                                   value="<?= $data['words']['values']['withdraw_apply']['words']['money_placeholder']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            最低提现佣金
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_apply][words][min_money][value]"
                                                   value="<?= $data['words']['values']['withdraw_apply']['words']['min_money']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            提交申请
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[words][withdraw_apply][words][submit][value]"
                                                   value="<?= $data['words']['values']['withdraw_apply']['words']['submit']['value'] ?>"
                                                   required>
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="am-tab-panel am-margin-top-lg" id="tab6">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店申请协议 </label>
                                        <div class="am-u-sm-9 am-u-end">
                                    <textarea class="" rows="6" placeholder="请输入门店申请协议"
                                              name="setting[license][license]"><?= $data['license']['values']['license'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-tab-panel am-margin-top-lg" id="tab7">
                                    <input type="hidden" name="setting[background][__]" value="">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店中心首页 </label>
                                        <div class="am-u-sm-9 am-u-end">
                                            <div class="am-form-file">
                                                <div class="am-form-file">
                                                    <button type="button"
                                                            class="j-index upload-file am-btn am-btn-secondary am-radius">
                                                        <i class="am-icon-cloud-upload"></i> 选择图片
                                                    </button>
                                                    <div class="uploader-list am-cf">
                                                        <?php if (!empty($data['background']['values']['index'])): ?>
                                                            <div class="file-item">
                                                                <a href="<?= $data['background']['values']['index'] ?>"
                                                                   title="点击查看大图"
                                                                   target="_blank">
                                                                    <img src="<?= $data['background']['values']['index'] ?>">
                                                                </a>
                                                                <input type="hidden" name="setting[background][index]"
                                                                       value="<?= $data['background']['values']['index'] ?>">
                                                                <i class="iconfont icon-shanchu file-item-delete"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="help-block">
                                                    <small>尺寸：宽750像素 高度不限</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">申请成为门店页 </label>
                                        <div class="am-u-sm-9 am-u-end">
                                            <div class="am-form-file">
                                                <div class="am-form-file">
                                                    <button type="button"
                                                            class="j-apply upload-file am-btn am-btn-secondary am-radius">
                                                        <i class="am-icon-cloud-upload"></i> 选择图片
                                                    </button>
                                                    <div class="uploader-list am-cf">
                                                        <?php if (!empty($data['background']['values']['apply'])): ?>
                                                            <div class="file-item">
                                                                <a href="<?= $data['background']['values']['apply'] ?>"
                                                                   title="点击查看大图"
                                                                   target="_blank">
                                                                    <img src="<?= $data['background']['values']['apply'] ?>">
                                                                </a>
                                                                <input type="hidden" name="setting[background][apply]"
                                                                       value="<?= $data['background']['values']['apply'] ?>">
                                                                <i class="iconfont icon-shanchu file-item-delete"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="help-block">
                                                    <small>尺寸：宽750像素 高度不限</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">申请提现页 </label>
                                        <div class="am-u-sm-9 am-u-end">
                                            <div class="am-form-file">
                                                <div class="am-form-file">
                                                    <button type="button"
                                                            class="j-withdraw_apply upload-file am-btn am-btn-secondary am-radius">
                                                        <i class="am-icon-cloud-upload"></i> 选择图片
                                                    </button>
                                                    <div class="uploader-list am-cf">
                                                        <?php if (!empty($data['background']['values']['withdraw_apply'])): ?>
                                                            <div class="file-item">
                                                                <a href="<?= $data['background']['values']['withdraw_apply'] ?>"
                                                                   title="点击查看大图"
                                                                   target="_blank">
                                                                    <img src="<?= $data['background']['values']['withdraw_apply'] ?>">
                                                                </a>
                                                                <input type="hidden"
                                                                       name="setting[background][withdraw_apply]"
                                                                       value="<?= $data['background']['values']['withdraw_apply'] ?>">
                                                                <i class="iconfont icon-shanchu file-item-delete"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="help-block">
                                                    <small>尺寸：宽750像素 高度不限</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-tab-panel am-margin-top-lg" id="tab8">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            门店入驻审核通知
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[template_msg][apply_tpl]"
                                                   placeholder="请填写模板消息ID"
                                                   value="<?= $data['template_msg']['values']['apply_tpl'] ?>">
                                            <small>模板编号AT0674，关键词 (申请时间、审核状态、审核时间、备注信息)</small>
                                            <small class="am-margin-left-xs">
                                                <a href="<?= url('store/setting.help/tplmsg') ?>" target="_blank">如何获取模板消息ID？</a>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label form-require">
                                            提现状态通知
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input"
                                                   name="setting[template_msg][withdraw_tpl]"
                                                   placeholder="请填写模板消息ID"
                                                   value="<?= $data['template_msg']['values']['withdraw_tpl'] ?>">
                                            <small>模板编号AT0324，关键词 (提现时间、提现方式、提现金额、提现状态、备注)</small>
                                            <small class="am-margin-left-xs">
                                                <a href="<?= url('store/setting.help/tplmsg') ?>" target="_blank">如何获取模板消息ID？</a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 图片文件列表模板 -->
<script id="tpl-file-item" type="text/template">
    {{ each list }}
    <div class="file-item">
        <a href="{{ $value.file_path }}" title="点击查看大图" target="_blank">
            <img src="{{ $value.file_path }}">
        </a>
        <input type="hidden" name="{{ name }}" value="{{ $value.file_path }}">
        <i class="iconfont icon-shanchu file-item-delete" data-name="商品"></i>
    </div>
    {{ /each }}
</script>


<!-- 文件库弹窗 -->
<!-- 文件库模板 -->
<script id="tpl-file-library" type="text/template">
    <div class="row">
        <div class="file-group">
            <ul class="nav-new">
                <li class="ng-scope {{ is_default ? 'active' : '' }}" data-group-id="-1">
                    <a class="group-name am-text-truncate" href="javascript:void(0);" title="全部">全部</a>
                </li>
                <li class="ng-scope" data-group-id="0">
                    <a class="group-name am-text-truncate" href="javascript:void(0);" title="未分组">未分组</a>
                </li>
                {{ each group_list }}
                <li class="ng-scope"
                    data-group-id="{{ $value.group_id }}" title="{{ $value.group_name }}">
                    <a class="group-edit" href="javascript:void(0);" title="编辑分组">
                        <i class="iconfont icon-bianji"></i>
                    </a>
                    <a class="group-name am-text-truncate" href="javascript:void(0);">
                        {{ $value.group_name }}
                    </a>
                    <a class="group-delete" href="javascript:void(0);" title="删除分组">
                        <i class="iconfont icon-shanchu1"></i>
                    </a>
                </li>
                {{ /each }}
            </ul>
            <a class="group-add" href="javascript:void(0);">新增分组</a>
        </div>
        <div class="file-list">
            <div class="v-box-header am-cf">
                <div class="h-left am-fl am-cf">
                    <div class="am-fl">
                        <div class="group-select am-dropdown">
                            <button type="button" class="am-btn am-btn-sm am-btn-secondary am-dropdown-toggle">
                                移动至 <span class="am-icon-caret-down"></span>
                            </button>
                            <ul class="group-list am-dropdown-content">
                                <li class="am-dropdown-header">请选择分组</li>
                                {{ each group_list }}
                                <li>
                                    <a class="move-file-group" data-group-id="{{ $value.group_id }}"
                                       href="javascript:void(0);">{{ $value.group_name }}</a>
                                </li>
                                {{ /each }}
                            </ul>
                        </div>
                    </div>
                    <div class="am-fl tpl-table-black-operation">
                        <a href="javascript:void(0);" class="file-delete tpl-table-black-operation-del"
                           data-group-id="2">
                            <i class="am-icon-trash"></i> 删除
                        </a>
                    </div>
                </div>
                <div class="h-rigth am-fr">
                    <div class="j-upload upload-image">
                        <i class="iconfont icon-add1"></i>
                        上传图片
                    </div>
                </div>
            </div>
            <div id="file-list-body" class="v-box-body">
                {{ include 'tpl-file-list' file_list }}
            </div>
            <div class="v-box-footer am-cf"></div>
        </div>
    </div>

</script>

<!-- 文件列表模板 -->
<script id="tpl-file-list" type="text/template">
    <ul class="file-list-item">
        {{ include 'tpl-file-list-item' data }}
    </ul>
    {{ if last_page > 1 }}
    <div class="file-page-box am-fr">
        <ul class="pagination">
            {{ if current_page > 1 }}
            <li>
                <a class="switch-page" href="javascript:void(0);" title="上一页" data-page="{{ current_page - 1 }}">«</a>
            </li>
            {{ /if }}
            {{ if current_page < last_page }}
            <li>
                <a class="switch-page" href="javascript:void(0);" title="下一页" data-page="{{ current_page + 1 }}">»</a>
            </li>
            {{ /if }}
        </ul>
    </div>
    {{ /if }}
</script>

<!-- 文件列表模板 -->
<script id="tpl-file-list-item" type="text/template">
    {{ each $data }}
    <li class="ng-scope" title="{{ $value.file_name }}" data-file-id="{{ $value.file_id }}"
        data-file-path="{{ $value.file_path }}">
        <div class="img-cover"
             style="background-image: url('{{ $value.file_path }}')">
        </div>
        <p class="file-name am-text-center am-text-truncate">{{ $value.file_name }}</p>
        <div class="select-mask">
            <img src="assets/store/img/chose.png">
        </div>
    </li>
    {{ /each }}
</script>

<!-- 分组元素-->
<script id="tpl-group-item" type="text/template">
    <li class="ng-scope" data-group-id="{{ group_id }}" title="{{ group_name }}">
        <a class="group-edit" href="javascript:void(0);" title="编辑分组">
            <i class="iconfont icon-bianji"></i>
        </a>
        <a class="group-name am-text-truncate" href="javascript:void(0);">
            {{ group_name }}
        </a>
        <a class="group-delete" href="javascript:void(0);" title="删除分组">
            <i class="iconfont icon-shanchu1"></i>
        </a>
    </li>
</script>



<script src="assets/common/js/ddsort.js"></script>
<script src="assets/store/js/select.data.js?v=<?= $version ?>"></script>
<script>
    $(function () {

        // 选择图片：门店中心首页
        $('.j-index').selectImages({
            name: 'setting[background][index]'
            , multiple: false
        });

        // 选择图片：申请成为门店页
        $('.j-apply').selectImages({
            name: 'setting[background][apply]'
            , multiple: false
        });

        // 选择图片：申请提现页
        $('.j-withdraw_apply').selectImages({
            name: 'setting[background][withdraw_apply]'
            , multiple: false
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
