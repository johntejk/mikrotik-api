<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of UsersProfile
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category name
 */
class HotspotUserProfiles {

    /**
     *
     * @var Roar
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This function is used to add hotspot user p
     * @return type array
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to delete hotspot user profile by id
     * @param type $id string
     * @return type array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to enable hotspot user profile by id
     * @param type $id string
     * @return type array
     * 
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/enable");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to disable hotspot user profile by id
     * @param type $id string
     * @return type array
     * 
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/disable");
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
        $sentence->addCommand("/ip/hotspot/user/profile/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all hotspot user profile
     * @return type array
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/user/profile/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No IP Hotspot User Profile To Set, Please Your Add IP Hotspot User Profile";
        }
    }

    /**
     * This method is used to display hotspot user profile
     * in detail based on the id
     * @param string $id
     * @return array
     *  
     */
    public function detailById($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/user/profile/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No IP Hotspot User Profile With This id = " . $id;
        }
    }

    /**
     * This method is used to display hotspot user profile
     * in detail based on the name
     * @param string $id
     * @return array
     *
     */
    public function detailByName($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/user/profile/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No IP Hotspot User Profile With This name = " . $name;
        }
    }


    /**
     * This method is used to display hotspot user profile
     * get Id By name
     * @param type $name string not array
     * @return type array
     *
     */
    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/user/profile/print");
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
            return "No IP Hotspot User Profile With This name = " . $name;
        }
    }



}
