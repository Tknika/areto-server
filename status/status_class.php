<?php

/*
 * proyector_central, pizarra(proyector_pizarra), camara_documentos, pantalla_presidencia, plasma, pantalla_pasillo,luces (techo), mesa_mezcla(audio)
 *
 *
 * extron bakarrik: dvd, dvdgrabador, camara_presidencia, camara_alumnos1, camara_alumnos2, fokoak(dimmer),
 *
 * generador_multiventanas, matriz VGA, matriz video,
 *
 *
 * Automata.
 *
 */

require_once 'Net/Socket.php';
define('_PROPERTIES_FILE', './sinta.properties');
define('_STATUS_FILE', './status/device.status');
define('_XML_FILE', './status/sinta2.xml');

class status_class {

    private $properties;

    function __construct() {
        $this->loadProperties();
    }

    function xmlZerrenda() {

        $xml = simplexml_load_file(_XML_FILE);

        //echo "\nkkk\n";
        $flashStatus = array();

        foreach ($xml->menu_items->principal->object as $objects) {
            //echo "\n object: " . $objects['name'] . " visible: " . $objects['visible'];
            $flashStatus["{$objects['name']}"]['visible'] = "{$objects['visible']}";
            foreach ($objects->panel as $panel) {
                //echo "\n\t panel: " . $panel['name'] . " visible: " . $panel['visible'];
                $flashStatus["{$objects['name']}"]["{$panel['name']}"]['visible'] = "{$panel['visible']}";
                foreach ($panel->elem as $elem) {
                    //echo "\n\t\telem:: " . $elem['name'] . " visible: " . $elem['visible'];
                    //echo "\n flashStatus[{$objects['name']}][{$panel['name']}][{$elem['name']}]['visible']={$elem['visible']}";
                    $flashStatus["{$objects['name']}"]["{$panel['name']}"]["{$elem['name']}"]['visible'] = "{$elem['visible']}";
                }
            }
        }
        //echo "\n\n";
        print_r($flashStatus);
    }

    function changeParameters($paramatersStr, $value) {
        if (empty($paramatersStr))
            return;
        $paramaters = explode(',', trim($paramatersStr));

        foreach ($paramaters as $parameter) {
            if (empty($parameter))
                continue;
            $this->changeXmlParameter($parameter, $value);
        }
    }

    function changeXmlParameter($parameter, $value) {

        $xml = simplexml_load_file(_XML_FILE);

        //$parameter='proyector_central/encender_apagar';
        //$value=0;
        $buttons = explode('/', $parameter);

        if (count($buttons) > 3

            )return;
        if (isset($buttons[0]) && !empty($buttons[0])) {
            foreach ($xml->menu_items->principal->object as $objects) {
                if ($objects['name'] == $buttons[0]) {

                    if (isset($buttons[1]) && !empty($buttons[1])) {
                        foreach ($objects->panel as $panel) {
                            if ($panel['name'] == $buttons[1]) {

                                if (isset($buttons[2]) && !empty($buttons[2])) {
                                    foreach ($panel->elem as $id => $elem) {
                                        if ($elem['name'] == $buttons[2]) {
                                            //aldatu elem
                                            $elem['visible'] = $value;
                                        }
                                    }
                                } else {
                                    //aldatu panel
                                    $panel['visible'] = $value;
                                }
                            }
                        }
                    } else {
                        //aldatu object visile
                        $objects['visible'] = $value;
                    }
                }
            }
        }


        $r = file_put_contents(_XML_FILE, $xml->asXML());
        if ($r === false) {
            echo "\ERROR writeing XML file";
        }
    }

    function loadProperties() {
        if (!is_file(_PROPERTIES_FILE)) {
            echo "\nERROR:: I not found " . _PROPERTIES_FILE . " file\n";
            return;
        }
        $properties = array();
        $rows = file(_PROPERTIES_FILE);
        $cmdInit = array();
        foreach ($rows as $row) {
            $row1 = trim($row);
            if (strpos($row1, '#') !== false) {
                $commnt = explode('#', $row1);
                $row1 = $commnt[0];
            }
            if (empty($row1)

                )continue;
            if (strpos($row1, '=') === false || strpos($row1, '=') == 0)
                continue;

            $propArr = explode('=', $row1);


            $propert = explode('.', trim($propArr[0]));
            unset($propArr[0]);

            $strEval = '$properties[\'' . implode('\'][\'', $propert) . '\']=implode(\'=\',$propArr);';

            eval($strEval);
        }
        $this->properties = $properties;
    }

    function saveProperties($device, $propertie, $value) {
        if (!is_file(_PROPERTIES_FILE)) {
            echo "\nERROR:: I not found " . _PROPERTIES_FILE . " file\n";
            return;
        }
        $proStr = file_get_contents(_PROPERTIES_FILE);
        $res = preg_replace("/($device\.$propertie)=(.)+/", "$1=$value", $proStr);
        file_put_contents(_PROPERTIES_FILE, $res);
        $this->loadProperties();
    }

    function getProperties() {
        return $this->properties;
    }

    /*
     * change child status  
     */

    function changeChildStatus($parent, $status) {
        if (!isset($this->properties[$parent])) {
            echo "\n $parent is not a valid device";
            return;
        }
        $this->properties[$parent]['status'] = $status;
        $this->saveProperties($parent, 'status', $status);

        if ($status == 1

            )$visible = 0; else
            $visible=1;

        $this->changeParameters($this->properties[$parent]['visible'], $visible);

        foreach ($this->properties as $device => $attrib) {

            if (isset($attrib['parent']) && $attrib['parent'] == $parent) {
                $this->properties[$device]['status'] = $status;
                $this->saveProperties($device, 'status', $status);
                $this->changeParameters($this->properties[$device]['visible'], $visible);
            }
        }
    }

    function ipCheck() {

        echo "1- Check ip Connecttion";
        $errors = array();

        foreach ($this->properties as $device => $attrib) {
            
            if (array_key_exists('parent', $attrib)) {
                if($this->properties[$attrib['parent']]['status']!=0)continue;
            }
            
            if (array_key_exists('Ip', $attrib) ) {
                echo "\nDevice $device ip:" . $attrib['Ip'];
                if (array_key_exists('Port', $attrib)) {
                    $port = $attrib['Port'];
                } else {
                    $port = 80;
                }

                $fp = @fsockopen($attrib['Ip'], $port, $errno, $errstr, 5);
                if ($fp === false) {
                    echo "\nEZ dago extrom hau";
                    $this->changeChildStatus($device, 1);
                    continue;
                } else {
                    $this->changeChildStatus($device, 0);
                }
                echo "\nBAdago extrom hau";
                fclose($fp);
            }
        }

        echo "\n";
    }

    /*
     * initialize status
     * denei 0 jarri. Haseran denak ondo daude, oker daudela konprobatu behar da.
     */

    function initializeStatus() {

        foreach ($this->properties as $dev => $attrib) {
            $this->properties[$dev]['status'] = 0;
        }
    }

    function initCmd() {

        foreach ($this->properties as $device => $attrib) {
            if (array_key_exists('init', $attrib)) {
                if (!isset($attrib['init']) || empty($attrib['init']))
                    continue;

                if (!empty($attrib['Ip'])) {
                    $ip = $attrib['Ip'];
                } elseif (!empty($this->properties[$attrib['parent']]['Ip']) && (!isset($attrib['ip']) || empty($attrib['ip']) )) {
                    $ip = $this->properties[$attrib['parent']]['Ip'];
                } else {
                    $ip = '';
                }

                echo "\nDevice $device init:" . $attrib['init'] . " ip: $ip\n";
                if ($attrib['status'] == 0) {
                    $this->sendCommand($ip, $attrib['init']);
                }
            }
        }
    }

    function sendCommand($address, $command, $port=23) {
        if (empty($address))
            return;
        $socket = new Net_Socket();

        // open connection
        $respuesta = '';
        if ($socket->connect("$address", $port, true, 1)) {
            $socket->writeLine($command);
            //usleep(1000000);
            sleep(1);
            $respuesta = trim($socket->read(200));
            $socket->disconnect();
        }

        return $respuesta;
    }

    function test() {
        $status = parse_ini_file(_STATUS_FILE, true);
        $bila = array('error', 'ok', '(', ')');
        $orde = array('', '', '', '');

        echo "\nTest devices";
        foreach ($this->properties as $device => $attrib) {
            if (array_key_exists('test', $attrib)) {
                if (!isset($attrib['test']) || empty($attrib['test']))
                    continue;

                if (!empty($attrib['Ip'])) {
                    $ip = $attrib['Ip'];
                } elseif (!empty($this->properties[$attrib['parent']]['Ip']) && (!isset($attrib['ip']) || empty($attrib['ip']) )) {
                    $ip = $this->properties[$attrib['parent']]['Ip'];
                } else {
                    $ip = '';
                }

                if ($attrib['status'] == 0) {
                    $test = explode(',', $attrib['test']);
                    $testCmd = array_shift($test);
                    foreach ($test as $t) {
                        $val = explode('|', str_replace($bila, $orde, $t));
                        if (strpos($t, 'error') !== false) {
                            $errorCodes = $val;
                        } elseif (strpos($t, 'ok') !== false) {
                            $okCodes = $val;
                        } else {
                            $okCodes = "";
                        }
                    }

                    $result = trim($this->sendCommand($ip, $testCmd, 2000 + $attrib['PortNum']));
                    echo "\n--device $device cmd $testCmd result $result \n";
                    if (in_array($result, $errorCodes)) {
                        $msg = "ERROR en $device code= $result msg=" . $status[$device][$result];
                        echo "\n ERROR CODE DETECT in device $device code= $result msg=" . $status[$device][$result];
                        $this->saveProperties($device, 'error', $msg);
                        $this->changeChildStatus($device, 1);
                    } elseif (in_array($result, $okCodes)) {
                        $this->changeChildStatus($device, 0);
                    } else {
                        $this->changeChildStatus($device, 0);
                    }
                }
            }
        }
    }

    /*
     *
     */

    function checkStatus() {
        $this->initializeStatus();
        $this->ipCheck();
        $this->test();
        $this->uploadXML();
    }

    function uploadXML() {

        $request_url = 'http://192.168.110.2/paraninfo/index.php?fg=devices&fe=uploadXml';
        $post_params['name'] = urlencode('sinta2.xml');
        $post_params['file'] = '@' . _XML_FILE;
        $post_params['submit'] = urlencode('submit');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
        $result = curl_exec($ch);
        curl_close($ch);


        print "\n$result\n";
    }

}

//$a = new status_class();
//$a->checkStatus();
//$a->initCmd();
//$a->checkStatus();
?>
