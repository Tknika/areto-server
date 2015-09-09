 <?php
    include ( 'Fork.php' );
      
    class executeThread extends PHP_Fork {  
         var $counter;  
      
         function executeThread($name)  
         {  
             $this->PHP_Fork($name);  
             $this->counter = 0;  
        }  
     
        function run()  
        {  
            $i = 0;  
            while ($i < 5) {  
                print time() . "-(" . $this->getName() . ")-" . $this->counter++ . "\n";
                sleep(5);
                $i++;  
            }  
        }  
    }  
     
    
//   for ($index = 1; $index < 5; $index++) {
//    $thread = new executeThread("hilo numero -> ".$index);
//    $thread->start();
//   }  
     
   ?>  