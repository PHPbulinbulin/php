<?php
/*
 * 冒泡排序
 * */
function bubblingSort($arr){
    for ($n=1; $n<count($arr); $n++) {
        //echo $n; 7个数比6次：123456
        //步骤3：判断交换值
        for ($i=0; $i < count($arr) - $n; $i++) {
            //echo $i . '<br />';  //123456
            //echo $arr[$i] . '<br />';
            if ($arr[$i] > $arr[$i+1]) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$i+1];
                $arr[$i+1] = $temp;
            }
        }
    }
    return $arr;
}
