<?php
/*
 * 防止xss攻击
 * */
function deleteHtml($str)
{
    $str = trim($str);
    $str = strip_tags($str,"");
    $str = preg_replace("/ /","",$str);
    $str = preg_replace("/  /","",$str);
    $str = htmlspecialchars($str);
    $str = addslashes($str);
    return trim($str);
}
