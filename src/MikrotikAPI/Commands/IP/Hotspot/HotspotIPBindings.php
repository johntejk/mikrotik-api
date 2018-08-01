<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of IPBindings
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category name
 */
class HotspotIPBindings {

    /**
     *
     * @var Roar
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This function is used to add hotspot ip binding
     * @return string
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/ip-binding/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to delete hotspot ip binding by id
     * @param string $id
     * @return string
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/ip-binding/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to enable hotspot ip binding by id
     * @param type $id string
     * @return string
     * 
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/ip-binding/enable");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to disable hotspot ip binding by id
     * @param string $id
     * @return string
     * 
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/ip-binding/disable");
        $sentence->where(".id", "=", $id);
        $disable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to set or edit by id
     * @param array $param
     * @param string $id
     * @return string
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/ip-binding/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all ip binding on hotspot
     * @return array or string
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/ip-binding/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No IP Hotspot IP Binding To Set, Please Your Add IP Hotspot IP Binding";
        }
    }

    /**
     * This method is used to display hotspot ip binding
     * in detail based on the id
     * @param string $id 
     * @return  array
     *  
     */
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/ip-binding/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No IP Hotspot IP Binding With This id = " . $id;
        }
    }

}
