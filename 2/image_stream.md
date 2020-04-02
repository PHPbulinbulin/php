# 后端给前端返回图片问题

> 1.在web项目开发微信支付，使用微信扫码支付接口的时候，php语言使用qrcode库使用png方法生成的图片给前端，前端无法直接使用图片 。

### 解决方法：

使用**ob**缓存把生成的图片内容数据流进行缓存，然后使用**ob_get_contents**获取缓存的数据进行**base64_encode()**编码处理，然后返回给前端，前端使用**decode**解码输出。

`````php
<?php
$data = [
    'image' => '',
];
$url = 'http://test.com';
ob_start();
\QRcode::png($url);
//默认写死了png格式
$data['image'] = 'data:image/png;base64,' . base64_encode(ob_get_contents());
ob_end_clean();
return $data;
`````



