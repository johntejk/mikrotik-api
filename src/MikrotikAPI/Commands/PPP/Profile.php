<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Roar\Roar;

/**
 * Description of Mapi_Ppp_Profile
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Profile {

    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to add ppp profile
     * @param type $param array
     * @return type array
     * 
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ppp/profile/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all ppp profile
     * @return type array
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/profile/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP Profile To Set, Please Your Add PPP Profile";
        }
    }

    /**
     * This method is used to remove ppp profile by id
     * @param type $id string
     * @return type array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ppp/profile/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to set or edit ppp profile by id
     * @param type $param array
     * @param type $id string
     * @return type array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ppp/profile/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display one ppp profile
     * in detail based on the id
     * @param type $id string
     * @return type array
     * 
     */
    public function detailById($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/profile/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP Profile With This id = " . $id;
        }
    }

    /**
     * This method is used to display one ppp profile
     * in detail based on the name
     * @param type $name string
     * @return type array
     *
     */
    public function detailByName($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/profile/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP Profile With This Name = " . $name;
        }
    }

    /**
     * This method is used to display one ppp profile
     * get Id By name
     * @param type $name string not array
     * @return type array
     *
     */
    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/profile/print");
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
            return "No PPP Profile With This Name = " . $name;
        }
    }

}
