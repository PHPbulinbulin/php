# txt下载header头信息

```php
header('Content-type: application/octet-stream');
header('Accept-Ranges: bytes');
header('Content-Disposition: attachment; filename =file.name'); //文件命名
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
```