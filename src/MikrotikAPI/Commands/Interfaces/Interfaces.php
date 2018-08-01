<?php

namespace MikrotikAPI\Commands\Interfaces;

use MikrotikAPI\Roar\Roar;
use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Commands\Interfaces\Bonding,
    MikrotikAPI\Commands\Interfaces\EoIP,
    MikrotikAPI\Commands\Interfaces\Ethernet,
    MikrotikAPI\Commands\Interfaces\IPTunnel,
    MikrotikAPI\Commands\Interfaces\L2TPClient,
    MikrotikAPI\Commands\Interfaces\L2TPServer,
    MikrotikAPI\Commands\Interfaces\PPPClient,
    MikrotikAPI\Commands\Interfaces\PPPServer,
    MikrotikAPI\Commands\Interfaces\PPPoEClient,
    MikrotikAPI\Commands\Interfaces\PPPoEServer,
    MikrotikAPI\Commands\Interfaces\PPTPClient,
    MikrotikAPI\Commands\Interfaces\PPTPServer,
    MikrotikAPI\Commands\Interfaces\VLAN,
    MikrotikAPI\Commands\Interfaces\VRRP;

/**
 * Description of Mapi_Interfaces
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Interfaces {

    /**
     *
     * @var Roar
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to call class Ethernet
     * @return Mapi_Ip 
     */
    public function ethernet() {
        return new Ethernet($this->roar);
    }

    /**
     * This method is used to call class Wireless
     * @return Mapi_Ip 
     */
    public function wireless() {
        return new Wireless($this->roar);
    }

    /**
     * This method is used to call class Pppoe_Client
     * @return Mapi_Ip 
     */
    public function PPPoEClient() {
        return new PPPoEClient($this->roar);
    }

    /**
     * This method is used to call class Pppoe_Server
     * @return Mapi_Ip 
     */
    public function PPPoEServer() {
        return new PPPoEServer($this->roar);
    }

    /**
     * This method is used to call class Eoip
     * @return Mapi_Ip 
     */
    public function EoIP() {
        return new EoIP($this->roar);
    }

    /**
     * This method is used to call class Ipip
     * @return Mapi_Ip 
     */
    public function IPTunnel() {
        return new IPTunnel($this->roar);
    }

    /**
     * This method is used to call class Vlan
     * @return Mapi_Ip 
     */
    public function VLAN() {
        return new VLAN($this->roar);
    }

    /**
     * This method is used to call class Vrrp
     * @return Mapi_Ip 
     */
    public function VRRP() {
        return new VRRP($this->roar);
    }

    /**
     * This method is used to call class Bonding
     * @return Mapi_Ip 
     */
    public function bonding() {
        return new Bonding($this->roar);
    }

    /**
     * This method for used call class Bridge
     * @return Mapi_Ip
     */
    public function bridge() {
        return new Bridge($this->roar);
    }

    /**
     * This method used call class L2tp_Client 
     * @return Mapi_Ip
     */
    public function L2TPClient() {
        return new L2TPClient($this->roar);
    }

    /**
     * This method used call class L2tp_Server 
     * @return Mapi_Ip
     */
    public function L2TPServer() {
        return new L2TPServer($this->roar);
    }

    /**
     * This method used call class Ppp_Client 
     * @return Mapi_Ip
     */
    public function PPPClient() {
        return new PPPClient($this->roar);
    }

    /**
     * This method used call class Ppp_Server 
     * @return Mapi_Ip
     */
    public function PPPServer() {
        return new PPPServer($this->roar);
    }

    /**
     * This method used call class Pptp_Client 
     * @return Mapi_Ip
     */
    public function PPTPClient() {
        return new PPTPClient($this->roar);
    }

    /**
     * This method used call class Pptp_Server 
     * @return Mapi_Ip
     */
    public function PPTPServer() {
        return new PPTPServer($this->roar);
    }
    
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        return $rs->getResultArray();
    }

    /**
     * This method is used to display one interface  
     * in detail based on the id
     * @param type $param array
     * @param type $id string
     * @return type array
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to enable interface by id
     * @param type $id string
     * @return type array
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/enable");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to disable interface by id
     * @param type $id string
     * @return type array
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/disable");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display one interafce 
     * in detail based on the id
     * @param type $id string
     * @return type array
     * 
     */
    public function detailById($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface With This id = " . $id;
        }
    }

    /**
     * This method is used to display one interafce
     * in detail based on the name
     * @param type $name string
     * @return type array
     *
     */
    public function detailByName($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface With This Name = " . $name;
        }
    }

    /**
     * This method is used to display one interafce
     * get Id By name
     * @param type $name string not array
     * @return type array
     *
     */
    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            $rsArray = $rs->getResultArray();
            foreach ($rsArray as $Id) {
                return $Id['.id'];
            }
        } else {
            return "No Interface With This Name = " . $name;
        }
    }

}
