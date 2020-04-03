<?php
/*
 * 冒泡排序
 * */
function bubblingSort($arr){
    for ($n=1; $n<count($arr); $n++) {
        for ($i=0; $i < count($arr) - $n; $i++) {
            if ($arr[$i] > $arr[$i+1]) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$i+1];
                $arr[$i+1] = $temp;
            }
        }
    }
    return $arr;
}
