/*
select SUM(case when `type` = '1' then 1 else 0 end) as `view`,
SUM(case when `type`='2' then 1 else 0 end) as `lottery`,
SUM(case when `type`='3' then 1 else 0 end) as `click`,
-- 每小时
--  DATE_FORMAT(`time`,'%Y-%m-%d %H:00') as date
-- 两小时
 CONCAT(DATE_FORMAT(`time`,'%Y-%m-%d '),LPAD(FLOOR(HOUR(`time`)/2)*2,2,0),':00') as date
-- 按分钟
--  DATE_FORMAT(
--    concat( date( time ), ' ', HOUR ( time ), ':', floor( MINUTE ( time ) / 5 ) * 5 ),
--    '%Y-%m-%d %H:%i' 
--   ) AS date 
from user_action_kfou14 WHERE `type` in(1,2,3) and DATE_FORMAT(`time`, '%Y-%m-%d')='2019-10-15' GROUP BY `date`;
*/
