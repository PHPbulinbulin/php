# 微信红包接口

> #### **微信现金红包和企业付款**

**注意事项：**

1. **http_request()** 方法里需要指定微信支付证书在项目中的路径。支付证书下载完成需要引入到项目中。

   常见问题：

   >  1.找不到证书无法接口调用失败

   >  2.路径正确但是线上文件夹没有权限无法访问

2. **makeSign()**方法中字符串**必须在末尾增加参数key=商户SKey**

```php
<?php
class Wechat {
    const wechatParams = [
        'mchID' => '', //商户号id
        'wxMchSKey' => '', //商户号skey
        'wxAppID' => '',  //微信公众号id

    ];
    const redPacketCashApi = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
    
    const enterprisePaymentApi = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';

   /**
    * 微信现金红包
    * @param string $mchBillno  商户订单号(可用于查询红包发放接口)
    * @param float $price        发放金额
    * @param string $open_id     用户openid (授权获取)
    */
    public function redPacketCash ($mchBillno, $price, $openID)
    {
        $price = $price * 100; // 单位分
        $params = [
            'nonce_str' => 'xx', //随机字符串 不能超过32位
            'mch_billno'=>$mchBillno,
            'mch_id'=> self::wechatParams['mchID'],
            'wxappid' => self::wechatParams['wxAppID'],
            'send_name' => '现金红包',  //红包发送者名称
            're_openid' => $openID,
            'total_amount' => $price,
            'total_num' => 1,        //红包发放总人数
            'wishing' => '大吉大利，今晚吃鸡',  //红包祝福语
            'client_ip'=>'127.0.0.1',  //客户端ip地址或服务器端ip都可以
            'act_name' => '现金红包',   //活动名称
            'remark' => '备注信息',     //红包备注信息
            'scene_id'=>'PRODUCT_2',   //场景id 具体参数查看微信现金红包接口
            'risk_info' => urlencode(''),  //活动信息 参数过多就不写了，详情查看微信红包接口
        ];
        $params['sign']=$this->makeSign($params);
        $xml = $this->ToXml($params);
        $result = $this->http_request(self::redPacketCashApi, $xml);
        $resultArray = $this->FromXml($result);
        return $resultArray;
    }
    
     /**
     * 企业付款
     * @param string $mchBillno  商户订单号(可用于查询红包发放接口)
     * @param float $price        发放金额
     * @param string $openID     用户openID (授权获取)
     */
    public function enterprisePayment($mchBillno, $price, $openID)
    {
        $price = $price * 100; // 单位分
        $param = [
            'mch_appid' => self::wechatParams['wxAppID'],
            'mchid'=> self::wechatParams['mchID'],
            'nonce_str' => 'xx', //随机字符串 不能超过32位
            'partner_trade_no'=>$mchBillno,
            'openid' => $openID,
            'amount' => $price,
            'check_name' => 'NO_CHECK', //校验用户姓名选项 这里选择不校验
            'spbill_create_ip'=>'127.0.0.1', //客户端ip地址或服务器端ip都可以
            'desc' => '恭喜发财',  //企业付款备注
        ];
        $param['sign']=$this->MakeSign($param);
        $xml = $this->ToXml($param);
        $result = $this->http_request(self::enterprisePaymentApi, $xml);
        $result=$this->FromXml($result);
        return $result;
    }


    /**
     * 生成签名
     */
    public function makeSign($arr)
    {
        //签名步骤一：按字典序排序参数
        ksort($arr);
        $string = $this->ToUrlParams($arr);

        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . self::wechatParams['wxMchSKey'];
        //签名步骤三：MD5加密
        $string = md5($string);

        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);

        return $result;
    }
    
    /**
     * 格式化参数格式化成url参数
     */
    protected function ToUrlParams($arr)
    {
        $buff = "";

        foreach ($arr as $k => $v)
        {
            if ($k != "sign" && $v != "" && !is_array($v))
            {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }
    
     /**
     * 输出xml字符
     **/
    public function ToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val)
        {
            if (is_numeric($val))
            {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            }
            else
            {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }
   
     /**
     * @param  string $url api接口
     * @param null $data   请求参数
     * @return bool|false|string
     */
    function http_request ($url, $data = null)
    {

        if (function_exists('curl_init')) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            //因为微信红包在使用过程中需要验证服务器和域名，故需要设置下面两行
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($curl,CURLOPT_SSLCERT, ''); //商户号中下载 'apiclient_cert.pem'
            curl_setopt($curl,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($curl,CURLOPT_SSLKEY, '');  //商户号中下载 'apiclient_key.pem'
            $output = curl_exec($curl);
            curl_close($curl);
            return $output;
        } elseif (function_exists('file_get_contents')) {
            $output = file_get_contents($url . $data);
            return $output;
        } else {
            return false;
        }
    }
    
    /**
     * 将xml转为array
     * @param string $xml
     */
    public function FromXml($xml)
    {
        //将XML转为array
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }
}
```

