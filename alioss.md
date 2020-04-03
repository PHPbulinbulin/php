# 使用阿里云oss存储（已弃用）

> composer 安装依赖
>
> ```composer
> composer require aliyuncs/oss-sdk-php
> ```

##### 使用：

```php
<?php
$filePath = '';      //文件路径 
$fileName = '';      //文件名
$ossKey = '';        //创建oss空间后获取 key
$ossSkey = '';       //skey
$ossUrl = '';        //oss域名
$ossSpaceName = '';  //空间名
$ossClient = new OssClient($ossKey, $ossSKey, $ossUrl);
$info = $ossClient -> uploadFile($ossSpaceName, $filename, $filePath);
//公开空间到这里就可以
return $info['oss-request-url']; 
```

##### 私有空间访问资源：

```php
/**
 * @params $filename 文件名
 * @params $validTime 有效时间
 */
function privateView($filename, $validtime = 3600){
   $ossKey = '';        //创建oss空间后获取 key
   $ossSkey = '';       //skey
   $ossSpaceName = '';  //空间名
   $ossClient = new OssClient($ossKey, $ossSkey, $ossSpaceName, false);
   // 生成GetObject的签名URL。
   $signedUrl = $ossClient->signUrl($ossSpaceName, $filename, $timeout);
   return $signedUrl;
}
```



##### 关于php文件上传:

**上传文件产生的临时文件，无论你是否进行处理，都将在接收上传的 php 程序结束之时被删去**，
**可以通过 move_uploaded_file函数移动临时文件到服务器某个文件夹里保存，这里使用oss就没必要在服务器进行存储了。**