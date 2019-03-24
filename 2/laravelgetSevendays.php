  $costDatas = D::table('表名')
                -> whereDate('time', '>', date('Y-m-d', strtotime('-7 days')))
                 ->whereDate('time', '<=', date('Y-m-d'))
                -> get() -> toArray();
