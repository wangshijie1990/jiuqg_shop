<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/goods/edit.php";i:1561622640;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;s:100:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/_template/tpl_file_item.php";i:1560414032;s:99:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/_template/file_library.php";i:1560414032;}*/ ?>
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
        <link rel="stylesheet" href="assets/store/css/goods.css?v=<?= $version ?>">
<link rel="stylesheet" href="assets/common/plugins/umeditor/themes/default/css/umeditor.css">
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">基本信息</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="goods[goods_name]"
                                           value="<?= $model['goods_name'] ?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品分类 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="goods[category_id]" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',
                                             placeholder:'请选择商品分类', maxHeight: 400}">
                                        <option value=""></option>
                                        <?php if (isset($catgory)): foreach ($catgory as $first): ?>
                                            <option value="<?= $first['category_id'] ?>"
                                                <?= $model['category_id'] == $first['category_id'] ? 'selected' : '' ?>>
                                                <?= $first['name'] ?></option>
                                            <?php if (isset($first['child'])): foreach ($first['child'] as $two): ?>
                                                <option value="<?= $two['category_id'] ?>"
                                                    <?= $model['category_id'] == $two['category_id'] ? 'selected' : '' ?>>
                                                    　　<?= $two['name'] ?></option>
                                                <?php if (isset($two['child'])): foreach ($two['child'] as $three): ?>
                                                    <option value="<?= $three['category_id'] ?>"
                                                        <?= $model['category_id'] == $three['category_id'] ? 'selected' : '' ?>>
                                                        　　　<?= $three['name'] ?></option>
                                                <?php endforeach; endif; endforeach; endif; endforeach; endif; ?>
                                    </select>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= url('goods.category/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品图片 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                        <button type="button"
                                                class="upload-file am-btn am-btn-secondary am-radius">
                                            <i class="am-icon-cloud-upload"></i> 选择图片
                                        </button>
                                        <div class="uploader-list am-cf">
                                            <?php foreach ($model['image'] as $key => $item): ?>
                                                <div class="file-item">
                                                    <a href="<?= $item['file_path'] ?>" title="点击查看大图" target="_blank">
                                                        <img src="<?= $item['file_path'] ?>">
                                                    </a>
                                                    <input type="hidden" name="goods[images][]"
                                                           value="<?= $item['image_id'] ?>">
                                                    <i class="iconfont icon-shanchu file-item-delete"></i>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="help-block am-margin-top-sm">
                                        <small>尺寸750x750像素以上，大小2M以下 (可拖拽图片调整显示顺序 )</small>
                                    </div>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品卖点 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="goods[selling_point]"
                                           value="<?= $model['selling_point'] ?>">
                                    <small>选填，商品卖点简述，例如：此款商品美观大方 性价比较高 不容错过</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品标签</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="goods[tag_text]"
                                           value="<?= $model['tag_text'] ?>">
                                    <small>商品标签，比如今日特价，夏日必备</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品标签数字值</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="goods[tag_value]"
                                           value="<?= $model['tag_value'] ?>">
                                    <small>商品标签值，大于1的数字即可</small>
                                </div>
                            </div>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">规格/库存</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品规格 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[spec_type]" value="10" data-am-ucheck
                                            <?= $model['spec_type'] == 10 ? 'checked' : '' ?> >
                                        单规格
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[spec_type]" value="20" data-am-ucheck
                                            <?= $model['spec_type'] == 20 ? 'checked' : '' ?> >
                                        <span>多规格</span>
                                    </label>
                                </div>
                            </div>

                            <!-- 商品多规格 -->
                            <div id="many-app" v-cloak class="goods-spec-many am-form-group"
                                 v-bind:style="{display: '<?= $model['spec_type'] == 20 ? 'block' : 'none' ?>'}">
                                <div class="goods-spec-box am-u-sm-9 am-u-sm-push-2 am-u-end">
                                    <!-- 规格属性 -->
                                    <div class="spec-attr">
                                        <div v-for="(item, index) in spec_attr" class="spec-group-item">
                                            <div class="spec-group-name">
                                                <span>{{ item.group_name }}</span>
                                                <i @click="onDeleteGroup(index)"
                                                   class="spec-group-delete iconfont icon-shanchu1" title="点击删除"></i>
                                            </div>
                                            <div class="spec-list am-cf">
                                                <div v-for="(val, i) in item.spec_items" class="spec-item am-fl">
                                                    <span>{{ val.spec_value }}</span>
                                                    <i @click="onDeleteValue(index, i)"
                                                       class="spec-item-delete iconfont icon-shanchu1" title="点击删除"></i>
                                                </div>
                                                <div class="spec-item-add am-cf am-fl">
                                                    <input type="text" v-model="item.tempValue"
                                                           class="ipt-specItem am-fl am-field-valid">
                                                    <button @click="onSubmitAddValue(index)" type="button"
                                                            class="am-btn am-fl">添加
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 添加规格组：按钮 -->
                                    <div v-if="showAddGroupBtn" class="spec-group-button">
                                        <button @click="onToggleAddGroupForm" type="button"
                                                class="am-btn">添加规格
                                        </button>
                                    </div>

                                    <!-- 添加规格：表单 -->
                                    <div v-if="showAddGroupForm" class="spec-group-add">
                                        <div class="spec-group-add-item am-form-group">
                                            <label class="am-form-label form-require">规格名 </label>
                                            <input type="text" class="input-specName tpl-form-input"
                                                   v-model="addGroupFrom.specName"
                                                   placeholder="请输入规格名称">
                                        </div>
                                        <div class="spec-group-add-item am-form-group">
                                            <label class="am-form-label form-require">规格值 </label>
                                            <input type="text" class="input-specValue tpl-form-input"
                                                   v-model="addGroupFrom.specValue"
                                                   placeholder="请输入规格值">
                                        </div>
                                        <div class="spec-group-add-item am-margin-top">
                                            <button @click="onSubmitAddGroup" type="button"
                                                    class="am-btn am-btn-xs am-btn-secondary"> 确定
                                            </button>
                                            <button @click="onToggleAddGroupForm" type="button"
                                                    class="am-btn am-btn-xs am-btn-default"> 取消
                                            </button>
                                        </div>
                                    </div>

                                    <!-- 商品多规格sku信息 -->
                                    <div v-if="spec_list.length > 0" class="goods-sku am-scrollable-horizontal">
                                        <!-- 分割线 -->
                                        <div class="goods-spec-line am-margin-top-lg am-margin-bottom-lg"></div>
                                        <!-- sku 批量设置 -->
                                        <div class="spec-batch am-form-inline">
                                            <div class="am-form-group">
                                                <label class="am-form-label">批量设置</label>
                                            </div>
                                            <div class="am-form-group">
                                                <input type="text" v-model="batchData.goods_no" placeholder="商家编码">
                                            </div>
                                            <div class="am-form-group">
                                                <input type="number" v-model="batchData.goods_price" placeholder="销售价">
                                            </div>
                                            <div class="am-form-group">
                                                <input type="number" v-model="batchData.line_price" placeholder="划线价">
                                            </div>
                                            <div class="am-form-group">
                                                <input type="number" v-model="batchData.stock_num" placeholder="库存数量">
                                            </div>
                                            <div class="am-form-group">
                                                <input type="number" v-model="batchData.goods_weight" placeholder="重量">
                                            </div>
                                            <div class="am-form-group">
                                                <button @click="onSubmitBatchData" type="button"
                                                        class="am-btn am-btn-sm am-btn-secondaryam-radius">确定
                                                </button>
                                            </div>
                                        </div>
                                        <!-- sku table -->
                                        <table class="spec-sku-tabel am-table am-table-bordered am-table-centered
                                     am-margin-bottom-xs am-text-nowrap">
                                            <tbody>
                                            <tr>
                                                <th v-for="item in spec_attr">{{ item.group_name }}</th>
                                                <th>规格图片</th>
                                                <th>商家编码</th>
                                                <th>销售价</th>
                                                <th>划线价</th>
                                                <th>库存</th>
                                                <th>重量(kg)</th>
                                            </tr>
                                            <tr v-for="(item, index) in spec_list">
                                                <td v-for="td in item.rows" class="td-spec-value am-text-middle"
                                                    :rowspan="td.rowspan">
                                                    {{ td.spec_value }}
                                                </td>
                                                <td class="am-text-middle spec-image">
                                                    <div v-if="item.form.image_id" class="j-selectImg data-image"
                                                         v-bind:data-index="index">
                                                        <img :src="item.form.image_path" alt="">
                                                        <i class="iconfont icon-shanchu image-delete"
                                                           @click.stop="onDeleteSkuImage(index)"></i>
                                                    </div>
                                                    <div v-else class="j-selectImg upload-image"
                                                         v-bind:data-index="index">
                                                        <i class="iconfont icon-add"></i>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="ipt-goods-no" name="goods_no"
                                                           v-model="item.form.goods_no">
                                                </td>
                                                <td>
                                                    <input type="number" class="ipt-w80" name="goods_price"
                                                           v-model="item.form.goods_price" required>
                                                </td>
                                                <td>
                                                    <input type="number" class="ipt-w80" name="line_price"
                                                           v-model="item.form.line_price">
                                                </td>
                                                <td>
                                                    <input type="number" class="ipt-w80" name="stock_num"
                                                           v-model="item.form.stock_num" required>
                                                </td>
                                                <td>
                                                    <input type="number" class="ipt-w80" name="goods_weight"
                                                           v-model="item.form.goods_weight" required>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- 商品单规格 -->
                            <div class="goods-spec-single"
                                 style="display: <?= $model['spec_type'] == 10 ? 'block' : 'none' ?>;">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品编码 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="text" class="tpl-form-input" name="goods[sku][goods_no]"
                                               value="<?= $model['sku'][0]['goods_no'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品价格 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="number" class="tpl-form-input" name="goods[sku][goods_price]"
                                               value="<?= $model['sku'][0]['goods_price'] ?>" required>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品划线价 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="number" class="tpl-form-input" name="goods[sku][line_price]"
                                               value="<?= $model['sku'][0]['line_price'] ?>">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">当前库存数量 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="number" class="tpl-form-input" name="goods[sku][stock_num]"
                                               value="<?= $model['sku'][0]['stock_num'] ?>" required>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品重量(Kg) </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <input type="number" class="tpl-form-input" name="goods[sku][goods_weight]"
                                               value="<?= $model['sku'][0]['goods_weight'] ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">库存计算方式 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[deduct_stock_type]" value="10" data-am-ucheck
                                            <?= $model['deduct_stock_type'] == 10 ? 'checked' : '' ?> >
                                        下单减库存
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[deduct_stock_type]" value="20" data-am-ucheck
                                            <?= $model['deduct_stock_type'] == 20 ? 'checked' : '' ?> >
                                        付款减库存
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group am-padding-top">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label"> 活动时间 </label>
                                <div class="am-u-sm-9 am-u-md-6 am-u-lg-5 am-u-end">
                                    <!-- 会员等级列表-->
                                    <div class="am-input-group">
                                        <input type="text" class="j-laydate-start am-form-field"
                                               name="goods[start_time]"
                                               placeholder="开始时间"
                                               autocomplete="off"
                                               value="<?=$model['start_time']?>">
                                        <span class="am-input-group-label am-input-group-label__center">至</span>
                                        <input type="text" class="j-laydate-end am-form-field"
                                               name="goods[end_time]"
                                               placeholder="结束时间"
                                               autocomplete="off"
                                               value="<?=$model['end_time']?>">
                                    </div>
                                    <div class="help-block">
                                        <small>限时活动的开始日期与截止日期</small>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">商品详情</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品详情 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <!-- 加载编辑器的容器 -->
                                    <textarea id="container" name="goods[content]"><?= $model['content'] ?></textarea>
                                </div>
                            </div>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">秒杀</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">秒杀状态 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[quick_open]" value="10" data-am-ucheck
                                            <?= $model['quick_open'] == 10 ? 'checked' : '' ?> >
                                        开启
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[quick_open]" value="20" data-am-ucheck
                                            <?= $model['quick_open'] == 20 ? 'checked' : '' ?> >
                                        关闭
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group am-padding-top">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label"> 秒杀时间 </label>
                                <div class="am-u-sm-9 am-u-md-6 am-u-lg-5 am-u-end">
                                    <!-- 会员等级列表-->
                                    <div class="am-input-group">
                                        <input type="text" class="j-laydate-quick am-form-field"
                                               name="goods[quick_time]"
                                               placeholder="秒杀时间"
                                               autocomplete="off"
                                               value="<?=$model['quick_time']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">其他设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">运费模板 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="goods[delivery_id]" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择运费模板'}">
                                        <option value="">请选择运费模板</option>
                                        <?php foreach ($delivery as $item): ?>
                                            <option value="<?= $item['delivery_id'] ?>"
                                                <?= $model['delivery_id'] == $item['delivery_id'] ? 'selected' : '' ?>>
                                                <?= $item['name'] ?> (<?= $item['method']['text'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= url('setting.delivery/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品状态 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[goods_status]" value="10" data-am-ucheck
                                            <?= $model['goods_status']['value'] == 10 ? 'checked' : '' ?> >
                                        上架
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[goods_status]" value="20" data-am-ucheck
                                            <?= $model['goods_status']['value'] == 20 ? 'checked' : '' ?> >
                                        下架
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">初始销量</label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="goods[sales_initial]"
                                           value="<?= $model['sales_initial'] ?>">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品排序 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="goods[goods_sort]"
                                           value="<?= $model['goods_sort'] ?>" required>
                                    <small>数字越小越靠前</small>
                                </div>
                            </div>

                            <!-- 会员折扣设置-->
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">会员折扣设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 是否开启会员折扣 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[is_enable_grade]" value="1" data-am-ucheck
                                            <?= $model['is_enable_grade'] == '1' ? 'checked' : '' ?>>
                                        开启
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[is_enable_grade]" value="0" data-am-ucheck
                                            <?= $model['is_enable_grade'] == '0' ? 'checked' : '' ?>>
                                        关闭
                                    </label>
                                    <div class="help-block">
                                        <small>如果不开启会员折扣，该商品则不享受会员等级折扣价</small>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-grade__content <?= $model['is_enable_grade'] == '0' ? 'hide' : '' ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 会员折扣设置 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <label class="am-radio-inline">
                                            <input type="radio" name="goods[is_alone_grade]" value="0" data-am-ucheck
                                                <?= $model['is_alone_grade'] == '0' ? 'checked' : '' ?>>
                                            默认折扣
                                        </label>
                                        <label class="am-radio-inline">
                                            <input type="radio" name="goods[is_alone_grade]" value="1" data-am-ucheck
                                                <?= $model['is_alone_grade'] == '1' ? 'checked' : '' ?>>
                                            单独设置折扣
                                        </label>
                                        <div class="help-block">
                                            <small>默认折扣：默认为用户所属会员等级的折扣率</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-grade-alone__content <?= $model['is_alone_grade'] == '0' ? 'hide' : '' ?>">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-u-lg-2 am-form-label"> </label>
                                        <div class="am-u-sm-9 am-u-md-6 am-u-lg-5 am-u-end">
                                            <!-- 会员等级列表-->
                                            <?php foreach ($gradeList as $item): ?>
                                                <div class="am-input-group am-margin-bottom-sm">
                                                    <span class="am-input-group-label am-input-group-label__left">
                                                        <?= $item['name'] ?>：
                                                    </span>
                                                    <input type="number" class="am-form-field"
                                                           name="goods[alone_grade_equity][<?= $item['grade_id'] ?>]"
                                                           value="<?= isset($model['alone_grade_equity'][$item['grade_id']])
                                                               ? $model['alone_grade_equity'][$item['grade_id']] : 0 ?>"
                                                           min="0" max="10" required>
                                                    <span class="am-input-group-label am-input-group-label__right">折</span>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="help-block">
                                                <small>注：折扣率范围0-10，9.5代表9.5折，0代表不折扣</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 分销设置-->
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">分销设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">是否开启单独分销 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[is_ind_dealer]" value="0" data-am-ucheck
                                            <?= $model['is_ind_dealer'] == false ? 'checked' : '' ?>>
                                        关闭
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[is_ind_dealer]" value="1" data-am-ucheck
                                            <?= $model['is_ind_dealer'] == true ? 'checked' : '' ?>>
                                        开启
                                    </label>
                                </div>
                            </div>
                            <div class="panel-dealer__content <?= $model['is_ind_dealer'] == false ? 'hide' : '' ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">分销佣金类型 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <label class="am-radio-inline">
                                            <input type="radio" name="goods[dealer_money_type]" value="10"
                                                   data-am-ucheck
                                                <?= $model['dealer_money_type'] == 10 ? 'checked' : '' ?>>
                                            百分比
                                        </label>
                                        <label class="am-radio-inline">
                                            <input type="radio" name="goods[dealer_money_type]" value="20"
                                                   data-am-ucheck
                                                <?= $model['dealer_money_type'] == 20 ? 'checked' : '' ?>>
                                            固定金额
                                        </label>
                                    </div>
                                </div>
                                <div class="am-form-group am-padding-top-sm">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">单独分销设置 </label>
                                    <?php
                                    $unit = [10 => '%', 20 => '元'];
                                    ?>
                                    <div class="am-u-sm-9 am-u-md-6 am-u-lg-5 am-u-end">
                                        <div class="am-input-group am-margin-bottom">
                                            <span class="am-input-group-label am-input-group-label__left">一级佣金：</span>
                                            <input type="text" name="goods[first_money]"
                                                   value="<?= $model['first_money'] ?>"
                                                   class="am-form-field">
                                            <span class="widget-dealer__unit am-input-group-label am-input-group-label__right">
                                                <?= $unit[$model['dealer_money_type']] ?>
                                            </span>
                                        </div>
                                        <div class="am-input-group am-margin-bottom">
                                            <span class="am-input-group-label am-input-group-label__left">二级佣金：</span>
                                            <input type="text" name="goods[second_money]"
                                                   value="<?= $model['second_money'] ?>"
                                                   class="am-form-field">
                                            <span class="widget-dealer__unit am-input-group-label am-input-group-label__right">
                                                <?= $unit[$model['dealer_money_type']] ?>
                                            </span>
                                        </div>
                                        <div class="am-input-group am-margin-bottom">
                                            <span class="am-input-group-label am-input-group-label__left">三级佣金：</span>
                                            <input type="text" name="goods[third_money]"
                                                   value="<?= $model['third_money'] ?>"
                                                   class="am-form-field">
                                            <span class="widget-dealer__unit am-input-group-label am-input-group-label__right">
                                                <?= $unit[$model['dealer_money_type']] ?>
                                            </span>
                                        </div>
                                        <div class="help-block">
                                            <p>
                                                <small>注：如需使用分销功能必须在 [分销中心 - 分销设置] 中开启</small>
                                            </p>
                                            <p>
                                                <small>注：如不开启单独分销则默认使用全局分销比例</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 门店分润设置-->
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">门店分润设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">是否开启单独门店分润 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[is_ind_shop]" value="0" data-am-ucheck
                                            <?= $model['is_ind_shop'] == false ? 'checked' : '' ?>>
                                        关闭
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="goods[is_ind_shop]" value="1" data-am-ucheck
                                            <?= $model['is_ind_shop'] == true ? 'checked' : '' ?>>
                                        开启
                                    </label>
                                </div>
                            </div>
                            <div class="panel-shop__content <?= $model['is_ind_shop'] == false ? 'hide' : '' ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">门店佣金类型 </label>
                                    <div class="am-u-sm-9 am-u-end">
                                        <label class="am-radio-inline">
                                            <input type="radio" name="goods[shop_money_type]" value="10"
                                                   data-am-ucheck
                                                <?= $model['shop_money_type'] == 10 ? 'checked' : '' ?>>
                                            百分比
                                        </label>
                                        <label class="am-radio-inline">
                                            <input type="radio" name="goods[shop_money_type]" value="20"
                                                   data-am-ucheck
                                                <?= $model['shop_money_type'] == 20 ? 'checked' : '' ?>>
                                            固定金额
                                        </label>
                                    </div>
                                </div>
                                <div class="am-form-group am-padding-top-sm">
                                    <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">单独门店分润设置 </label>
                                    <?php
                                    $unit = [10 => '%', 20 => '元'];
                                    ?>
                                    <div class="am-u-sm-9 am-u-md-6 am-u-lg-5 am-u-end">
                                        <div class="am-input-group am-margin-bottom">
                                            <span class="am-input-group-label am-input-group-label__left">自身佣金：</span>
                                            <input type="text" name="goods[first_shop_money]"
                                                   value="<?= $model['first_shop_money'] ?>"
                                                   class="am-form-field">
                                            <span class="widget-shop__unit am-input-group-label am-input-group-label__right">
                                                <?= $unit[$model['shop_money_type']] ?>
                                            </span>
                                        </div>
                                        <div class="am-input-group am-margin-bottom">
                                            <span class="am-input-group-label am-input-group-label__left">上级佣金：</span>
                                            <input type="text" name="goods[second_shop_money]"
                                                   value="<?= $model['second_shop_money'] ?>"
                                                   class="am-form-field">
                                            <span class="widget-shop__unit am-input-group-label am-input-group-label__right">
                                                <?= $unit[$model['dealer_money_type']] ?>
                                            </span>
                                        </div>
                                        
                                        <div class="help-block">
                                            
                                            <p>
                                                <small>注：如不开启单独门店分润则默认使用全局分销比例</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 表单提交按钮 -->
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" class="j-submit am-btn am-btn-secondary am-btn-sm">提交
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

<!-- 图片文件列表模板 -->
<script id="tpl-file-item" type="text/template">
    {{ each list }}
    <div class="file-item">
        <a href="{{ $value.file_path }}" title="点击查看大图" target="_blank">
            <img src="{{ $value.file_path }}">
        </a>
        <input type="hidden" name="{{ name }}" value="{{ $value.file_id }}">
        <i class="iconfont icon-shanchu file-item-delete"></i>
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


<script src="assets/common/js/vue.min.js"></script>
<script src="assets/common/js/ddsort.js"></script>
<script src="assets/common/plugins/umeditor/umeditor.config.js?v=<?= $version ?>"></script>
<script src="assets/common/plugins/umeditor/umeditor.min.js"></script>
<script src="assets/common/plugins/laydate/laydate.js"></script>
<script src="assets/store/js/goods.spec.js?v=<?= $version ?>"></script>
<script>
    $(function () {

        // 富文本编辑器
        UM.getEditor('container', {
            initialFrameWidth: 375 + 15,
            initialFrameHeight: 600
        });

        // 时间选择器
        laydate.render({
            elem: '.j-laydate-start'
            , type: 'datetime'
        });

        // 时间选择器
        laydate.render({
            elem: '.j-laydate-quick'
            , type: 'datetime'
        });
        // 时间选择器
        laydate.render({
            elem: '.j-laydate-end'
            , type: 'datetime'
        });


        // 选择图片
        $('.upload-file').selectImages({
            name: 'goods[images][]'
            , multiple: true
        });

        // 图片列表拖动
        $('.uploader-list').DDSort({
            target: '.file-item',
            delay: 100, // 延时处理，默认为 50 ms，防止手抖点击 A 链接无效
            floatStyle: {
                'border': '1px solid #ccc',
                'background-color': '#fff'
            }
        });

        // 切换单/多规格
        $('input:radio[name="goods[spec_type]"]').change(function (e) {
            var $goodsSpecMany = $('.goods-spec-many')
                , $goodsSpecSingle = $('.goods-spec-single');
            if (e.currentTarget.value === '10') {
                $goodsSpecMany.hide() && $goodsSpecSingle.show();
            } else {
                $goodsSpecMany.show() && $goodsSpecSingle.hide();
            }
        });

        // 注册商品多规格组件
        var specMany = new GoodsSpec({
            el: '#many-app',
            baseData: <?= $specData ?>
        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
            // 获取多规格sku数据
            buildData: function () {
                var specData = specMany.appVue.getData();
                return {
                    goods: {
                        spec_many: {
                            spec_attr: specData.spec_attr,
                            spec_list: specData.spec_list
                        }
                    }
                };
            },
            // 自定义验证
            validation: function () {
                var specType = $('input:radio[name="goods[spec_type]"]:checked').val();
                if (specType === '20') {
                    var isEmpty = specMany.appVue.isEmptySkuList();
                    isEmpty === true && layer.msg('商品规格不能为空');
                    return !isEmpty;
                }
                return true;
            }
        });

        // 是否开启单独分销
        var $panelDealer = $('.panel-dealer__content');
        $("input:radio[name='goods[is_ind_dealer]']").change(function (e) {
            // e.currentTarget.value === '0' ? $panelDealer.hide() : $panelDealer.show();
            $panelDealer.toggle();
        });

        // 选中百分比 后面显示% 选中固定金额 后面显示元
        $("input:radio[name='goods[dealer_money_type]']").change(function (e) {
            $('.widget-dealer__unit').text(e.currentTarget.value === '10' ? '%' : '元');
        });


        // 是否开启单独门店分润
        var $panelShop= $('.panel-shop__content');
        $("input:radio[name='goods[is_ind_shop]']").change(function (e) {
            // e.currentTarget.value === '0' ? $panelDealer.hide() : $panelDealer.show();
            $panelShop.toggle();
        });

        // 选中百分比 后面显示% 选中固定金额 后面显示元
        $("input:radio[name='goods[shop_money_type]']").change(function (e) {
            $('.widget-shop__unit').text(e.currentTarget.value === '10' ? '%' : '元');
        });

        // 是否开启会员折扣
        var $panelGrade = $('.panel-grade__content');
        $("input:radio[name='goods[is_enable_grade]']").change(function (e) {
            // e.currentTarget.value === '0' ? $panelGrade.toggle() : $panelGrade.toggle();
            $panelGrade.toggle();
        });

        // 单独设置折扣
        var $panelGradeAlone = $('.panel-grade-alone__content');
        $("input:radio[name='goods[is_alone_grade]']").change(function (e) {
            // e.currentTarget.value !== '0' ? $panelGradeAlone.hide() : $panelGradeAlone.show();
            $panelGradeAlone.toggle();
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
