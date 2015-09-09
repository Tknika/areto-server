<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author amaia
 */
class Utils {
    //put your code here
    public static function checksun($comando){
        $res=0;
   $i=0;
   while(strlen($comando)>$i){
        $aux=substr($comando, $i,2);
         $pasau=hexdec($aux);
        $res=$res+$pasau;
        $i=$i+2;
   }
   $checsun=$res%128;
   $checsunstring=dechex($checsun);
    if(strlen($checsunstring)<2)
        $checsunstring="0".$checsunstring;

    return $checsunstring;
}

public static function unichr($c) {
    if ($c <= 0x7F) {
        return chr($c);
    } else if ($c <= 0x7FF) {
        return chr(0xC0 | $c >> 6) . chr(0x80 | $c & 0x3F);
    } else if ($c <= 0xFFFF) {
        return chr(0xE0 | $c >> 12) . chr(0x80 | $c >> 6 & 0x3F)
                                    . chr(0x80 | $c & 0x3F);
    } else if ($c <= 0x10FFFF) {
        return chr(0xF0 | $c >> 18) . chr(0x80 | $c >> 12 & 0x3F)
                                    . chr(0x80 | $c >> 6 & 0x3F)
                                    . chr(0x80 | $c & 0x3F);
    } else {
        return false;
    }
}
public static function hexToStr($hex)
{
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2)
    {
        $aux=hexdec($hex[$i].$hex[$i+1]);
    
        $string.=Utils::unichr($aux);

       
    }
 
    return $string;
}
//     public static function hexStringToStringp($str) {
//    $aux;
//    $valor;
//    //System.out.println("he entrau a la funcion  pa pasar a string"+ str);
//    $tabla;
//   $res = "";
//    $i = 0;
//    while ($i < strlen($str)) {
//        $aux=substr($str, $i,2);
//      //$aux = str.substring(i, i + 2);
//      $tabla = hexdec($aux);
//
//   $res=$res.self::unichr($tabla);
//      //  System.out.println("a1"+ a1);
//
//      $i = $i + 2;
//    }
//    //   System.out.println("res"+ res);
//    return $res;
//
//  }
// public static function strToHex($string)
//{
//    $hex='';
//    for ($i=0; $i < strlen($string); $i++)
//    {
//        $hex .= dechex(ord($string[$i]));
//    }
//    return $hex;
//}
public static function bitaZenbakira($datua) {
    /*
        16 biteko Integer zenbakia 4 bitera pasatzen du
         0100011111000000 ==> 0100 0111 1100 0000
     */

    $Zenbakia;
    $zenb;
    $bit1;
    $bit2; 
    $bit3;
    $bit4;
    $Bitsub1;
    $Bitsub2;
    $Bitsub3;
    $Bitsub4;

   $i = 3;
    $Bitsub1 =substr($datua, 0,4);
    $Bitsub2 = substr($datua, 4,4);
    $Bitsub3 = substr($datua, 8,4);
    $Bitsub4 = substr($datua, 12,4);
    $decimal1 = intval($Bitsub1, 2);
   
    $bit1 = strval($decimal1);
    if ($decimal1 == 10) {
      $bit1 = "A";
    }
    else if ($decimal1 == 11) {
      $bit1 = "B";
    }
    else if ($decimal1 == 12) {
      $bit1 = "C";
    }
    else if ($decimal1 == 13) {
      $bit1 = "D";
    }
    else if ($decimal1 == 14) {
      $bit1 = "E";
    }
    else if ($decimal1 == 15) {
      $bit1 = "F";
    }

    $decimal2 = intval($Bitsub2, 2);

    $bit2 = strval($decimal2);
    if ($decimal2 == 10) {
      $bit2 = "A";
    }
    else if ($decimal2 == 11) {
      $bit2 = "B";
    }
    else if ($decimal2 == 12) {
      $bit2 = "C";
    }
    else if ($decimal2 == 13) {
      $bit2 = "D";
    }
    else if ($decimal2 == 14) {
      $bit2 = "E";
    }
    else if ($decimal2 == 15) {
      $bit2 = "F";
    }
    $decimal3 = intval($Bitsub3, 2);
  
    $bit3 = strval($decimal3);
    if ($decimal3 == 10) {
      $bit3 = "A";
    }
    else if ($decimal3 == 11) {
      $bit3 = "B";
    }
    else if ($decimal3 == 12) {
      $bit3 = "C";
    }
    else if ($decimal3 == 13) {
      $bit3 = "D";
    }
    else if ($decimal3 == 14) {
      $bit3 = "E";
    }
    else if ($decimal3 == 15) {
      $bit3 = "F";
    }

    $decimal4 = intval($Bitsub4, 2);
   
    $bit4 = strval($decimal4);
    if ($decimal4 == 10) {
      $bit4 = "A";
    }
    else if ($decimal4 == 11) {
      $bit4 = "B";
    }
    else if ($decimal4 == 12) {
      $bit4 = "C";
    }
    else if ($decimal4 == 13) {
      $bit4 = "D";
    }
    else if ($decimal4 == 14) {
      $bit4 = "E";
    }
    else if ($decimal4 == 15) {
      $bit4 = "F";
    }

    $zenb = $bit1.$bit2.$bit3.$bit4;
    
    return $zenb;

  }
//public static function hexbin($hex, $padding = false)
//{
//    // Validation
//    $hex = preg_replace('/^(0x|X)?/i', '', $hex);
//    $hex = preg_replace('/[[:blank:]]/', '', $hex);
//    if(empty($hex))
//    {
//        $hex = '0';
//    }
//    if(!preg_match('/^[0-9A-F]*$/i', $hex))
//    {
//        trigger_error('Argument is not a hex', E_USER_WARNING);
//        return false;
//    }
//
//    // Conversion
//    $bin = '';
//    $hex = array_reverse(str_split($hex));
//    foreach($hex as $n)
//    {
//        $n = hexdec($n);
//        for($i = 1; $i <= 8; $i <<= 1)
//        {
//            $bin .= ($i & $n)? '1' : '0';
//        }
//        if($padding)
//        {
//            $bin .= ' ';
//        }
//    }
//    return ltrim(strrev($bin));
//}
//   public static function string_to_ascii($string)
//     {
//      $ascii = NULL;
//      for ($i = 0; $i < strlen($string); $i++)
//      {
//     $ascii .= ord($string[$i]);
//    }
// return($ascii);
//
//      }
//      public static function base10asciiTobin($string){
//
//         $bin = NULL;
//      for ($i = 0; $i < strlen($string)-1; $i=$i+2)
//      {
//     $bin .= str_pad(base_convert($string[$i].$string[$i+1],16,2),8, "0", STR_PAD_LEFT);
//    }
// return($bin);
//      }
//  public static function makeASCII($a){
//  $find[] = "=\r\n";
//  $replace[] = "";
//
//  for($i=0; $i < 256; $i++){
//    $find[] = "=".dechex($i)."";
//    $replace[] = chr($i);
//  }
//  $a = str_replace($find,$replace,$a);
//  return $a;
// }
//  public static function intToHexString($num) {
//    $base = "00";
//    $res = dechex($num);
//    $len =strlen($base)- strlen($res);
//    if ($len > 0)
//    $res=substr($base, 0).$res;
////      $res = base.substring(0,len) + res;
//    return $res;
//
//  }
  public static function sacarFoto($preset){
      file_get_contents("http://192.168.110.2/paraninfo/invisible.php?fg=check_mail&fe=takePhoto&preset=$preset");
  }
}
?>
