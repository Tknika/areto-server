<?php
include_once 'DaoAccess.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoControl
 *
 * @author amaia
 */
class DaoControl {

    /*
     * variables estaticas para la consulta de comandos
     */
    public static $ENCENDER="encender";
    public static $APAGAR="apagar";
    public static $PLAY="play";
    public static $STOP="stop";
    public static $PAUSE="pause";
    public static $REW="rew";
    public static $FFWD="ffwd";
    public static $ENTER="enter";
    public static $UP="up";
    public static $DOWN="down";
    public static $LEFT="left";
    public static $RIGHT="right";
    public static $DVD="dvd";
    public static $TV="tv";
    public static $MENU="menu";
    public static $CANALMAS="canalmas";
    public static $CANALMENOS="canalmenos";
    public static $REC="rec";
    public static $SOURCE="source";
    public static $PANRIGHT="panright";
    public static $PANLEFT="panleft";
    public static $TILTUP="tiltup";
    public static $TILTDOWN="tiltdown";
    public static $DESENFOCAR="desenfocar";
    public static $ENFOCAR="enfocar";
    public static $ZOOMMAS="zoommas";
    public static $ZOOMMENOS="zoommenos";
    public static $RSTEP="rstep";
    public static $FSTEP="fstep";
    public static $APAGARLAMPARA="apagarlampara";
    public static $ENCENDERLAMPARA="encenderlampara";
    //public static $PRESET1="preset1";
    //public static $PRESET2="preset2";
    public static $PRESET="preset";
    public static $INPUT="input";
    //public static $AV1="av1";
    //public static $AV2="av2";
    public static $VGA="vga";
    public static $PIP="pip";
    public static $FUENTEPIP="fuentepip";
    public static $FUENTEPIP1="fuentepip1";
    public static $QUITARPIP="quitarpip";
    public static $ESTADO="estado";
 public static $ESTADOONOFF="estadoOnOff";
    //public static $VC3="vc3";
    //public static $VC1="vc1";
    //public static $VC2="vc2";
    public static $VC="vc";
    public static $SUBIRPANACTIVAR="subirpanactivar";
    public static $BAJARPANACTIVAR="bajarpanactivar";
    public static $SUBIRPANDESACTIVAR="subirpandes";
    public static $BAJARPANDESACTIVAR="bajarpandes";

    public static $MUTEAR="mutear";
    public static $DESMUTEAR="desmutear";
    public static $LAMPARA="lampara";
    public static $TEMPERATURA="temperatura";

    public static $COLGARID="colgarid";
    public static $REINICIAR="reiniciar";
    public static $DESCONECTAR="desconectar";
    public static $COLGARVIDEOCONFERENCIA="colgar";
    public static $CONTACTOS="contactos";
    public static $INFOLLAMADA="infollamada";
    public static $LLAMAR="llamar";
    public static $LLAMARIP="llamarip";
    public static $LLAMARCONTACTO="llamarcontacto";
    public static $IPVIDEOCONF="ip";
    public static $RDSIVIDEOCONF="rdsi";
    public static $HOME="home";
    public static $GRAFICOS="graficos";
    public static $MARCARBORRAR="marcar";
    //public static $MARCARPUNTO="button.";
    public static $MARCAR="button ";
    public static $BORRARULTIMO="borrarultimo";
    public static $BORRARTODO="borrartodo";
    public static $NOMOLESTAR="nomolestar";
    public static $NOMOLESTAROFF="nomolestaroff";

    public static $MATRIZIMAGEN="vga1out1";
    public static $MATRIZAUDIO="audio1out1";

    public static $SUBIRLINEA="lsubir";
    public static $BAJARLINEA="lbajar";
    public static $ENCENDERLINEA="lon";
    public static $APAGARLINEA="loff";
    public static $ENCENDERLUCES="luceson";
    public static $APAGARLUCES="lucesoff";
    //put your code here
    public static $SONIDO="sonido";

    function  __construct() {
   

    }
    public static function  obtenerComandos($identificador) {

        DaoAccess::conectar();
        $listaComandos=DaoAccess::ejecutarSQLQuery("Select * from comando where id_d='".$identificador."'");
        DaoAccess::desconectar();
        return $listaComandos;
    }
    public static function obtenerDispositivo($marca,$modelo) {

        DaoAccess::conectar();
        $listaComandos=DaoAccess::ejecutarSQLQuery1("Select * from dispositivo where marca='".$marca."' and modelo='".$modelo."'");
        DaoAccess::desconectar();
        return $listaComandos;

    }


}
?>
