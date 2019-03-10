 <?php
 //查询时间段数据 如 0点-2点 之间的数据
 //FROM_UNIXTIME : mysql函数 把时间戳转换成YYYY-MM-DD"格式来显示;
 //unix_timestamp : 时间转换成时间戳
 $zeroToTwo = "select * from `表名` where `字段` = 值 
 and FROM_UNIXTIME(unix_timestamp(created_at),'%H')>=0 and FROM_UNIXTIME(unix_timestamp(created_at),'%H')<2";
