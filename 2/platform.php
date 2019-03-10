<?php
/*
 * 获取用户的平台和平台版本
 * @param $agent=$_SERVER['HTTP_USER_AGENT']
 * */
function getPlatform($agent){
    //window系统
    if (stripos($agent, 'window')) {
        $os = 'Windows';
        $equipment = '电脑';
        if (preg_match('/nt 6.0/i', $agent)) {
            $os_ver = 'Vista';
        }elseif(preg_match('/nt 10.0/i', $agent)) {
            $os_ver = '10';
        }elseif(preg_match('/nt 6.3/i', $agent)) {
            $os_ver = '8.1';
        }elseif(preg_match('/nt 6.2/i', $agent)) {
            $os_ver = '8.0';
        }elseif(preg_match('/nt 6.1/i', $agent)) {
            $os_ver = '7';
        }elseif(preg_match('/nt 5.1/i', $agent)) {
            $os_ver = 'XP';
        }elseif(preg_match('/nt 5/i', $agent)) {
            $os_ver = '2000';
        }elseif(preg_match('/nt 98/i', $agent)) {
            $os_ver = '98';
        }elseif(preg_match('/nt/i', $agent)) {
            $os_ver = 'nt';
        }else{
            $os_ver = '';
        }

    }
    elseif(stripos($agent, 'linux')) {
        if (stripos($agent, 'android')) {
            $match = [];
            preg_match('/android\s([\d\.]+)/i', $agent, $match);
            $os = 'Android';
            $equipment = 'Mobile phone';
            $os_ver = $match[1];
        }else{
            $os = 'Linux';
        }
    }
    elseif(stripos($agent, 'unix')) {
        $os = 'Unix';
    }
    elseif(preg_match('/iPhone|iPad|iPod/i',$agent)) {
        $match = [];
        preg_match('/OS\s([0-9_\.]+)/i', $agent, $match);
        $os = 'IOS';
        $os_ver = str_replace('_','.',$match[1]);
        if(preg_match('/iPhone/i',$agent)){
            $equipment = 'iPhone';
        }elseif(preg_match('/iPad/i',$agent)){
            $equipment = 'iPad';
        }elseif(preg_match('/iPod/i',$agent)){
            $equipment = 'iPod';
        }
    }
    elseif(stripos($agent, 'mac os')) {
        $match = [];
        preg_match('/(mac|apple)/i', $agent, $match);
        $os = 'Mac OS X';
        $equipment = '电脑';
        $os_ver = str_replace('_','.',$match[1]);
    } else {
        $os = '其他';
    }
    return ['platform'=>$os, 'platform_version'=>$os_ver];
}
