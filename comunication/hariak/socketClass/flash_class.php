<?php

class flash_class{
	function flash_class(){
	
	}
	function security_police(){
            echo "flash baimena:". ROOT.'/conf/crossdomain.xml';
		$out=file_get_contents(ROOT.'/conf/crossdomain.xml');
	return $out;
	
	
	}
}
?>
