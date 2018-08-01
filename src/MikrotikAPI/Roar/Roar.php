<?php

namespace MikrotikAPI\Roar;

use MikrotikAPI\Entity\Auth;
use MikrotikAPI\Core\Connector;
use MikrotikAPI\MikrotikException;
use MikrotikAPI\Core\RouterosAPI;

/**
 * Description of Roar
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @author A S M Saief info@asmsaief.com <http://asmsaief.com>
 * @copyright Copyright (c) 2016, SCI Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property RoarReciever
 * @property RoarSender
 */
class Roar {

    private $sender;
    private $reciever;
    private $auth;
    private $connector;
    private $command;
    private $useROS;
    private $routerAPI;
    private $connected = FALSE;
    private $initialized = FALSE;

    public function __construct(Auth $auth, $useROS = true) {
        $this->auth = $auth;

        $this->useROS = $useROS;
        if($useROS){
            $this->routerAPI = new RouterosAPI;
            $this->connected = $this->routerAPI->connect($auth->getHost(), $auth->getUsername(), $auth->getPassword());
        }
    }

    public static function create($ip, $username, $password, $useROS = true){
        $connect = new Auth($ip, $username, $password);
        $roar = new static($connect, $useROS);
        return $roar;
    }

    public function initialize() {
        $auth = $this->auth;
        $this->connector = new Connector($auth->getHost(), $auth->getPort(), $auth->getUsername(), $auth->getPassword());
        if($this->useROS){
            $this->routerAPI->connect($auth->getHost(), $auth->getUsername(), $auth->getPassword());
            $this->sender = new RoarSender($this->connector, $this->routerAPI, TRUE);
            $this->reciever = new RoarReciever($this->connector, $this->routerAPI, TRUE);
            $this->connected = $this->routerAPI->isConnected();
        }
        else{
            $this->connector->connect();
            $tries = 0;
            while(!$this->connector->isConnected() && $tries != $auth->getAttempts())        
            {
                $this->connector->connect();
                sleep(2);
            }
            //failed to connect
            if($tries == $auth->getAttempts())
            {
                throw new MikrotikException('Could not connect to Mikrotik');
            }
            $this->sender = new RoarSender($this->connector);
            $this->reciever = new RoarReciever($this->connector);
            $this->connected = $this->connector->isConnected();
        }
        $this->initialized = TRUE;
    }

    public function closeConnection()
    {
        if($this->useROS){
            $this->routerAPI->disconnect();
        }
        else{
            $this->connector->close();
        }
    }

    /**
     * 
     * @return type
     */
    public function isLogin() {
        //        return parent::isLogin();
    }

    /**
     * 
     * @return type
     */
    public function isConnected() {
        if($this->useROS) {
            return $this->connected;
        }
    }

      /**
     *
     * @return type
     */
//    public function isConnect() {
//        $auth = $this->auth;
//        $this->connector = new Connector($auth->getHost(), $auth->getPort(), $auth->getUsername(), $auth->getPassword());
//
//        if($this->useROS) {
//
//            return $this->connected;
//        }
//    }

    /**
     * 
     * @return type
     */
    public function isDebug() {
        return $this->auth->getDebug();
    }

    public function ram()
    {
        return number_format(($this->command['0']['free-memory']/1048576), 1, '.', '');
    }


    /**
     * 
     * @param type $boolean
     */
    public function setDebug($boolean) {
        $this->auth->setDebug($boolean);
        $this->sender->setDebug($boolean);
        $this->reciever->setDebug($boolean);
    }

    /**
     * 
     * @return type
     */
    public function isTrap() {
        return $this->reciever->isTrap();
    }

    /**
     * 
     * @return type
     */
    public function isDone() {
        return $this->reciever->isDone();
    }

    /**
     * 
     * @return type
     */
    public function isData() {
        return $this->reciever->isData();
    }

    /**
     * 
     * @param type $sentence
     */
    public function send($sentence) {
        if(!$this->initialized){
            $this->initialize();
        }
        if($this->isConnected()){
            $this->sender->send($sentence);
            $this->reciever->doRecieving();
        }
    }

    /**
     * 
     * @return type
     */
    public function getResult() {
        return $this->reciever->getResult();
    }

    /**
     * Standard destructor
     *
     * @return void
     */
    public function __destruct()
    {
        if($this->connected){
            $this->closeConnection();
        }
    }

}
