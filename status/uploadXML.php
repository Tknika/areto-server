<?php

   $request_url = 'http://192.168.110.2/paraninfo/index.php?fg=devices&fe=uploadXml';
        $post_params['name'] = urlencode('sinta2.xml');
        $post_params['file'] = '@'.'./sinta2.xml';
        $post_params['submit'] = urlencode('submit');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
        $result = curl_exec($ch);
        curl_close($ch);


   print "\n$result\n";

?>
