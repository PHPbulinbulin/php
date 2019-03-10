<?php
/*
 * curl库
 * */
function httpRequest($api, $postData = array())
{
    //1.初始化
    $ch = curl_init();
    //2.配置
    //2.1设置请求地址
    curl_setopt($ch, CURLOPT_URL, $api);
    //2.2数据流不直接输出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
    //2.3POST请求
    if ($postData) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    }
    //curl注意事项，如果发送的请求是https，必须要禁止服务器端校检SSL证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //3.发送请求
    $data = curl_exec($ch);
    //4.释放资源
    curl_close($ch);
    return $data;
}
