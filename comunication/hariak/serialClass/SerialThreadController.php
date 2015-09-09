<?php

class SerialThreadController extends PHP_Fork {
    var $_sleepInt;
    var $_executeThreadPool;
    var $_maxIdleTime;
    var $_respawnThread;

    /**
     * controllerThread::controllerThread()
     *
     * @param  $name
     * @param  $executeThreadPool
     * @param  $maxIdleTime
     * @param  $interval
     * @return
     */
    function controllerThread($name, &$executeThreadPool, $maxIdleTime = 60, $interval = 60)
    {
        $this->PHP_Fork($name);
        $this->_sleepInt = $interval;
        $this->_executeThreadPool = &$executeThreadPool;
        $this->_maxIdleTime = $maxIdleTime;
        $this->_respawnThread = array();

        $this->setVariable('_executeThreadPool', $this->_executeThreadPool);
    }

    function run()
    {
        while (true) {
            $this->_detectDeadChilds();
            $this->_respawnDeadChilds();

            sleep($this->_sleepInt);
        }
    }
    function stopAllThreads()
    {
        $this->_executeThreadPool = $this->getThreadPool();
        foreach($this->_executeThreadPool as $thread) {
            $thread->stop();
            echo "Stopped " . $thread->getName() . "\n";
        }
        unset($this->_executeThreadPool);
        $this->_executeThreadPool = array();
        $this->setVariable('_executeThreadPool', $this->_executeThreadPool);
    }

    function getThreadPool()
    {
        return $this->getVariable('_executeThreadPool');
    }


    function _detectDeadChilds()
    {
        // check every executethread to see if it is alive...
        foreach ($this->_executeThreadPool as $idx => $executeThread) {
            if ($executeThread->getLastAlive() > $this->_maxIdleTime) {
                // this thread is not responding, probably [defunct]
                $threadName = $executeThread->getName();
                print time() . "-" . $this->getName() . "-" . $threadName . " seems to be died...\n";
                // so let's kill it...
                $executeThread->stop();

                unset($executeThread);
                // remove this thread from the pool
                array_splice($this->_executeThreadPool, $idx, 1);
                // and add them to the "to be respawned" thread list...
                $this->_respawnThread[] = $threadName;
                // stop this foreach
                break;
            }
        }
    }

    function _respawnDeadChilds()
    {
        foreach ($this->_respawnThread as $idx => $threadName) {
            $n = &new executeThread ($threadName);
            // usually we try to start a Thread without this check
            // if Shared Memory Area is not ready, the start() method
            // die, so the process is destroyed. When respawing a dead child
            // this is not useful, because die() will cause the controller itself
            // to die!
            // So let's check if IPC is ok before call the start() method.
            if ($n->_ipc_is_ok) {
                $n->start();
                $this->_executeThreadPool[] = &$n;
                print time() . "-" . $this->getName() . "- New instance of " . $threadName . " successfully spawned (PID=" . $n->getPid() . ")\n";
                array_splice($this->_respawnThread, $idx, 1);
                $this->setVariable('_executeThreadPool', $this->_executeThreadPool);
            } else {
                print time() . "-" . $this->getName() . "-" . "Unable to create IPC segment...\n";
            }
        }
    }
}


?>
