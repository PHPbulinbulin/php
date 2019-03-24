<?php
$date = get_weeks();
        $dateCostMap = [];
        //key为条件,如获取七天的数据使用key,占位防止查询的数据没有某一天导致缺少那天的数据
        foreach($date as $v){
            $dateCostMap[$v] = 0;
        }
        foreach($events as $event){
            $costDatas = DB_stat() -> table('gift_'. $event -> id)
                -> select('amount', 'id', 'time') -> where('status', '=', 1)
                -> whereDate('time', '>', date('Y-m-d', strtotime('-7 days')))
                 ->whereDate('time', '<=', date('Y-m-d'))
                -> get() -> toArray();
            foreach($costDatas as $costData){
                $currentCostDate = date('Y-m-d', strtotime($costData -> time));
                //遍历的时候如果有则进行加等
                $dateCostMap[$currentCostDate] = $dateCostMap[$currentCostDate] + $costData->amount;
            }
        }
        //获取到的数据进行key和值分开
        foreach($dateCostMap as $date=>$item) {
          $data['list'][] = [
            'cost' => $item,
            'date' => $date,
            'earnings' => 0
          ];
        }
