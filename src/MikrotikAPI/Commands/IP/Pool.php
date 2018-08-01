<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Pool
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class Pool {

    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to add pool
     * @param array $param 
     * @return array
     * 
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/pool/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display
     * all pool
     * @return array or string
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/pool/getall');
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No IP Pool To Set, Please Your Add Ip Pool";
        }
    }

    /**
     * This method is used to remove the pool by id
     * @param string $id
     * @return array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/pool/remove");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to change pool based on the id
     * @param array $param
     * @param string $id
     * @return array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/pool/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display one pool 
     * in detail based on the id
     * @param type $id string
     * @return type array
     * 
     */
    public function detailById($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/pool/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Pool With This Id = " . $id;
        }
    }

    /**
     * This method is used to display one pool
     * in detail based on the name
     * @param type $name string
     * @return type array
     *
     */
    public function detailByName($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/pool/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Pool With This Name = " . $name;
        }
    }


    /**
     * This method is used to display one pool
     * get Id By name
     * @param type $name string not array
     * @return type array
     *
     */
    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/pool/print");
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
            return "No Ip Pool With This Name = " . $name;
        }
    }

}
