#!/bin/bash

# This is the path where PARANINFO  is installed
PARANINFODIR=/opt/areto-server


function killParaninfo {
        echo -n "Shutting down PARANINFO services: "
        killall php
	sleep 2
        set PID=$(ps -efw|grep php|grep -v grep|tr -s ' '|cut -d ' ' -f 2|head -1; );
        echo  ___$PID____
        if [ $PID ]; then
                echo "kill paraninfo"
                kill $PID;
        fi

}
function startParaninfo {
        echo "Starting PARANINFO services: "
	cd /opt/areto-server
	#php /opt/areto-server/extronInit.php
	cat /opt/areto-server/pantallaActiva.properties|  sed 's/Pantalla.activa=[0-9]*/Pantalla.activa=1/g' > /opt/areto-server/pantallaActiva.properties.bak
	cp /opt/areto-server/pantallaActiva.properties.bak /opt/areto-server/pantallaActiva.properties
	php /opt/areto-server/comunication/hariak/hasi.php &> /tmp/paraninfo.log

}

# See how we were called.
case "$1" in
  start)
        startParaninfo;
        echo
        ;;
  stop)
        killParaninfo;
        echo
        ;;
 restart)

        killParaninfo;
        sleep 5;
        startParaninfo;
        ;;
  *)
        echo "Usage: paraninfo {start|stop|restart}"
        exit 1
esac
