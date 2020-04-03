# MYSQL按小时或分钟分组进行统计数据

> 使用到mysql的 when then else end方法

```mysql
select SUM(case when `type` = '1' then 1 else 0 end) as `success`,
SUM(case when `type`='2' then 1 else 0 end) as `fail`,
SUM(case when `type`='3' then 1 else 0 end) as `rollback`,

-- 每小时
--  DATE_FORMAT(`time`,'%Y-%m-%d %H:00') as date

-- 两小时
 CONCAT(DATE_FORMAT(`time`,'%Y-%m-%d '),LPAD(FLOOR(HOUR(`time`)/2)*2,2,0),':00') as date

-- 按5分钟
--  DATE_FORMAT(
--    concat( date( time ), ' ', HOUR ( time ), ':', floor( MINUTE ( time ) / 5 ) * 5 ),
--    '%Y-%m-%d %H:%i' 
--   ) AS date 

from `tables` WHERE `type` in(1,2,3) and DATE_FORMAT(`time`, '%Y-%m-%d')='0000-00-00' GROUP BY `date`;
 
```

