<?php
/*
 * 获取用户的浏览器信息和版本号
 * @param $agent = $_SERVER['HTTP_USER_AGENT']
 * */
function getBrowser($agent){

    if (stripos($agent, "Firefox/") > 0) {
        preg_match("/Firefox\/([^;)]+)+/i", $agent, $b);
        $exp[0] = "Firefox";
        $exp[1] = $b[1];  //获取火狐浏览器的版本号
    } elseif (stripos($agent, "Maxthon") > 0) {
        preg_match("/Maxthon\/([\d\.]+)/", $agent, $aoyou);
        $exp[0] = "傲游";
        $exp[1] = $aoyou[1];
    } elseif (stripos($agent, "MSIE") > 0) {
        preg_match("/MSIE\s+([^;)]+)+/i", $agent, $ie);
        $exp[0] = "IE";
        $exp[1] = $ie[1];  //获取IE的版本号
    } elseif (stripos($agent, "OPR") > 0) {
        preg_match("/OPR\/([\d\.]+)/", $agent, $opera);
        $exp[0] = "Opera";
        $exp[1] = $opera[1];
    } elseif(stripos($agent, "Edge") > 0) {
        //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
        preg_match("/Edge\/([\d\.]+)/", $agent, $Edge);
        $exp[0] = "Edge";
        $exp[1] = $Edge[1];
    } elseif (stripos($agent, "Chrome") > 0) {
        preg_match("/Chrome\/([\d\.]+)/", $agent, $google);
        $exp[0] = "Chrome";
        $exp[1] = $google[1];  //获取google chrome的版本号
    } elseif(stripos($agent,'rv:')>0 && stripos($agent,'Gecko')>0){
        preg_match("/rv:([\d\.]+)/", $agent, $IE);
        $exp[0] = "IE";
        $exp[1] = $IE[1];
    }else {
        $exp[0] = "未知浏览器";
        $exp[1] = "";
    }
    return $arr = ['browser' => $exp[0],'browser_version' =>$exp[1]];
}
