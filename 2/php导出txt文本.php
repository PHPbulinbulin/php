<?php
  header( "Content-type:   application/octet-stream ");
  header( "Accept-Ranges:   bytes ");
  header( "Content-Disposition:   attachment;   filename="文本名称.txt ");
  header( "Expires:   0 ");
  header( "Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 ");
  header( "Pragma:   public ");

 
  $code_in_commoditys = DB::table('表名') -> select('id') -> get();
  $str = '';
  foreach($code_in_commoditys as $key => $code_in_commodity){
         $str .= '内容\r\n";
  }
  echo $str;
