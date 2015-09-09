<?php
       
        include_once 'thread/Thread.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
  
        
        for ($index = 1; $index < 5; $index++) {
            $a=time();
            echo "<br>----->thread:$index time: {$a}";
            $thread = new executeThread("hilo numero -> ".$index);
            $thread->start();
    //$thread->run();
            echo "<br> <-----------thread:$index diff" . time() - $a ;
   }
  for ($i = 1; $i < 5; $i++) {
    echo $i."\n";}
        ?>
  
       
    </body>
</html>
