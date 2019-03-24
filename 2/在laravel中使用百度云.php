<?php
//使用composer安装阿里云 
//composer require aliyuncs/oss-sdk-php

//引入命名空间
use OSS\OssClient;

public function aliUpload(Request $request)
{
    if ($request->isMethod('post')) {
        $tmpFile = $request->file('file');  //获取文件类型
        $filename = date('YmdHis') . md5(uniqid(true)) . '.' . $tmpFile->getClientOriginalExtension(); //生成日期+随机数字的文件名 $tmFile->getClientOriginalExtension();获取文件后缀名
        $filePath = $tmpFile->getPath() . '/' . $tmpFile->getFilename();// 获取临时文件
        $ossClient = new OssClient(key, skey, 域名url);
        $info = $ossClient -> uploadFile(空间名, $filename, $filePath); //为了获取上传后的文件信息
       // $url = $info['oss-request-url']; //上传后的oss文件链接
        $url = aliView($filename);
        $data = [
            'id' => $filename,
            'src' => $url,
        ];
        return res('pass','',$data);
    }
}

/*
 * 私有空间获取查看图片权限
 * */
function aliView($filename){
    $timeout = 300;
    try {
        $ossClient = new OssClient(key, skey, 阿里云url, false);
        // 生成GetObject的签名URL。
        $signedUrl = $ossClient->signUrl(空间名, $filename, $timeout);
    } catch (OssException $e) {
        printf(__FUNCTION__ . ": FAILED\n");
        printf($e->getMessage() . "\n");
        return;
    }
    return $signedUrl;
}
