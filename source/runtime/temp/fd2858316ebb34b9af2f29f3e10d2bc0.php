<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:98:"/www/wwwroot/jqg.wanheezg.com/shop/web/../source/application/store/view/market/basic/full_free.php";i:1560414033;s:83:"/www/wwwroot/jqg.wanheezg.com/shop/source/application/store/view/layouts/layout.php";i:1560414032;}*/ ?>
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
            <div id="app" class="widget am-cf" v-cloak>
                <form id="my-form" class="am-form tpl-form-line-form" enctype="multipart/form-data" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">满额包邮设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3  am-u-lg-2 am-form-label form-require"> 是否开启满额包邮 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="model[is_open]" value="1" data-am-ucheck
                                            <?= $values['is_open'] ? 'checked' : '' ?>> 开启
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="model[is_open]" value="0" data-am-ucheck
                                            <?= $values['is_open'] ? '' : 'checked' ?>> 关闭
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">单笔订单满 </label>
                                <div class="am-u-sm-9 am-u-md-6 am-u-lg-5 am-u-end">
                                    <div class="am-input-group">
                                        <input type="number" name="model[money]" value="<?= $values['money'] ?>"
                                               class="am-form-field am-field-valid" required>
                                        <span class="widget-dealer__unit am-input-group-label am-input-group-label__right">元</span>
                                    </div>
                                    <small>如果开启满额包邮，设置0为全场包邮</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3  am-u-lg-2 am-form-label"> 不参与包邮的商品 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="widget-become-goods am-form-file am-margin-top-xs">
                                        <button type="button" @click.stop="onSelectGoods"
                                                class="j-selectGoods upload-file am-btn am-btn-secondary am-radius">
                                            <i class="am-icon-cloud-upload"></i> 选择商品
                                        </button>
                                        <div class="widget-goods-list uploader-list am-cf">
                                            <div v-for="(item, index) in goodsList" class="file-item">
                                                <a :href="item.goods_image" :title="item.goods_name" target="_blank">
                                                    <img :src="item.goods_image">
                                                </a>
                                                <input type="hidden" name="model[notin_goods][]" :value="item.goods_id">
                                                <i class="iconfont icon-shanchu file-item-delete"
                                                   data-no-click="true" @click.stop="onDeleteGoods(index)"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3  am-u-lg-2 am-form-label"> 不参与包邮的地区 </label>
                                <div class="am-u-sm-9 am-u-end am-padding-top-xs">
                                    <a href="javascript:void(0);" class="am-btn am-btn-default am-btn-xs"
                                       @click.stop="onAddRegionEvent">
                                        <i class="iconfont icon-dingwei"></i>
                                        选择地区
                                    </a>
                                    <div class="help-block">
                                        <small class="x-color-555">
                                            <span v-if="checked.citys.length == 373">全国</span>
                                            <template v-else v-for="(province, index) in checked.treeData">
                                                <span>{{ province.name }}</span>
                                                <template v-if="!province.isAllCitys">
                                                    (<span class="am-link-muted">
                                                                    <template v-for="(city, index) in province.citys">
                                                                        <span>{{ city.name }}</span><span
                                                                                v-if="(index + 1) < province.citys.length">、</span>
                                                                    </template>
                                                                </span>)
                                                </template>
                                            </template>
                                        </small>
                                    </div>
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

                <!-- 地区选择 -->
                <div ref="choice" class="regional-choice">
                    <div class="place-div">
                        <div>
                            <div class="checkbtn">
                                <label>
                                    <input type="checkbox" @change="onCheckAll(!checkAll)" :checked="checkAll">
                                    全选</label>
                                <a class="clearCheck" href="javascript:void(0);" @click="onCheckAll(false)">清空</a>
                            </div>
                            <div class="place clearfloat">
                                <div class="smallplace clearfloat">
                                    <div v-for="item in regions" class="place-tooltips">
                                        <label>
                                            <input type="checkbox" class="province"
                                                   :value="item.id"
                                                   :checked="inArray(item.id, checked.province, true)"
                                                   @change="onCheckedProvince">
                                            <span class="province_name">{{ item.name }}</span>
                                            <span class="ratio"></span>
                                        </label>
                                        <div class="citys">
                                            <i class="jt"><i></i></i>
                                            <div class="row-div clearfloat">
                                                <p v-for="city in item.city">
                                                    <label>
                                                        <input class="city" type="checkbox"
                                                               :value="city.id"
                                                               :checked="inArray(city.id, checked.citys)"
                                                               @change="onCheckedCity($event, item.id)">
                                                        <span>{{ city.name }}</span>
                                                    </label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="assets/common/js/vue.min.js?v=<?= $version ?>"></script>
<script src="assets/store/js/select.data.js?v=<?= $version ?>"></script>
<script>
    $(function () {

        // 不参与包邮的地区：选择地区
        var app = new Vue({
            el: '#app',
            data: {
                // 商品列表
                goodsList: <?= json_encode($goodsList) ?>,
                // 所有地区
                regions: <?= json_encode($regionData) ?>,
                // 全选状态
                checkAll: false,
                // 当前选择的地区id集
                checked: <?= json_encode($values['notin_region']) ?>
            },

            created: function () {
                var app = this;
                // 初始化已选择的地区
                app.initializeChecked();
            },

            methods: {

                // 初始化已选择的地区
                initializeChecked: function () {
                    var app = this;
                    var data = app.checked;
                    // 转换为整数型
                    for (var provinceKey in  data.province) {
                        if (data.province.hasOwnProperty(provinceKey)) {
                            data.province[provinceKey] = parseInt(data.province[provinceKey]);
                        }
                    }
                    for (var cityKey in  data.citys) {
                        if (data.citys.hasOwnProperty(cityKey)) {
                            data.citys[cityKey] = parseInt(data.citys[cityKey]);
                        }
                    }
                    data.treeData = app.getTreeData({
                        province: data.province,
                        citys: data.citys
                    });
                },

                // 选择商品
                onSelectGoods: function () {
                    var app = this;
                    $.selectData({
                        title: '选择商品',
                        uri: 'goods/lists&status=10',
                        duplicate: false,
                        dataIndex: 'goods_id',
                        done: function (data) {
                            data.forEach(function (item) {
                                app.goodsList.push(item);
                            });
                        },
                        getExistData: function () {
                            var goodsIds = [];
                            app.goodsList.forEach(function (item) {
                                goodsIds.push(item.goods_id);
                            });
                            return goodsIds;
                        }
                    });
                },

                // 删除商品
                onDeleteGoods: function (index) {
                    var app = this;
                    return app.goodsList.splice(index, 1);
                },

                // 添加配送区域
                onAddRegionEvent: function () {
                    var app = this;
                    // 显示选择可配送区域弹窗
                    app.onShowCheckBox({
                        complete: function (data) {
                            // 选择完成后新增form项
                            app.checked = {
                                province: data.province,
                                citys: data.citys,
                                treeData: app.getTreeData(data)
                            };
                            // Vue.set(app.checked, {
                            //     province: data.province,
                            //     citys: data.citys,
                            //     treeData: app.getTreeData(data)
                            // });
                        }
                    });
                },

                // 全选
                onCheckAll: function (checked) {
                    var app = this;
                    app.checkAll = checked;
                    // 遍历能选择的地区
                    for (var key in  app.regions) {
                        if (app.regions.hasOwnProperty(key)) {
                            var provinceId = parseInt(app.regions[key].id);
                            this.checkedProvince(provinceId, app.checkAll);
                        }
                    }
                },

                // 显示选择可配送区域弹窗
                onShowCheckBox: function (option) {
                    var app = this;
                    var options = $.extend(true, {
                        checkedData: null,
                        complete: $.noop()
                    }, option);
                    // 取消全选按钮
                    app.checkAll = false;
                    // 开启弹窗
                    layer.open({
                        type: 1,
                        shade: false,
                        title: '选择可配送区域',
                        btn: ['确定', '取消'],
                        area: ['820px', '520px'], //宽高
                        content: $(this.$refs['choice']),
                        yes: function (index) {
                            options.complete(app.checked);
                            layer.close(index);
                        }
                    });
                },

                // 选择省份
                onCheckedProvince: function (e) {
                    var provinceId = parseInt(e.target.value);
                    this.checkedProvince(provinceId, e.target.checked);
                },

                checkedProvince: function (provinceId, checked) {
                    var app = this;
                    // 更新省份选择
                    var index = app.checked.province.indexOf(provinceId);
                    if (!checked) {
                        index > -1 && app.checked.province.splice(index, 1);
                    } else {
                        index === -1 && app.checked.province.push(provinceId);
                    }
                    // 更新城市选择
                    var cityIds = app.regions[provinceId].city;
                    for (var cityIndex in cityIds) {
                        if (cityIds.hasOwnProperty(cityIndex)) {
                            var cityId = parseInt(cityIndex);
                            var checkedIndex = app.checked.citys.indexOf(cityId);
                            if (!checked) {
                                checkedIndex > -1 && app.checked.citys.splice(checkedIndex, 1)
                            } else {
                                checkedIndex === -1 && app.checked.citys.push(cityId);
                            }
                        }
                    }
                },

                // 选择城市
                onCheckedCity: function (e, provinceId) {
                    var cityId = parseInt(e.target.value);
                    if (!e.target.checked) {
                        var index = this.checked.citys.indexOf(cityId);
                        index > -1 && this.checked.citys.splice(index, 1)
                    } else {
                        this.checked.citys.push(cityId);
                    }
                    // 更新省份选中状态
                    this.onUpdateProvinceChecked(parseInt(provinceId));
                },

                // 更新省份选中状态
                onUpdateProvinceChecked: function (provinceId) {
                    var provinceIndex = this.checked.province.indexOf(provinceId);
                    var isExist = provinceIndex > -1;
                    if (!this.onHasCityChecked(provinceId)) {
                        isExist && this.checked.province.splice(provinceIndex, 1);
                    } else {
                        !isExist && this.checked.province.push(provinceId);
                    }
                },

                // 是否存在城市被选中
                onHasCityChecked: function (provinceId) {
                    var app = this;
                    var cityIds = this.regions[provinceId].city;
                    for (var cityId in cityIds) {
                        if (cityIds.hasOwnProperty(cityId)
                            && app.inArray(parseInt(cityId), app.checked.citys))
                            return true;
                    }
                    return false;
                },

                // 将选中的区域id集格式化为树状格式
                getTreeData: function (checkedData) {
                    var app = this;
                    var treeData = {};
                    checkedData.province.forEach(function (provinceId) {
                        var province = app.regions[provinceId]
                            , citys = []
                            , cityCount = 0;
                        for (var cityIndex in province.city) {
                            if (province.city.hasOwnProperty(cityIndex)) {
                                var cityItem = province.city[cityIndex];
                                if (app.inArray(cityItem.id, checkedData.citys)) {
                                    citys.push({id: cityItem.id, name: cityItem.name});
                                }
                                cityCount++;
                            }
                        }
                        treeData[province.id] = {
                            id: province.id,
                            name: province.name,
                            citys: citys,
                            isAllCitys: citys.length === cityCount
                        };
                    });
                    return treeData;
                },

                // 数组中是否存在指定的值
                inArray: function (val, array, isTest) {
                    if (isTest) {
                        // console.log(array);
                    }
                    return array.indexOf(val) > -1;
                },

                // 对象的属性是否存在
                isPropertyExist: function (key, obj) {
                    return obj.hasOwnProperty(key);
                },

                // 数组合并
                arrayMerge: function (arr1, arr2) {
                    return arr1.concat(arr2);
                }
            }

        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
            buildData: function () {
                var notin_region = {province: app.checked.province, citys: app.checked.citys};
                return {model: {notin_region: notin_region}};
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
