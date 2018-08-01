<?php

namespace MikrotikAPI\Commands\IP\Firewall;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Connection
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class FirewallConnection {

    /**
     *
     * @var Roar $roar
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method used for get all firewall connection
     * @return type array
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/firewall/connection/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Firewall Connection To Set, Please Your Add Ip Firewall Connection";
        }
    }

    /**
     * This method used for delete firewall connection
     * @param type $id string
     * @return type array
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/firewall/connection/remove");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

}
