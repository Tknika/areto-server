<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfiguracionDispositivos
 *
 * @author amaia
 */
 class ConfiguracionDispositivos {
    public static $propiedades;
    function  __construct() {
       
    }
    public static function load(){
     $this->propiedades=new Properties();
        $this->propiedades->load(file_get_contents('sinta.properties'));
    }
    //put your code here
}
?>
