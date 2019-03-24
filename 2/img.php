<?php
//php中qrcode库使用png方法会直接返回图片给前端,前端无法直接使用图片
//解决方法
//使用ob缓存把生成的图片内容数据流进行缓存,然后使用ob_get_contents获取缓存的数据进行base64处理,然后返回给前端
ob_start();
\QRcode::png($info['data']['url']);

$data['pay_qrcode'] = 'data:image/png;base64,' . base64_encode(ob_get_contents());
ob_end_clean();
