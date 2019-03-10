<?php
//自己的控制器方法返回  return file_get_contents('./a.jpg');  图片内容
  $img = "<img src='自己的控制器方法返回图片' />";
  //在内容后面拼接上图片，通过http加载静态资源的方法实现自动请求图片等静态资源从而进行打开统计;
  $content = $content . $img;
