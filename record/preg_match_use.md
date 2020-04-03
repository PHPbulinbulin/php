# 正则匹配

> 1.匹配email

```php
<?php
preg_match('/@(.*)$/', $email, $matches, PREG_OFFSET_CAPTURE);
$url = $matches[1][0];
```

> 2.匹配替换a标签的ur，最终跳转a标签的url
>
> ```php
> <?php
> //替换为你想要的url
> $customUrl = 'http://test.com';
> //mock a标签
> $replaceContent = '<a href="http://www.w3school.com.cn">W3School</a>';
> //规则
> $rule = " |(?:<(?:a(?:rea)?)(?:.*?)\shref=['\"]*\s*)([^'\"<>]+\s*)(?:['\"]*)|";
> $preg = preg_replace_callback($rule,
>     function ($matches) use ($customUrl) {
>         return str_replace($matches[1], $customUrl . "&url=" . urlencode($matches[1]), $matches[0]);
>         }, $replaceContent);
> return $preg; 
> ```
>
> 