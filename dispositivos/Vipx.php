<?php
//require_once './dispositivos/DispositivoIP.php';
//
//
//class Vipx extends DispositivoIP {
//
//    /**
//     *
//     * @var <type>
//     */
//    private static $VIPX1="v1";
//    /**
//     *
//     * @var <type>
//     */
//    private static $VIPX2="V2";
//
//
//    public function  __construct() {
//
//        $this->tipoDispositivo="Vipx";
//        parent::__construct($dispositivo);
//
//    }
//
//    /**
//     *
//     * @param <type> $estado
//     */
//    public function setEstado($estado) {
//
//        $this->estado = $estado;
//        echo "Estado foto:" . $estado;
//
//    }
//    /**
//     *
//     * @return <type>
//     */
//    public function getEstado() {
//
//        return $this->estado;
//
//    }
//
//     /**
//     * Metodo para sacar una foto con el Vipx1 a la posicion del preset
//     * @param <type> $preset
//     */
//    public function sacarFoto($preset) {
//
//    /**
//     * Metodo para sacar una foto con el Vipx1 a la posicion del preset
//     * @param <type> $preset
//     */
//        echo "\nPRESET DE SACAR FOTO: ".$preset."\n";
//        $comando=$this->comandos1[DaoControl::$PRESET.$preset];
//        if(strcmp($comando,"v2")==0) {
//            echo "\nVIPX2 pasa zaiona vipx1\n";
//            AccesoControladoresDispositivos::$ctrlAutomata->activarVipx2();
//        }
//        else if(strcmp($comando,"v1")==0) {
//            echo "\nVIPX1 pasa zaiona vipx2\n";
//                AccesoControladoresDispositivos::$ctrlAutomata->activarVipx1();
//            }
//        echo "vip". $preset;
//
//    }
//
//
//    public function procesarComando($comando,$parametro) {
//
//        return true;
//
//    }
//
//}
?>
