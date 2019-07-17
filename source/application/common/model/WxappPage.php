<?php

namespace app\common\model;

/**
 * 微信小程序diy页面模型
 * Class WxappPage
 * @package app\common\model
 */
class WxappPage extends BaseModel
{
    protected $name = 'wxapp_page';

    /**
     * 页面标题栏默认数据
     * @return array
     */
    public function getDefaultPage()
    {
        static $defaultPage = [];
        if (!empty($defaultPage)) return $defaultPage;
        return [
            'type' => 'page',
            'name' => '页面设置',
            'params' => [
                'name' => '页面名称',
                'title' => '页面标题',
                'share_title' => '分享标题'
            ],
            'style' => [
                'titleTextColor' => 'black',
                'titleBackgroundColor' => '#ffffff',
            ]
        ];
    }

    /**
     * 页面diy元素默认数据
     * @return array
     */
    public function getDefaultItems()
    {
        return [
            'search' => [
                'name' => '搜索框',
                'type' => 'search',
                'params' => ['placeholder' => '请输入关键字进行搜索'],
                'style' => [
                    'textAlign' => 'left',
                    'searchStyle' => 'square',
                    'paddingTop' => '10',
                    'paddingLeft' => '10',
                    'background' => '#f7f7f7'
                ]
            ],
            'banner' => [
                'name' => '图片轮播',
                'type' => 'banner',
                'style' => [
                    'btnColor' => '#ffffff',
                    'btnShape' => 'round',
                    'paddingTop' => '10',
                    'paddingLeft' => '10',
                    'background' => '#f7f7f7'
                ],
                'params' => [
                    'interval' => '2800'
                ],
                'data' => [
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/banner/01.png',
                        'linkUrl' => ''
                    ],
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/banner/01.png',
                        'linkUrl' => ''
                    ]
                ]
            ],
            'imageSingle' => [
                'name' => '单图组',
                'type' => 'imageSingle',
                'style' => [
                    'paddingTop' => 0,
                    'paddingLeft' => 0,
                    'background' => '#ffffff'
                ],
                'data' => [
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/banner/01.png',
                        'imgName' => 'image-1.jpg',
                        'linkUrl' => ''
                    ],
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/banner/01.png',
                        'imgName' => 'banner-2.jpg',
                        'linkUrl' => ''
                    ]
                ]
            ],
            'navBar' => [
                'name' => '导航组',
                'type' => 'navBar',
                'style' => [
                    'background' => '#ffffff', 
                    'rowsNum' => '4',
                    'paddingTop' => 0,
                    'paddingLeft' => 0,
                ],
                'data' => [
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/navbar/01.png',
                        'imgName' => 'icon-1.png',
                        'linkUrl' => '',
                        'text' => '按钮文字1',
                        'color' => '#666666'
                    ],
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/navbar/01.png',
                        'imgName' => 'icon-2.jpg',
                        'linkUrl' => '',
                        'text' => '按钮文字2',
                        'color' => '#666666'
                    ],
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/navbar/01.png',
                        'imgName' => 'icon-3.jpg',
                        'linkUrl' => '',
                        'text' => '按钮文字3',
                        'color' => '#666666'
                    ],
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/navbar/01.png',
                        'imgName' => 'icon-4.jpg',
                        'linkUrl' => '',
                        'text' => '按钮文字4',
                        'color' => '#666666'
                    ]
                ]
            ],
            'blank' => [
                'name' => '辅助空白',
                'type' => 'blank',
                'style' => [
                    'height' => '20',
                    'background' => '#ffffff'
                ]
            ],
            'guide' => [
                'name' => '辅助线',
                'type' => 'guide',
                'style' => [
                    'background' => '#ffffff',
                    'lineStyle' => 'solid',
                    'lineHeight' => '1',
                    'lineColor' => "#000000",
                    'paddingTop' => 10
                ]
            ],
            'video' => [
                'name' => '视频组',
                'type' => 'video',
                'params' => [
                    'videoUrl' => 'http://wxsnsdy.tc.qq.com/105/20210/snsdyvideodownload?filekey=30280201010421301f0201690402534804102ca905ce620b1241b726bc41dcff44e00204012882540400',
                    'poster' => self::$base_url . 'assets/store/img/diy/video_poster.png',
                    'autoplay' => '0'
                ],
                'style' => [
                    'paddingTop' => '0',
                    'height' => '190'
                ]
            ],
            'article' => [
                'name' => '文章组',
                'type' => 'article',
                'params' => [
                    'source' => 'auto', // choice; auto
                    'auto' => [
                        'category' => 0,
                        'showNum' => 6
                    ]
                ],
                'style' => [],
                // '自动获取' => 默认数据
                'defaultData' => [
                    [
                        'article_title' => '此处显示文章标题',
                        'show_type' => 10,
                        'image' => self::$base_url . 'assets/store/img/diy/article/01.png',
                        'views_num' => '309'
                    ],
                    [
                        'article_title' => '此处显示文章标题',
                        'show_type' => 10,
                        'image' => self::$base_url . 'assets/store/img/diy/article/01.png',
                        'views_num' => '309'
                    ]
                ],
                // '手动选择' => 默认数据
                'data' => []
            ],
            'special' => [
                'name' => '头条快报',
                'type' => 'special',
                'params' => [
                    'source' => 'auto', // choice; auto
                    'auto' => [
                        'category' => 0,
                        'showNum' => 6
                    ]
                ],
                'style' => [
                    'display' => '1',
                    'image' => self::$base_url . 'assets/store/img/diy/special.png'
                ],
                // '自动获取' => 默认数据
                'defaultData' => [
                    [
                        'article_title' => '张小龙4小时演讲：你和高手之间，隔着“简单”二字'
                    ],
                    [
                        'article_title' => '张小龙4小时演讲：你和高手之间，隔着“简单”二字'
                    ]
                ],
                // '手动选择' => 默认数据
                'data' => []
            ],
            'notice' => [
                'name' => '公告组',
                'type' => 'notice',
                'params' => [
                    'text' => '这里是第一条自定义公告的标题',
                    'icon' => self::$base_url . 'assets/store/img/diy/notice.png'
                ],
                'style' => [
                    'paddingTop' => '4',
                    'background' => '#ffffff',
                    'textColor' => '#000000'
                ]
            ],
            'richText' => [
                'name' => '富文本',
                'type' => 'richText',
                'params' => [
                    'content' => '<p>这里是文本的内容</p>'
                ],
                'style' => [
                    'paddingTop' => '0',
                    'paddingLeft' => '0',
                    'background' => '#ffffff'
                ]
            ],
            'window' => [
                'name' => '图片橱窗',
                'type' => 'window',
                'style' => [
                    'paddingTop' => '0',
                    'paddingLeft' => '0',
                    'background' => '#ffffff',
                    'layout' => '2'
                ],
                'data' => [
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/window/01.jpg',
                        'linkUrl' => ''
                    ],
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/window/02.jpg',
                        'linkUrl' => ''
                    ],
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/window/03.jpg',
                        'linkUrl' => ''
                    ],
                    [
                        'imgUrl' => self::$base_url . 'assets/store/img/diy/window/04.jpg',
                        'linkUrl' => ''
                    ]
                ],
                'dataNum' => 4
            ],
            'goods' => [
                'name' => '商品组',
                'type' => 'goods',
                'params' => [
                    'source' => 'auto', // choice; auto
                    'auto' => [
                        'category' => 0,
                        'goodsSort' => 'all', // all; sales; price
                        'showNum' => 6
                    ]
                ],
                'style' => [
                    'background' => '#F6F6F6',
                    'display' => 'list', // list; slide
                    'column' => '2',
                    'show' => [
                        'goodsName' => '1',
                        'goodsPrice' => '1',
                        'linePrice' => '1',
                        'sellingPoint' => '0',
                        'goodsSales' => '0',
                    ]
                ],
                // '自动获取' => 默认数据
                'defaultData' => [
                    [
                        'goods_name' => '此处显示商品名称',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'goods_price' => '99.00',
                        'line_price' => '139.00',
                        'selling_point' => '此款商品美观大方 不容错过',
                        'goods_sales' => '100',
                    ],
                    [
                        'goods_name' => '此处显示商品名称',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'goods_price' => '99.00',
                        'line_price' => '139.00',
                        'selling_point' => '此款商品美观大方 不容错过',
                        'goods_sales' => '100',
                    ],
                    [
                        'goods_name' => '此处显示商品名称',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'goods_price' => '99.00',
                        'line_price' => '139.00',
                        'selling_point' => '此款商品美观大方 不容错过',
                        'goods_sales' => '100',
                    ],
                    [
                        'goods_name' => '此处显示商品名称',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'goods_price' => '99.00',
                        'line_price' => '139.00',
                        'selling_point' => '此款商品美观大方 不容错过',
                        'goods_sales' => '100',
                    ]
                ],
                // '手动选择' => 默认数据
                'data' => [
                    [
                        'goods_name' => '此处显示商品名称',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'goods_price' => '99.00',
                        'line_price' => '139.00',
                        'selling_point' => '此款商品美观大方 不容错过',
                        'goods_sales' => '100',
                        'is_default' => true
                    ],
                    [
                        'goods_name' => '此处显示商品名称',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'goods_price' => '99.00',
                        'line_price' => '139.00',
                        'selling_point' => '此款商品美观大方 不容错过',
                        'goods_sales' => '100',
                        'is_default' => true
                    ]
                ]
            ],
            'quickGoods' => [
                'name' => '秒杀商品组',
                'type' => 'quickGoods',
                'params' => [
                    'title'=>'秒杀专区',
                    'sub_title'=>'一件也是拿货价'
                ],
                'style' => [
                    'background' => '#F6F6F6',
                    'paddingTop' => '0',
                    'paddingBottom' => '0',
                ],
                // '自动获取' => 默认数据
                'defaultData' => [
                    [
                        'time'=>'08:00',
                        'goods'=>[
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ]
                        ]
                    ],
                    [
                        'time'=>'10:00',
                        'goods'=>[
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ]
                        ]
                    ],
                    [
                        'time'=>'12:00',
                        'goods'=>[
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ]
                        ]
                    ],
                    [
                        'time'=>'14:00',
                        'goods'=>[
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                            ]
                        ]
                    ]
                ],
                // '手动选择' => 默认数据
                'data' => [
                    
                ]
            ],
            'adviceGoods' => [
                'name' => '推荐商品组',
                'type' => 'adviceGoods',
                'params' => [
                    'title'=>'精挑细选',
                    'sub_title'=>'人工优先好货',
                    'load'=>'no',
                ],
                'style' => [
                    'background' => '#F6F6F6',
                    'paddingTop' => '0',
                    'paddingBottom' => '0',
                ],
                // '自动获取' => 默认数据
                'defaultData' => [
                    [
                        'tag_text'=>'今日新品',
                        'tag_value'=>1,
                        'goods'=>[
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                                'sale_num'=>10,
                                'sale_remain'=>10,
                                'buy_time'=>date('m月d日'),
                                'get_time'=>date('m月d日',strtotime('+ 1day'))
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                                'sale_num'=>10,
                                'sale_remain'=>10,
                                'buy_time'=>date('m月d日'),
                                'get_time'=>date('m月d日',strtotime('+ 1day'))
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                                'sale_num'=>10,
                                'sale_remain'=>10,
                                'buy_time'=>date('m月d日'),
                                'get_time'=>date('m月d日',strtotime('+ 1day'))
                            ],
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                                'sale_num'=>10,
                                'sale_remain'=>10,
                                'buy_time'=>date('m月d日'),
                                'get_time'=>date('m月d日',strtotime('+ 1day'))
                            ],
                        ]
                    ],
                    [
                        'tag_text'=>'夏日必备',
                        'tag_value'=>2,
                        'goods'=>[
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                                'sale_num'=>10,
                                'sale_remain'=>10,
                                'buy_time'=>date('Y-m月d日'),
                                'get_time'=>date('m月d日',strtotime('+ 1day'))
                            ],
                        ]
                    ],
                    [
                        'tag_text'=>'新鲜水果',
                        'tag_value'=>3,
                        'goods'=>[
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                                'sale_num'=>10,
                                'sale_remain'=>10,
                                'buy_time'=>date('Y-m月d日'),
                                'get_time'=>date('m月d日',strtotime('+ 1day'))
                            ],
                        ]
                    ],
                    [
                        'tag_text'=>'休闲必备',
                        'tag_value'=>4,
                        'goods'=>[
                            [
                                'goods_name' => '此处显示商品名称',
                                'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                                'goods_price' => '99.00',
                                'line_price' => '139.00',
                                'sale_num'=>10,
                                'sale_remain'=>10,
                                'buy_time'=>date('Y-m月d日'),
                                'get_time'=>date('m月d日',strtotime('+ 1day'))
                            ],
                        ]
                    ]
                ],
                'data' => [
                    
                ],
            ],
            'coupon' => [
                'name' => '优惠券组',
                'type' => 'coupon',
                'style' => [
                    'paddingTop' => '10',
                    'background' => '#ffffff'
                ],
                'params' => [
                    'limit' => '5'
                ],
                'data' => [
                    [
                        'color' => 'red',
                        'reduce_price' => '10',
                        'min_price' => '100.00'
                    ],
                    [
                        'color' => 'violet',
                        'reduce_price' => '10',
                        'min_price' => '100.00'
                    ]
                ]
            ],
            'sharingGoods' => [
                'name' => '拼团商品组',
                'type' => 'sharingGoods',
                'params' => [
                    'source' => 'auto', // choice; auto
                    'auto' => [
                        'category' => 0,
                        'goodsSort' => 'all', // all; sales; price
                        'showNum' => 6
                    ]
                ],
                'style' => [
                    'background' => '#F6F6F6',
                    'show' => [
                        'goodsName' => '1',
                        'sellingPoint' => '1',
                        'sharingPrice' => '1',
                        'linePrice' => '1'
                    ]
                ],
                // '自动获取' => 默认数据
                'defaultData' => [
                    [
                        'goods_name' => '此处是拼团商品',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'selling_point' => '此款商品美观大方 性价比较高 不容错过',
                        'sharing_price' => '99.00',
                        'line_price' => '139.00',
                    ],
                    [
                        'goods_name' => '此处是拼团商品',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'selling_point' => '此款商品美观大方 性价比较高 不容错过',
                        'goods_price' => '99.00',
                        'line_price' => '139.00',
                    ],
                    [
                        'goods_name' => '此处是拼团商品',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'selling_point' => '此款商品美观大方 性价比较高 不容错过',
                        'sharing_price' => '99.00',
                        'line_price' => '139.00',
                    ],
                    [
                        'goods_name' => '此处是拼团商品',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'selling_point' => '此款商品美观大方 性价比较高 不容错过',
                        'sharing_price' => '99.00',
                        'line_price' => '139.00',
                    ]
                ],
                // '手动选择' => 默认数据
                'data' => [
                    [
                        'goods_name' => '此处是拼团商品',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'selling_point' => '此款商品美观大方 性价比较高 不容错过',
                        'sharing_price' => '99.00',
                        'line_price' => '139.00',
                        'is_default' => true
                    ],
                    [
                        'goods_name' => '此处是拼团商品',
                        'image' => self::$base_url . 'assets/store/img/diy/goods/01.png',
                        'selling_point' => '此款商品美观大方 性价比较高 不容错过',
                        'sharing_price' => '99.00',
                        'line_price' => '139.00',
                        'is_default' => true
                    ]
                ]
            ],
            'shop' => [
                'name' => '线下门店',
                'type' => 'shop',
                'params' => [
                    'source' => 'auto', // choice; auto
                    'auto' => [
                        'showNum' => 6
                    ]
                ],
                'style' => [

                ],
                // '自动获取' => 默认数据
                'defaultData' => [
                    [
                        'shop_name' => '此处显示门店名称',
                        'logo_image' => self::$base_url . 'assets/store/img/diy/circular.png',
                        'phone' => '010-6666666',
                        'region' => [
                            'province' => 'xx省',
                            'city' => 'xx市',
                            'region' => 'xx区'
                        ],
                        'address' => 'xx街道',
                    ],
                    [
                        'shop_name' => '此处显示门店名称',
                        'logo_image' => self::$base_url . 'assets/store/img/diy/circular.png',
                        'phone' => '010-6666666',
                        'region' => [
                            'province' => 'xx省',
                            'city' => 'xx市',
                            'region' => 'xx区'
                        ],
                        'address' => 'xx街道',
                    ],
                ],
                // '手动选择' => 默认数据
                'data' => [
                    [
                        'shop_name' => '此处显示门店名称',
                        'logo_image' => self::$base_url . 'assets/store/img/diy/circular.png',
                        'phone' => '010-6666666',
                        'region' => [
                            'province' => 'xx省',
                            'city' => 'xx市',
                            'region' => 'xx区'
                        ],
                        'address' => 'xx街道',
                    ],
                ]
            ],
            'currentshop' => [
                'name' => '当前门店',
                'type' => 'currentshop',
                'params' => [
                    'source' => 'auto', // choice; auto
                    'auto' => [
                        'showNum' => 1
                    ],
                    'switch'=>'auto'
                ],
                'style' => [
                    'paddingTop' => '10',
                    'paddingLeft' => '10',
                    'background' => '#f7f7f7',
                    'contentBackground'=>'#ffffff'
                ],
                // '自动获取' => 默认数据
                'defaultData' => [
                    [
                        'shop_name' => '此处显示门店名称',
                        'logo_image' => self::$base_url . 'assets/store/img/diy/circular.png',
                        'phone' => '010-6666666',
                        'region' => [
                            'province' => 'xx省',
                            'city' => 'xx市',
                            'region' => 'xx区'
                        ],
                        'address' => 'xx街道',
                    ]
                ],
                // '手动选择' => 默认数据
                'data' => [
                    
                ]
            ],
            'service' => [
                'name' => '在线客服',
                'type' => 'service',
                'params' => [
                    'type' => 'chat',     // '客服类型' => chat在线聊天，phone拨打电话
                    'image' => self::$base_url . 'assets/store/img/diy/service.png',
                    'phone_num' => ''
                ],
                'style' => [
                    'right' => '1',
                    'bottom' => '10',
                    'opacity' => '100'
                ]
            ],
            'share' => [
                'name' => '分享',
                'type' => 'share',
                'params' => [
                    'image' => self::$base_url . 'assets/store/img/diy/share.png',
                ],
                'style' => [
                    'right' => '1',
                    'bottom' => '10',
                    'opacity' => '100'
                ]
            ],
            'currentBuy' => [
                'name' => '即刻购买',
                'type' => 'currentBuy',
                'params' => [
                    
                ],
                'style' => [
                    'left' => '1',
                    'bottom' => '10',
                    'opacity' => '100'
                ]
            ]
        ];
    }

    /**
     * 格式化页面数据
     * @param $json
     * @return array
     */
    public function getPageDataAttr($json)
    {
        // 旧版数据转义
        $array = $this->_transferToNewData($json);
        // 合并默认数据
        return $this->_mergeDefaultData($array);
    }

    /**
     * 自动转换data为json格式
     * @param $value
     * @return string
     */
    public function setPageDataAttr($value)
    {
        return json_encode($value ?: ['items' => []]);
    }

    /**
     * diy页面详情
     * @param int $page_id
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function detail($page_id)
    {
        return static::get(['page_id' => $page_id]);
    }

    /**
     * diy页面详情
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function getHomePage()
    {
        return self::get(['page_type' => 10]);
    }

    /**
     * 旧版数据转义为新版格式
     * @param $json
     * @return array
     */
    private function _transferToNewData($json)
    {
        $array = json_decode($json, true);
        $items = $array['items'];
        if (isset($items['page'])) {
            unset($items['page']);
        }
        foreach ($items as &$item) {
            isset($item['data']) && $item['data'] = array_values($item['data']);
        }
        return [
            'page' => isset($array['page']) ? $array['page'] : $array['items']['page'],
            'items' => array_values(array_filter($items))
        ];
    }

    /**
     * 合并默认数据
     * @param $array
     * @return mixed
     */
    private function _mergeDefaultData($array)
    {
        $array['page'] = array_merge_multiple($this->getDefaultPage(), $array['page']);
        $defaultItems = $this->getDefaultItems();
        foreach ($array['items'] as &$item) {
            if (isset($defaultItems[$item['type']])) {
                array_key_exists('data', $item) && $defaultItems[$item['type']]['data'] = [];
                $item = array_merge_multiple($defaultItems[$item['type']], $item);
            }
        }
        return $array;
    }

}
