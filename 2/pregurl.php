<?php
//匹配a标签正则 点击统计通过重定向
//$url  = 先跳到自己的url地址并携带url参数然后重定向到url参数的地址 / 替换为指定的a标签内容;
//$matches[1] = 匹配到a标签的内容;
//trans_content = '需要替换的字符串内容';
//$preg = 返回替换完的内容;
  $check = " |(?:<(?:a(?:rea)?)(?:.*?)\shref=['\"]*\s*)([^'\"<>]+\s*)(?:['\"]*)|";
        $preg = preg_replace_callback($check,
            function ($matches) use(&$deliveryTaskId) {
                return str_replace($matches[1], $url . "&url=" . urlencode($matches[1]), $matches[0]);
            }, $trans_content);
