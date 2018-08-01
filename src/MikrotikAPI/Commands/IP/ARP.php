<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of ARP
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class ARP {

    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to add arp
     * @param type $param array
     * @return type array
     * j
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to delete arp by id
     * @param type $id string
     * @return type array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to enable arp by id
     * @param type $id string
     * @return type array
     * 
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/enable");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to disable arp by id
     * @param type $id string
     * @return type array
     * 
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/disable");
        $sentence->where(".id", "=", $id);
        $disable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to set or edit by id
     * @param type $param array
     * @param type $id string
     * @return type array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all arp
     * @return type array
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/arp/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip ARP To Set, Please Your Add Ip ARP";
        }
    }

    /**
     * This method is used to display arp
     * in detail based on the id
     * @param type $id string
     * @return type array
     *  
     */
    public function detailById($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/arp/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip ARP With This id = " . $id;
        }
    }


    /**
     * This method is used to display arp
     * in detail based on the Address
     * @param type $address string
     * @return type array
     *
     */
    public function detailByAddress($address) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/arp/print");
        $sentence->where("address", "=", $address);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip ARP With This address = " . $address;
        }
    }


    /**
     * This method is used to display arp
     * get Id By name
     * @param type $name string not array
     * @return type array
     *
     */
    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/arp/print");
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
            return "No Ip ARP With This address = " . $address;
        }
    }

}
