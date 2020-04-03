<?php
// $url = 邮箱;
        $txts = dns_get_record($url,DNS_TXT);
        $mxs = dns_get_record($url,DNS_MX);

    
