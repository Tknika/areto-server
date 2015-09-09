
<?php



include_once './Properties.php';
$cameraStatus=new Properties();
$cameraStatus->load(file_get_contents("./sinta.properties"));


$dispositivos=array();
foreach ($cameraStatus->propertyNames() as $property){
    $pos=stripos($property,".");
    $disp=substr($property, 0,$pos);
    if(!in_array($disp, $dispositivos)&&$cameraStatus->getProperty($disp.".check")==1)
      $dispositivos[]=$disp;
}print_r($dispositivos);