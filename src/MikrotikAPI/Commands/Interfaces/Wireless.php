<?php

namespace MikrotikAPI\Commands\Interfaces;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Roar\Roar;

/**
 * Description of Wireless
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Wireless {

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
        $sentence->fromCommand("/interface/wireless/getall");
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
        $sentence->addCommand("/interface/wireless/set");
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
        $sentence->addCommand("/interface/wireless/enable");
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
        $sentence->addCommand("/interface/wireless/disable");
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
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/wireless/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface Wireless With This id = " . $id;
        }
    }

}
