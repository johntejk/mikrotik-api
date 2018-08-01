<?php

namespace MikrotikAPI\Commands\IP\Firewall;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of ServicePort
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class FirewallServicePort {

    /**
     *
     * @var Roar $roar
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method used for get all Ip Firewall Service Port
     * @return array
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/firewall/service-port/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Firewall service-port To Set, Please Your Add Ip Firewall service-port";
        }
    }

    /**
     * This method used for disable Ip Firewall Service Port
     * @param type $id string
     * @return type array
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/firewall/service-port/disable");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method used for enable Ip Firewall Service Port
     * @param type $id string
     * @return type array
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/firewall/service-port/enable");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     *
     * @param type $id string 
     * @return type array
     * 
     */
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/firewall/service-port/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Firewall Service-Port With This id = " . $id;
        }
    }

}
