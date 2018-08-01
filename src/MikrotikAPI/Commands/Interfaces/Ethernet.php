<?php

namespace MikrotikAPI\Commands\Interfaces;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Roar\Roar;

/**
 * Description of Ethernet
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Ethernet {

    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to display all interface
     * @return type array
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/ethernet/getall");
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
        $sentence->addCommand("/interface/ethernet/set");
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
        $sentence->addCommand("/interface/ethernet/enable");
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
        $sentence->addCommand("/interface/ethernet/disable");
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
        $sentence->fromCommand("/interface/ethernet/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface Ethernet With This id = " . $id;
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
        $sentence->fromCommand("/interface/ethernet/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface Ethernet With This Name = " . $name;
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
        $sentence->fromCommand("/interface/ethernet/print");
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
            return "No Interface Ethernet With This Name = " . $name;
        }
    }

}
